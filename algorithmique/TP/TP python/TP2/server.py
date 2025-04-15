import socket
import threading
import json

# Constants
HOST = '0.0.0.0'
PORT = 55555
SCORE_FILE = 'scores.txt'

# Global variables
clients = []
players_data = {}
number_to_guess = 0
winner = []
lock = threading.Lock()

def send_player_updates():
    """Send current player status to all clients"""
    player_status = {}
    for player, data in players_data.items():
        player_status[player] = {
            "status": "finished" if data["score"] > 0 else "playing",
            "attempts": data["tries"]
        }
    
    update = json.dumps({"player_update": player_status})
    broadcast(update)

def broadcast(message):
    """Send message to all connected clients"""
    for client in clients:
        try:
            if isinstance(message, str):
                client.sendall(message.encode())
            else:
                client.sendall(message)
        except:
            pass

def save_scores():
    """Save game scores to file"""
    with open(SCORE_FILE, 'a') as f:
        f.write("\n--- Game Summary ---\n")
        for player, data in players_data.items():
            f.write(f"{player}: {data['tries']} tries, Score: {data['score']}\n")
        
        min_score = min(v["tries"] for v in players_data.values() if v["score"] > 0)
        winners = [k for k, v in players_data.items() if v["tries"] == min_score and v["score"] > 0]
        if winners:
            f.write(f"Winner(s): {','.join(winners)}\n")

def handle_client(client_socket, addr):
    """Handle individual client connections"""
    global players_data
    
    name = client_socket.recv(1024).decode('utf-8')
    print(f"{name} connected from {addr}")
    
    with lock:
        players_data[name] = {'tries': 0, 'score': 0}
        send_player_updates()
    
    try:
        while True:
            # Receive guess from client
            guess = client_socket.recv(1024).decode('utf-8')
            if not guess:
                break
            
            guess = int(guess)
            with lock:
                players_data[name]['tries'] += 1
            
            # Prepare response with attempts count
            if guess == number_to_guess:
                players_data[name]['score'] = players_data[name]['tries']
                response = {
                    "feedback": f"{name} guessed the correct number in {players_data[name]['tries']} attempts!",
                    "attempts": players_data[name]['tries']
                }
                client_socket.sendall(json.dumps(response).encode())
                send_player_updates()
                break
            elif guess > number_to_guess:
                response = {
                    "feedback": f"Too high!",
                    "attempts": players_data[name]['tries']
                }
            else:
                response = {
                    "feedback": f"Too low!",
                    "attempts": players_data[name]['tries']
                }
            
            client_socket.sendall(json.dumps(response).encode())
            send_player_updates()
            
    except (ConnectionResetError, ValueError):
        print(f"{name} disconnected")
    finally:
        with lock:
            if client_socket in clients:
                clients.remove(client_socket)
            if name in players_data:
                del players_data[name]
            send_player_updates()
        
        client_socket.close()
        print(f"{name} left the game")

def main():
    """Main server function"""
    global number_to_guess
    
    print("Welcome to the Multiplayer Number Guessing Game!")
    print("Enter a number between 0 and 100 for players to guess:")
    number_to_guess = int(input())
    
    # Start the server
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.bind((HOST, PORT))
    server_socket.listen(5)
    print(f"The game server has started on {HOST}:{PORT}")
    
    try:
        while True:
            client_socket, addr = server_socket.accept()
            clients.append(client_socket)
            threading.Thread(target=handle_client, args=(client_socket, addr)).start()
    except KeyboardInterrupt:
        print("\nGame ended by host. Saving scores...")
        save_scores()
    finally:
        server_socket.close()
        print("Server closed.")
        print("Final Scores:")
        for player, data in players_data.items():
            print(f"{player}: {data['tries']} tries, Score: {data['score']}")

if __name__ == "__main__":
    main()
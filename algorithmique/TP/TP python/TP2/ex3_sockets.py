import socket
import threading

# Constants
HOST = '0.0.0.0'
PORT = 55555
SCORE_FILE = 'scores.txt'

# Global variables
players_data = {}
number_to_guess = 0
lock = threading.Lock()

# Save scores to file
def save_scores():
    
    with open(SCORE_FILE, 'a') as f:
        f.write("\n--- Game Summary ---\n")
        for player, data in players_data.items():
            f.write(f"{player}: {data['tries']} tries\n")



# Handle each client connection
def handle_client(client_socket: socket.socket, addr):
    global winner, players_data
    
    name = client_socket.recv(1024).decode('utf-8')
    print(f"{name} connected from {addr}")

    with lock:
        players_data[name] = {'tries': 0}

    try:
        while True:
            # Receive guess from client
            guess = client_socket.recv(1024).decode('utf-8')
            if not guess:
                break

            guess = int(guess)
            players_data[name]['tries'] += 1

            # Check if the guess is correct
            if guess == number_to_guess:
                response = f"{name} guessed the correct number!\n"
                # broadcast(response)
                client_socket.sendall(response.encode())
                break
            elif guess > number_to_guess:
                response = f"{name}: Too high!\n"
            else:
                response = f"{name}: Too low!\n"

            client_socket.sendall(response.encode())

    except:
        print(f"{name} disconnected")
    finally:
        client_socket.close()
        print(f"{name} left the game")

# Main server function
def main():
    global number_to_guess, winner

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
            threading.Thread(target=handle_client, args=(client_socket, addr)).start()
    except KeyboardInterrupt:
        print("\nGame ended by host. Saving scores...")
        save_scores()

        server_socket.close()
        print("Server closed.")

        print("Final Scores:")
        for player, data in players_data.items():
            print(f"{player}: {data['tries']} tries")

if __name__ == "__main__":
    main()

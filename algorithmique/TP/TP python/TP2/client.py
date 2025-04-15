import socket

# Constants
SERVER_HOST = input("Enter the server's IP address: ")
SERVER_PORT = 55555 


def main():
    print("Welcome to the Multiplayer Number Guessing Game!")
    name = input("Enter your name: ")

    # Connect to the server
    client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    try:
        client_socket.connect((SERVER_HOST, SERVER_PORT))
    except Exception as e:
        print(f"Unable to connect to server: {e}")
        return

    # Send player's name
    client_socket.sendall(name.encode())

    try:
        while True:
            # Enter a guess
            guess = input("Enter your guess (a number between 0 and 100): ")
            if not guess.isdigit():
                print("Invalid input! Please enter a valid number.")
                continue

            client_socket.sendall(guess.encode())  # Send the guess to the server

            # Receive server feedback
            feedback = client_socket.recv(1024).decode('utf-8')
            print(feedback)

            # Check if the game is over
            if "guessed the correct number" in feedback:
                break
    except (ConnectionResetError, KeyboardInterrupt):
        print("Disconnected from the server.")
    finally:
        client_socket.close()
        print("Connection closed.")

main()



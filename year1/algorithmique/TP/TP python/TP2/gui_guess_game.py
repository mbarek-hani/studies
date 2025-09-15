import socket
import pygame
import sys

# Constants
WINDOW_WIDTH = 800
WINDOW_HEIGHT = 600
WHITE = (255, 255, 255)
BLACK = (0, 0, 0)
GRAY = (200, 200, 200)
BLUE = (0, 100, 255)
GREEN = (0, 255, 0)
RED = (255, 0, 0)

class NumberGuessingGameGUI:
    def __init__(self):
        pygame.init()
        self.screen = pygame.display.set_mode((WINDOW_WIDTH, WINDOW_HEIGHT))
        pygame.display.set_caption("Number Guessing Game")
        
        # Game state
        self.connected = False
        self.game_over = False
        self.feedback = "Welcome to the Number Guessing Game!"
        self.input_text = ""
        self.input_active = False
        self.current_screen = "connect"  # Screens: connect, name, game
        
        # Font setup
        self.font = pygame.font.Font(None, 36)
        self.small_font = pygame.font.Font(None, 24)
        
        # Input boxes
        self.input_rect = pygame.Rect(300, 250, 200, 40)
        self.button_rect = pygame.Rect(300, 300, 200, 40)
        
        # Network
        self.client_socket = None
        
    def connect_to_server(self, host, port=55555):
        try:
            self.client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            self.client_socket.connect((host, port))
            self.connected = True
            self.current_screen = "name"
            self.feedback = "Connected! Enter your name:"
        except Exception as e:
            self.feedback = f"Connection failed: {e}"
    
    def send_name(self, name):
        if self.connected:
            self.client_socket.sendall(name.encode())
            self.current_screen = "game"
            self.feedback = "Enter your guess (0-100):"
    
    def send_guess(self, guess):
        if not guess.isdigit():
            self.feedback = "Please enter a valid number!"
            return
        
        try:
            self.client_socket.sendall(guess.encode())
            feedback = self.client_socket.recv(1024).decode('utf-8')
            self.feedback = feedback
            if "guessed the correct number" in feedback:
                self.game_over = True
        except Exception as e:
            self.feedback = f"Error: {e}"
            self.connected = False
    
    def draw_text_box(self, prompt):
        # Draw input box
        pygame.draw.rect(self.screen, WHITE if self.input_active else GRAY, self.input_rect, 0)
        pygame.draw.rect(self.screen, BLACK, self.input_rect, 2)
        
        # Draw prompt
        prompt_surface = self.font.render(prompt, True, BLACK)
        prompt_rect = prompt_surface.get_rect(bottomleft=(self.input_rect.left, self.input_rect.top - 10))
        self.screen.blit(prompt_surface, prompt_rect)
        
        # Draw input text
        text_surface = self.font.render(self.input_text, True, BLACK)
        self.screen.blit(text_surface, (self.input_rect.x + 5, self.input_rect.y + 5))
        
        # Draw button
        pygame.draw.rect(self.screen, BLUE, self.button_rect)
        button_text = self.font.render("Submit", True, WHITE)
        button_rect = button_text.get_rect(center=self.button_rect.center)
        self.screen.blit(button_text, button_rect)
    
    def draw_feedback(self):
        # Draw feedback text with word wrapping
        words = self.feedback.split()
        lines = []
        current_line = []
        
        for word in words:
            current_line.append(word)
            text = ' '.join(current_line)
            if self.font.size(text)[0] > WINDOW_WIDTH - 100:
                current_line.pop()
                lines.append(' '.join(current_line))
                current_line = [word]
        
        if current_line:
            lines.append(' '.join(current_line))
        
        y_offset = 100
        for line in lines:
            text_surface = self.font.render(line, True, BLACK)
            text_rect = text_surface.get_rect(centerx=WINDOW_WIDTH // 2, y=y_offset)
            self.screen.blit(text_surface, text_rect)
            y_offset += 40
    
    def run(self):
        clock = pygame.time.Clock()
        
        while True:
            for event in pygame.event.get():
                if event.type == pygame.QUIT:
                    if self.client_socket:
                        self.client_socket.close()
                    pygame.quit()
                    sys.exit()
                
                if event.type == pygame.MOUSEBUTTONDOWN:
                    if self.input_rect.collidepoint(event.pos):
                        self.input_active = True
                    elif self.button_rect.collidepoint(event.pos) and self.input_text:
                        if self.current_screen == "connect":
                            self.connect_to_server(self.input_text)
                            self.input_text = ""
                        elif self.current_screen == "name":
                            self.send_name(self.input_text)
                            self.input_text = ""
                        elif self.current_screen == "game" and not self.game_over:
                            self.send_guess(self.input_text)
                            self.input_text = ""
                    else:
                        self.input_active = False
                
                if event.type == pygame.KEYDOWN:
                    if self.input_active:
                        if event.key == pygame.K_RETURN and self.input_text:
                            if self.current_screen == "connect":
                                self.connect_to_server(self.input_text)
                                self.input_text = ""
                            elif self.current_screen == "name":
                                self.send_name(self.input_text)
                                self.input_text = ""
                            elif self.current_screen == "game" and not self.game_over:
                                self.send_guess(self.input_text)
                                self.input_text = ""
                        elif event.key == pygame.K_BACKSPACE:
                            self.input_text = self.input_text[:-1]
                        else:
                            self.input_text += event.unicode
            
            # Draw
            self.screen.fill(WHITE)
            
            # Draw feedback
            self.draw_feedback()
            
            # Draw appropriate input box based on current screen
            if self.current_screen == "connect":
                self.draw_text_box("Enter server IP:")
            elif self.current_screen == "name":
                self.draw_text_box("Enter your name:")
            elif self.current_screen == "game" and not self.game_over:
                self.draw_text_box("Enter your guess (0-100):")
            
            pygame.display.flip()
            clock.tick(60)

if __name__ == "__main__":
    game = NumberGuessingGameGUI()
    game.run()
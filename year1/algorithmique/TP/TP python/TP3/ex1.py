import sys
from typing import Generator, Dict

def read_file(filename: str) -> Generator[str, None, None]:
    """Lit le fichier ligne par ligne en utilisant un générateur."""
    try:
        with open(filename, 'r') as file:
            for line in file:
                yield line.strip()
    except FileNotFoundError:
        print(f"Error: le fichier {filename} n'existe pas!")
        sys.exit(1)

def get_words(content: Generator[str, None, None]) -> Generator[str, None, None]:
    """Génère les mots à partir du contenu, un mot à la fois."""
    for line in content:
        for word in line.split():
            yield word.lower()

def count_words(words: Generator[str, None, None]) -> int:
    """Compte le nombre total de mots."""
    return sum(1 for _ in words)

def find_most_common_word(words: Generator[str, None, None]) -> str:
    """Trouve le mot le plus fréquent en utilisant un dictionnaire."""
    word_count: Dict[str, int] = {}
    
    # Compter la fréquence de chaque mot
    for word in words:
        if word in word_count:
            word_count[word] += 1
        else:
            word_count[word] = 1
    
    # Trouver le mot avec la plus grande fréquence
    most_common_word = ''
    max_count = 0
    
    for word, count in word_count.items():
        if count > max_count:
            max_count = count
            most_common_word = word
            
    return most_common_word

def save_results(output_file: str, total_words: int, most_common_word: str) -> None:
    """Sauvegarde les résultats dans un fichier."""
    with open(output_file, 'w') as file:
        file.write(f"Nombre total de mots: {total_words}\n")
        file.write(f"Mot le plus fréquent: \"{most_common_word}\"\n")

def main():
    if len(sys.argv) != 3:
        print("Usage: python3 ex1.py input_file output_file")
        sys.exit(1)
    
    input_file = sys.argv[1]
    output_file = sys.argv[2]
    
    try:
        # Lecture et analyse du fichier
        content = read_file(input_file)
        
        # Pour le compte total des mots
        words_for_count = get_words(content)
        total_words = count_words(words_for_count)
        
        # Pour trouver le mot le plus fréquent
        # On doit relire le fichier car le générateur précédent est épuisé
        content = read_file(input_file)
        words_for_common = get_words(content)
        most_common = find_most_common_word(words_for_common)
        
        # Sauvegarde des résultats
        save_results(output_file, total_words, most_common)
        
        print(f"Analyse terminée. Résultats sauvegardés dans {output_file}")
    except Exception as e:
        print(f"Une erreur est survenue: {str(e)}")
        sys.exit(1)

if __name__ == "__main__":
    main()
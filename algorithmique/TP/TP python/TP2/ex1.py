import random
import string

def generate_password(length: int) -> str:
    # Définition des ensembles de caractères qui vont formuler le mot de passe
    minuscule = string.ascii_uppercase
    majuscule = string.ascii_lowercase
    chiffre = string.digits
    special = "#@$%&[]()"
    
    # Génération de 4 caractères aléatoires pour guarantir qu'il y a au moins une lettre minuscule, autre majuscule, un charactère spécial et un chiffre
    password = [
        random.choice(minuscule),
        random.choice(majuscule),
        random.choice(chiffre),
        random.choice(special)
    ]
    
    # Compléter le reste du mot de passe avec des caractères aléatoires
    tous = minuscule + majuscule + chiffre + special
    # password.extend(random.choice(tous) for _ in range(length - 4))
    for _ in range(length - 4):
        password.append(random.choice(tous))
    
    # Mélanger le mot de passe pour plus de sécurité
    random.shuffle(password)
    
    return ''.join(password)

def generate_multiple_passwords(count: int, length: int) -> list[str]:
    passwords = [generate_password(length) for _ in range(count)]
    
    # Sauvegarde des mots de passe dans un fichier
    with open('passwords.txt', 'w') as file:
        for i, pwd in enumerate(passwords, 1):
            file.write(f"Mot de passe {i}: {pwd}\n")
    
    return passwords

# Exemple d'utilisation
if __name__ == "__main__":
    # Générer 5 mots de passe de 12 caractères
    generated_passwords = generate_multiple_passwords(10, 12)
    
    # Afficher les mots de passe générés
    for pwd in generated_passwords:
        print(f"Mot de passe généré : {pwd}")


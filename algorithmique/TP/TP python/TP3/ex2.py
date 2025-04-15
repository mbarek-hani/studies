import csv
from typing import List, Dict

def read_csv(filename: str) -> List[Dict]:
    """
    Charge les données depuis un fichier CSV.
    Colonnes attendues : Nom, Matière, Note
    """
    students_data = []
    with open(filename, 'r') as file:
        reader = csv.DictReader(file)
        for row in reader:
            # Convertir la note en float
            row['Note'] = float(row['Note'])
            students_data.append(row)
    return students_data

def calculate_mean(numbers: List[float]) -> float:
    """
    Calcule la moyenne d'une liste de nombres
    """
    if not numbers:
        return 0
    return sum(numbers) / len(numbers)

def average_grade(data: List[Dict]) -> Dict[str, float]:
    """
    Calcule la moyenne des notes pour chaque étudiant.
    """
    # Grouper les notes par étudiant
    student_grades = {}
    for row in data:
        if row['Nom'] not in student_grades:
            student_grades[row['Nom']] = []
        student_grades[row['Nom']].append(row['Note'])
    
    # Calculer la moyenne pour chaque étudiant
    averages = {
        name: calculate_mean(grades) 
        for name, grades in student_grades.items()
    }
    return averages

def top_students(data: List[Dict], n: int) -> List[Dict[str, float]]:
    """
    Trouve les n meilleurs étudiants basé sur leur moyenne.
    """
    # Calculer les moyennes
    averages = average_grade(data)
    
    # Trier les étudiants par moyenne décroissante
    sorted_students = sorted(
        averages.items(),
        key=lambda x: x[1],
        reverse=True
    )
    
    # Prendre les n premiers
    return [
        {"Nom": name, "Moyenne": avg}
        for name, avg in sorted_students[:n]
    ]

def save_top_students(filename: str, top_students_data: List[Dict[str, float]]) -> None:
    """
    Sauvegarde les informations des meilleurs étudiants dans un fichier texte.
    """
    with open(filename, 'w') as file:
        file.write("Classement des meilleurs étudiants :\n\n")
        for i, student in enumerate(top_students_data, 1):
            file.write(f"\t{i}. {student['Nom']}: {student['Moyenne']:.2f}\n")

# Exemple d'utilisation
if __name__ == "__main__":
    try:
        # Charger les données
        data = read_csv("results.csv")
        
        # Trouver les 3 meilleurs étudiants
        best_students = top_students(data, 3)
        
        # Sauvegarder les résultats
        save_top_students("top_students.txt", best_students)
        
        print("L'analyse a été complétée avec succès !")
        
    except FileNotFoundError:
        print("Erreur : Le fichier results.csv n'a pas été trouvé.")
    except Exception as e:
        print(f"Une erreur est survenue : {e}")
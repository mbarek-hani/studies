from point import Point
from trois_points import TroisPoints

def main():
    # teste de la classe Point
    print("=== teste de la classe Point ===")
    
    # Création de points
    p1 = Point(1, 2)
    p2 = Point(4, 6)
    p3 = Point(1, 2)  # Identique à p1
    
    # Affichage des points
    print(f"Point p1: {p1}")
    print(f"Point p2: {p2}")
    print(f"Point p3: {p3}")
    
    # teste du nombre de points créés
    print(f"Nombre de points créés: {Point.nb}") # doit afficher 3
    
    # teste de l'égalité entre points
    print(f"p1 == p2: {p1 == p2}")  # False
    print(f"p1 == p3: {p1 == p3}")  # True
    
    # teste des getters et setters
    print(f"Abscisse de p1: {p1.abs}")
    p1.abs = 10
    print(f"Nouvelle abscisse de p1: {p1.abs}")
    print(f"p1 après modification: {p1}")
    
    # teste du calcul de distance
    distance = p1.calculer_distance(p2)
    print(f"Distance entre p1 et p2: {distance:.2f}")
    
    # teste du calcul de milieu
    milieu = p1.calculer_milieu(p2)
    print(f"Milieu entre p1 et p2: {milieu}")
    
    # teste des méthodes statiques
    distance_stat = Point.distance_statique(p1, p2)
    print(f"Distance statique entre p1 et p2: {distance_stat:.2f}")
    
    milieu_stat = Point.milieu_statique(p1, p2)
    print(f"Milieu statique entre p1 et p2: {milieu_stat}")
    
    # teste de la classe TroisPoints
    print("\n=== teste de la classe TroisPoints ===")
    
    # 3 Points alignés
    pa = Point(0, 0)
    pb = Point(2, 2)
    pc = Point(4, 4)
    trois_points_aligne = TroisPoints(pa, pb, pc)
    print(f"Points alignés ({pa}, {pb}, {pc}): {trois_points_aligne.sontalignes()}")
    
    # 3 Points non alignés qui forment un triangle isocèle
    pa = Point(0, 0)
    pb = Point(4, 0)
    pc = Point(2, 3)
    triangle_isocele = TroisPoints(pa, pb, pc)
    print(f"Points ({pa}, {pb}, {pc}) alignés: {triangle_isocele.sontalignes()}")
    print(f"Triangle isocèle: {triangle_isocele.estisocele()}")
    
    # 3 Points non alignés formant un triangle non isocele
    pa = Point(0, 0)
    pb = Point(5, 0)
    pc = Point(2, 3)
    triangle_nono_aligne = TroisPoints(pa, pb, pc)
    print(f"Points ({pa}, {pb}, {pc}) alignés: {triangle_nono_aligne.sontalignes()}")
    print(f"Triangle isocèle: {triangle_nono_aligne.estisocele()}")

if __name__ == "__main__":
    main()

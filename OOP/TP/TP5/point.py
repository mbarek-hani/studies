# Fichier: point.py
import math

class Point:
    # Attribut statique qui compte le nombre de points créés
    nb = 0
    
    def __init__(self, abs: float, ord: float):
        # Attributs privés
        self.__abs: float = abs
        self.__ord: float = ord

        Point.nb += 1 # Incrémentation du compteur de points
    
    @property
    def abs(self) -> float:
        return self.__abs
    
    @abs.setter
    def abs(self, valeur: float) -> None:
        self.__abs = valeur
    
    @property
    def ord(self) -> float:
        return self.__ord
    
    @ord.setter
    def ord(self, valeur: float) -> None:
        self.__ord = valeur
    
    def __str__(self):
        return f"({self.__abs},{self.__ord})"
    
    def __eq__(self, autre_point) -> bool: # type: ignore
        if not isinstance(autre_point, Point):
            return False
        return self.__abs == autre_point.__abs and self.__ord == autre_point.__ord
    
    def calculer_distance(self, p) -> float: # type: ignore
        return math.sqrt(math.pow(self.__abs - p.__abs, 2) + math.pow(self.__ord - p.__ord, 2))
    
    def calculer_milieu(self, p):
        abs_milieu = (self.__abs + p.__abs) / 2
        ord_milieu = (self.__ord + p.__ord) / 2
        return Point(abs_milieu, ord_milieu)
    
    @staticmethod
    def distance_statique(p1, p2):
        return p1.calculer_distance(p2)
    
    @staticmethod
    def milieu_statique(p1, p2):
        return p1.calculer_milieu(p2)

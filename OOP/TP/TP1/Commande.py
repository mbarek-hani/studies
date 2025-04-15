from datetime import datetime

from ElementCommande import ElementCommande
from Produit import Produit

class Commande:
    def __init__(self):
        self.date_creation = datetime.now()
        self.elements_commande: list[ElementCommande] = []
    
    def ajouter_produit(self, produit: Produit, quantite: int):
        produit.diminuer_stock(quantite)
        element = ElementCommande(produit, quantite)
        self.elements_commande.append(element)
    
    def calculer_total(self) -> float:
        return sum(element.calculer_montant() for element in self.elements_commande)
    
    def afficher_commande(self) -> None:
        print(f"Date de commande: {self.date_creation}")
        print("Produits commandés:")
        for element in self.elements_commande:
            print(f"- {element.produit._designation}: {element.quantite} x {element.produit._prix_vente}DH = {element.calculer_montant()}DH")
        print(f"Total: {self.calculer_total()}DH")
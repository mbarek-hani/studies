from Produit import Produit

class ElementCommande:
    def __init__(self, produit: Produit, quantite: int):
        if quantite <= 0:
            raise ValueError("La quantité doit être strictement positive")
        self.produit = produit
        self.quantite = quantite
        self.qte
    def calculer_montant(self) -> float:
        return self.produit._prix_vente * self.quantite


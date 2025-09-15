class Produit:
    # Variable de classe pour compter le nombre total de produits
    _nmb_produits = 0
    
    def __init__(self, reference: str, designation: str, prix_achat: float, prix_vente: float):
        self._reference = reference
        self._designation = designation
        self._prix_achat = prix_achat
        self._prix_vente = prix_vente
        self._quantite_stock = 0
        Produit._nmb_produits += 1
    
    def modifier_prix_achat(self, nouveau_prix: float) -> None:
        self._prix_achat = nouveau_prix
    
    def modifier_prix_vente(self, nouveau_prix: float) -> None:
        self._prix_vente = nouveau_prix
    
    def augmenter_stock(self, quantite: int) -> None:
        if quantite <= 0:
            raise ValueError("La quantité doit être strictement positive")
        self._quantite_stock += quantite
    
    def diminuer_stock(self, quantite: int):
        if quantite <= 0:
            raise ValueError("La quantité doit être strictement positive")
        elif quantite > self._quantite_stock:
            raise ValueError("La quantité demandée est supérieure à la quantité en stock")
        
        self._quantite_stock -= quantite
    
    def __str__(self) -> str:
        return f"Produit(designation: {self._designation}, Référence: {self._reference}, Quantité en stock: {self._quantite_stock})"
    
    @classmethod
    def nombre_produits(cls) -> int:
        return cls._nmb_produits




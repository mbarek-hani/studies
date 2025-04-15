import abc

from exc import LengthListContituantsError


class Produit(abc.ABC):
    def __init__(self, nom: str, code: str):
        self.__nom = nom
        self.__code = code
    
    @property
    def nom(self):
        return self.__nom

    @property
    def code(self):
        return self.__code
    
    @abc.abstractmethod
    def get_prix_HT(self):
        pass


class ProduitElementaire(Produit):
    def __init__(self, nom: str, code: str, prix_achat: float):
        super().__init__(nom, code)
        self.__prix_HT = prix_achat
    
    def get_prix_HT(self):
        return self.__prix_HT
    
    def __str__(self):
        return f"ProduitElementaire(nom={self.nom}, code={self.code}, prixAchat={self.get_prix_HT()})"


class Composition:
    def __init__(self, produit: ProduitElementaire, quantite: int):
        if not isinstance(produit, ProduitElementaire):
            raise TypeError("produit doit être une instance de ProduitElementaire")
        self.__produit = produit
        self.__quantite = quantite
    
    @property
    def produit(self):
        return self.__produit
    
    @produit.setter
    def produit(self, produit: ProduitElementaire):
        self.__produit = produit
    
    @property
    def quantite(self):
        return self.__quantite
    
    @quantite.setter
    def quantite(self, quantite: int):
        self.__quantite = quantite

class ProduitCompose(Produit):
    def __init__(self, nom: str, code: str, frais_fabrication: float, constitution: list[Composition]):
        if len(constitution) <=2:
            raise LengthListContituantsError("taille du tableau est fausse")
        super().__init__(nom, code)
        self.__frais_fabrication = frais_fabrication
        self.taux_TVA = 0.18
        self.__liste_contituants = constitution
    
    @property
    def frais_fabrication(self):
        return self.__frais_fabrication
    
    @property
    def list_constituant(self):
        return self.__liste_contituants
    
    def get_prix_HT(self):
        prix = 0.0
        for comp in self.list_constituant:
            prix += comp.produit.get_prix_HT() * comp.quantite
        return prix + self.frais_fabrication
    
    def __str__(self):
        return f"ProduitCompose(nom={self.nom}, code={self.code}, prix={self.get_prix_HT()})"
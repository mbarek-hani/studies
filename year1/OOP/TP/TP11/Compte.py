

class Compte:
    def __init__(self, numero: str, proprietaire: str, solde: str, date_ouverture: str):
        self.__numero = numero
        self.__proprietaire = proprietaire
        self.__solde = solde
        self.__date_ouverture = date_ouverture
    
    @property
    def numero(self):
        return self.__numero
    
    @property
    def proprietaire(self):
        return self.__proprietaire
    
    @property
    def solde(self):
        return self.__solde
    
    @property
    def date_ouverture(self):
        return self.__date_ouverture
    
    def depot(self, montant):
        if montant <= 0:
            return
        self.__solde += montant
    
    def retrait(self, montant):
        if montant <= 0:
            return
        self.__solde -= montant
    
    def __str__(self) -> str:
        return f"numero={self.numero}, proprietaire={self.proprietaire}, solde={self.solde}, date d'ouverture={self.date_ouverture}"
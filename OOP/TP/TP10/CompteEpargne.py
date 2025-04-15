
import Compte


class CompteEpargne(Compte.Compte):
    def __init__(self, numero: str, proprietaire: str, solde: int, date_ouverture: str, interet: str):
        super().__init__(numero, proprietaire, solde, date_ouverture)
        self.__interet = interet
    
    @property
    def interet(self) -> str:
        return self.__interet
    
    def __str__(self) -> str:
        return super().__str__() + f", interet={self.interet}"
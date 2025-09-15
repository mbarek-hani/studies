import Compte
from exceptions import SoldeInsuffisantError, ValeurInvalideError


class CompteCourant(Compte.Compte):
    def __init__(self, numero: str, proprietaire: str, solde: int, date_ouverture: str, montant_decouvert_autorise: str):
        super().__init__(numero, proprietaire, solde, date_ouverture)
        self.__montant_decouvert_autorise = montant_decouvert_autorise
    
    @property
    def montant_decouvert_autorise(self):
        return self.__montant_decouvert_autorise
    
    def retirer(self, montant):
        if montant <= 0:
            raise ValeurInvalideError()
        if montant <= self.montant_decouvert_autorise:
            if montant > self.__solde:
                raise SoldeInsuffisantError()
            self.__solde -= montant
        else:
            raise ValeurInvalideError()

    def __str__(self):
        return super().__str__() + f", montant_decouvert_autorise={self.montant_decouvert_autorise}"
    
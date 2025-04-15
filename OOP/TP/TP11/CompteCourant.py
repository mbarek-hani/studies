import Compte


class CompteCourant(Compte.Compte):
    def __init__(self, numero: str, proprietaire: str, solde: str, date_ouverture: str, montant_decouvert_autorise: str):
        super().__init__(numero, proprietaire, solde, date_ouverture)
        self.__montant_decouvert_autorise = montant_decouvert_autorise
    
    @property
    def montant_decouvert_autorise(self):
        return self.__montant_decouvert_autorise

    def __str__(self):
        return super().__str__() + f", montant_decouvert_autorise={self.montant_decouvert_autorise}"
    
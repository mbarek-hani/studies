from exc import LengthListContituantsError
from produit import ProduitElementaire, Composition, ProduitCompose
from test import Test

test = Test()

p1 = ProduitElementaire("Pain", "P1", 0.5)
p2 = ProduitElementaire("Farine", "P2", 0.2)
p3 = ProduitElementaire("Eau", "P3", 0.0)

test.assert_eq(p1.nom, "Pain")
test.assert_eq(p1.code, "P1")
test.assert_eq(p1.get_prix_HT(), 0.5)
test.assert_eq(str(p1), "ProduitElementaire(nom=Pain, code=P1, prixAchat=0.5)")

c1 = Composition(p1, 1)
c2 = Composition(p2, 0.5)
c3 = Composition(p3, 0.2)

test.assert_eq(c1.produit, p1)
test.assert_eq(c1.quantite, 1)
try: 
    pc1 = ProduitCompose("Pain de campagne", "PC1", 0.2, [c1, c2, c3])
    test.assert_raises(lambda: Composition(pc1, 15), TypeError)
    test.assert_eq(pc1.nom, "Pain de campagne")
    test.assert_eq(pc1.code, "PC1")
    test.assert_eq(pc1.get_prix_HT(), 0.8)
except LengthListContituantsError as e:
    print(e.getMessage)

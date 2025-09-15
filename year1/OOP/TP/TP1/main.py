from Commande import Commande
from Produit import Produit

print(Produit.nombre_produits())
p1 = Produit("REF001", "Ordinateur portable", 4500, 5100)
p2 = Produit("REF002", "Souris sans fil", 150, 199)

print(p1)
print(p2)

print(Produit.nombre_produits())
# Ajouter du stock
p1.augmenter_stock(10)
p2.augmenter_stock(50)

# Création d'une commande
commande = Commande()
commande.ajouter_produit(p1, 2)
commande.ajouter_produit(p2, 3)

# Affichage de la commande
commande.afficher_commande()
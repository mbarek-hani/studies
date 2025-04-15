TVA = 0.1
REMISE = 0.05

total_avant_taxe = 0

nbr_produit = int(input("Donner le nombre de produits à acheter : "))
while nbr_produit <= 0:
    nbr_produit = int(input("Donner le nombre de produits à acheter : "))

for i in range(1, nbr_produit + 1):
    qte = float(input("Donner la quantité du produit " + str(i) + " : "))
    prix = float(input("Donner le prix du produit " + str(i) + " : "))
    total_avant_taxe += qte * prix

facture = total_avant_taxe * (1 + TVA) * (1 - REMISE)

print("Le montant total est : ", facture)
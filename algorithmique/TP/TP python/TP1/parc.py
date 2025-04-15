TARIF_PLEIN = 200
TARIF_REDUIT = 190
RED_SPECIAL = 0.3
RED_NORMAL = 0.2

les_jours = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"]

tarif_final = 0

age = int(input("Quel âge as-tu ?"))
while age < 0:
    age = int(input("Quel âge-tu ?"))

jour = input("Quel jour aujourd'hui ?")
while jour.lower() not in les_jours:
    jour = input("Quel jour aujourd'hui ?")

if age < 12:
    tarif_final = TARIF_REDUIT
elif age <= 60:
    tarif_final = TARIF_PLEIN
else:
    tarif_final = TARIF_PLEIN * (1 - RED_SPECIAL)


if jour.lower() == "dimanche":
    tarif_final = tarif_final * (1 - RED_NORMAL)


print("le tarif final est ", tarif_final)
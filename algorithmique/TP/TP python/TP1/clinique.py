nbr_patient = int(input("Entrer le nombre des patients : "))
while nbr_patient <= 0:
    nbr_patient = int(input("Entrer le nombre des patients : "))

for i in range(1, nbr_patient + 1):
    
    tension_systolique = int(input("Entrer la tension systolique pour le patient "+ str(i) + " : "))
    tension_diastolique = int(input("Entrer la tension diastolique pour le patient "+ str(i) + " : "))
    frequence_cardiaque = int(input("Entrer la fréquence cardiaque pour le patient "+ str(i) + " : " ))

    if tension_systolique < 90 or tension_systolique > 120:
        print("Patient ", i, " : Tension systolique anormale")
    
    if tension_diastolique < 60 or tension_diastolique > 80:
        print("Patient ", i, " : Tension diastolique anormale")
    
    if frequence_cardiaque < 60 or frequence_cardiaque > 100:
        print("Patient ", i, " : Fréquence cardiaque anormale")
    


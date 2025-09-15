import csv

def analyze_transactions(file_path: str, revenue_min: float = 500) -> dict:
    # Initialisation des variables pour l'analyse
    total_revenue = 0
    produit_quantites: dict[str, float] = dict()
    produit_revenues: dict[str, float] = dict()
    
    # Lecture du fichier CSV
    try:
        with open(file_path, 'r') as f:
            lecteur = csv.DictReader(f)
            
            # Traitement de chaque transaction
            for ligne in lecteur:
                produit = ligne['Produit']
                quantite = float(ligne['Quantité'])
                prix = float(ligne['Prix'])
                
                # Calcul du revenu par produit et du revenu total
                produit_revenue = quantite * prix
                total_revenue += produit_revenue
                
                # Suivi des quantités et revenus par produit
                if produit in produit_quantites.keys():
                    produit_quantites[produit] += quantite
                else:
                    produit_quantites[produit] = quantite
                
                if produit in produit_revenues.keys():
                    produit_revenues[produit] += produit_revenue
                else:
                    produit_revenues[produit] = produit_revenue
    
    except FileNotFoundError:
        print(f"Erreur : Le fichier {file_path} n'a pas été trouvé.")
        quit(1)
    
    # Identification du produit le plus vendu
    max_value = max(produit_quantites.values())
    plus_vendus = [k for k, v in produit_quantites.items() if v == max_value]

    
    # Filtrer les produits dépassant le seuil de revenu
    produit_depassant_seuil = [
        (prod, rev) for prod, rev in produit_revenues.items() 
        if rev > revenue_min
    ]
    
    # Sauvegarde des résultats dans un fichier rapport
    with open('report.txt', 'w') as report_file:
        report_file.write(f"Revenu Total : {total_revenue:.2f} DH\n")
        report_file.write(f"Produit le Plus Vendu : {",".join(plus_vendus)}\n")
        report_file.write("Produits à Haut Revenu :\n")
        for produit, revenue in produit_depassant_seuil:
            report_file.write(f"\t- {produit} : {revenue:.2f} DH\n")
    
    return {
        'total_revenue': total_revenue,
        'plus_vendu': plus_vendus,
        'produit_depassant_seuil': produit_depassant_seuil
    }

# Exemple d'utilisation
if __name__ == "__main__":
    # Analyse des transactions avec un seuil de 500 MAD
    results = analyze_transactions('transactions.csv', 20)
    print(results)
    print("Analyse des transactions est terminée.\nVeuillez consultez le fichier report.txt")


<?php
declare(strict_types=1);

/*
class Employe {
    public function __construct(
        private string $matricule,
        private string $nom,
        private string $prenom,
        private DateTime $dateNaissance,
        private DateTime $dateEmbauche,
        private float $salaire 
    ) {}

    public function getMatricule():string {
        return $this->matricule;
    }

    public function setMatricule(string $matricule) {
        $this->matricule = $matricule;
    }

    public function getNom():string {
        return $this->nom;
    }

    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function getPrenom():string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom;
    }

    public function getDateNaissance():DateTime {
        return $this->dateNaissance;
    }

    public function setDateNaissance(DateTime $dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    public function getDateEmbauche():DateTime {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(DateTime $dateEmbauche) {
        $this->dateEmbauche = $dateEmbauche;
    }

    public function getSalaire():float {
        return $this->salaire;
    }

    public function setSalaire(float $salaire) {
        $this->salaire = $salaire;
    }

    public function anciennete(): int {
        $currentDateTime = new DateTime();
        return $currentDateTime->diff($this->getDateEmbauche(), true)->y;
    }

    public function augmentationDuSalaire():void {
        $anciennete = $this->anciennete();
        if ($anciennete < 5) {
            $this->salaire += $this->salaire * 0.02;
        }else if ($anciennete < 10) {
            $this->salaire += $this->salaire * 0.05;
        }else {
            $this->salaire += $this->salaire * 0.1;
        }
    }

    public function afficherEmploye():void {
        $dateNaissanceStr = $this->dateNaissance->format("Y-m-d H:i:s");
        $dateEmbaucheStr = $this->dateEmbauche->format("Y-m-d H:i:s");
        echo "Employe(\n\tmatricule: $this->matricule,\n\tnome: $this->nom,\n\tprenom: $this->prenom,\n\tdateNaissance: $dateNaissanceStr,\n\tdateEmbauche: $dateEmbaucheStr,\n\tsalaire: $this->salaire\n)";
    }
}
*/

interface Serialisable {
    public function serialiser(): string;
    public function deserialiser(string $data): void;
}


abstract class Personne {
    public function __construct(
        protected string $nom,
        protected string $prenom,
        protected DateTime $dateNaissance
    ) {
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getDateNaissance(): DateTime {
        return $this->dateNaissance;
    }

    public function setDateNaissance(DateTime $dateNaissance): void {
        $this->dateNaissance = $dateNaissance;
    }

    public function formaterNom(): string {
        return strtoupper($this->nom) . " " . ucfirst(strtolower($this->prenom));
    }

    abstract public function afficherDetails(): void;
}

class Employe extends Personne implements Serialisable {
    private string $matricule;
    private DateTime $dateEmbauche;
    private float $salaire;

    public function __construct(
        string $matricule,
        string $nom,
        string $prenom,
        DateTime $dateNaissance,
        DateTime $dateEmbauche,
        float $salaire
    ) {
        parent::__construct($nom, $prenom, $dateNaissance);
        $this->matricule = $matricule;
        $this->dateEmbauche = $dateEmbauche;
        $this->salaire = $salaire;
    }

    public function getMatricule(): string {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): void {
        $this->matricule = $matricule;
    }

    public function getDateEmbauche(): DateTime {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(DateTime $dateEmbauche): void {
        $this->dateEmbauche = $dateEmbauche;
    }

    public function getSalaire(): float {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): void {
        $this->salaire = $salaire;
    }

    public function anciennete(): int {
        $currentDateTime = new DateTime();
        return $currentDateTime->diff($this->dateEmbauche, true)->y;
    }

    public function augmentationDuSalaire(): void {
        $anciennete = $this->anciennete();
        if ($anciennete < 5) {
            $this->salaire += $this->salaire * 0.02;
        } elseif ($anciennete < 10) {
            $this->salaire += $this->salaire * 0.05;
        } else {
            $this->salaire += $this->salaire * 0.1;
        }
    }

    public function afficherDetails(): void {
        echo "--------- DÉTAILS DE L'EMPLOYÉ ---------\n";
        echo "Matricule: " . $this->matricule . "\n";
        echo "Nom complet: " . $this->formaterNom() . "\n";
        echo "Date de naissance: " . $this->dateNaissance->format("d/m/Y") . "\n";
        echo "Date d'embauche: " . $this->dateEmbauche->format("d/m/Y") . "\n";
        echo "Ancienneté: " . $this->anciennete() . " ans\n";
        echo "Salaire: " . $this->salaire . " DH\n";
        echo "----------------------------------------\n";
    }

    public function afficherEmploye(): void {
        $dateNaissanceStr = $this->dateNaissance->format("Y-m-d H:i:s");
        $dateEmbaucheStr = $this->dateEmbauche->format("Y-m-d H:i:s");
        echo "Employe(\n\tmatricule: $this->matricule,\n\tnom: $this->nom,\n\tprenom: $this->prenom,\n\tdateNaissance: $dateNaissanceStr,\n\tdateEmbauche: $dateEmbaucheStr,\n\tsalaire: $this->salaire\n)\n";
    }

    public function serialiser(): string {
        $data = [
            'matricule' => $this->matricule,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'dateNaissance' => $this->dateNaissance->format('Y-m-d H:i:s'),
            'dateEmbauche' => $this->dateEmbauche->format('Y-m-d H:i:s'),
            'salaire' => $this->salaire
        ];
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function deserialiser(string $data): void {
        $array = json_decode($data, true);
        if ($array) {
            $this->matricule = $array['matricule'];
            $this->nom = $array['nom'];
            $this->prenom = $array['prenom'];
            $this->dateNaissance = new DateTime($array['dateNaissance']);
            $this->dateEmbauche = new DateTime($array['dateEmbauche']);
            $this->salaire = $array['salaire'];
        }
    }

    public function __sleep(): array {
        echo "Serialisation de l'employe {$this->matricule}...\n";
        return ['matricule', 'nom', 'prenom', 'dateNaissance', 'dateEmbauche', 'salaire'];
    }

    public function __serialize(): array {
        $data = [
            'matricule' => $this->matricule,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'dateNaissance' => $this->dateNaissance->format('Y-m-d H:i:s'),
            'dateEmbauche' => $this->dateEmbauche->format('Y-m-d H:i:s'),
            'salaire' => $this->salaire
        ];
        return $data;
    }

    public function __wakeup(): void {
        echo "Deserialisation de l'employe {$this->matricule}...\n";
    }

    public function __call(string $name, array $arguments) {
        if (strpos($name, 'get') === 0) {
            $property = lcfirst(substr($name, 3));
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
        throw new Exception("use of undefined method $name");
    }

    public function __toString(): string {
        return "Employe: {$this->formaterNom()} (Matricule: {$this->matricule})";
    }
}

$person = new Employe(
    matricule: "AJ125L",
    nom: "hani",
    prenom: "mbarek",
    dateNaissance: new DateTime("2001-04-12 00:00:00"),
    dateEmbauche: new DateTime("2010-04-12 00:00:00"),
    salaire: 5000.0
);


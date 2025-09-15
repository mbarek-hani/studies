<?php
    class Person {
        public function __construct(
            public string $nom,
            public string $prenom,
            public DateTime $dateNaissance
        ) {}

        public function presenter(): string{
            return "je m'appele {$this->nom} {$this->prenom}";
        }

        public function age():int{
            return (new DateTime)->diff($this->dateNaissance, true)->y;
        }
    }

    $person1 = new Person(
        nom: "hani",
        prenom: "mbarek",
        dateNaissance: new DateTime("2001-12-04")
    );
    $person2 = new Person(
        nom: "azarguy",
        prenom: "yassine",
        dateNaissance: new DateTime("2003-09-04")
    );
    
    echo $person1->presenter() . PHP_EOL;
    echo $person2->presenter() . PHP_EOL;

    echo $person1->age();
?>

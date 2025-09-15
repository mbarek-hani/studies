function valeurAbsolue(nombre) {
    return nombre < 0 ? -nombre : nombre;
}

function decimalVersBindaire(nombre) {
    if (nombre == 0) {
        return "0";
    }

    let resultat = "";
    let n = nombre;

    while (n > 0) {
        resultat = (n % 2) + resultat;
        n = parseInt(n / 2);
    }

    return resultat;
}

function factorielle(nombre) {
    if (nombre == 0 || nombre == 1) {
        return 1;
    }
    return nombre * factorielle(nombre - 1);
}

// Exemples d'utilisation
console.log(decimalVersBindaire(5));

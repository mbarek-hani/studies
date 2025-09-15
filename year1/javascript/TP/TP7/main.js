let n = 10;

let id = setInterval(() => {
    console.log(n--);
    if (n == 0) {
        clearInterval(id);
        console.log("s'est terminée");
    }
}, 1000);

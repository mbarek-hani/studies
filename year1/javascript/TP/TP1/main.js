function circleArea(radius) {
    return Math.PI * radius * radius;
}

function circleCircumference(radius) {
    return 2 * Math.PI * radius;
}

const btn = document.getElementById("btn");
const surface = document.getElementById("surface");
const circumference = document.getElementById("Circumference");
const error = document.getElementById("error");
const radiusInput = document.getElementById("radius");

btn.addEventListener("click", () => {
    if (isNaN(radiusInput.value)) {
        error.innerText = "Veuillez entrer un nombre";
        surface.innerText = "";
        circumference.innerText = "";
        return;
    }
    const radius = parseFloat(radiusInput.value);
    error.innerText = "";
    surface.innerHTML = `La surface d'une cercle de rayon = <span class="green">${radius}</span> est <span class="green">${circleArea(
        radius
    ).toFixed(2)}</span>`;
    circumference.innerHTML = `Le circomférence d'une cercle de rayon = <span class="green">${radius}</span> est <span class="green">${circleCircumference(
        radius
    ).toFixed(2)}</span>`;
});

import express from "express";

const PORT = 8000;
const app = express();

app.get("/", (req, res) => {
    res.send("Bienvenue à mon api");
});

app.get("/api/profil", (req, res) => {
    res.json({
        nom: "",
        prenom: "",
        age: 0,
        formation: "",
        competences: []
    });
});

app.get("/api/contact", (req, res) => {
    res.json({
        email: "",
        ville: ""
    });
});


app.listen(PORT, () => {
    console.log(`Server is listening on port ${PORT}...`);
});
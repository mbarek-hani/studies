import express from "express";

const PORT = 8000;
const app = express();

app.get("/about", (req, res) => {
    return res.send("Page A propos - Mon premier serveur Express");
});

app.get("/api/info", (req, res) => {
    return res.json({
        name: "Mon Api",
        version: "v1.0.0",
        auteur: "mbarek"
    });
})

app.listen(PORT, () => {
    console.log(`Server is listening on port ${PORT}`);
});
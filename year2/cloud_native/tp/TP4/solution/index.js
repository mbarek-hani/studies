import express from "express";
import mongoose from "mongoose";
import cors from "cors";
import morgan from "morgan";
import { authenticateToken, authorizeRole } from "./middlewares/index.js";

import User from "./models/User.js";

const app = express();

app.use(cors());
app.use(morgan("dev"));
app.use(express.json());

app.get(
  "/api/admin/users",
  authenticateToken,
  authorizeRole("admin"),
  async (req, res) => {
    const users = await User.find().select("-password");
    res.json({ users });
  },
);

app.post("/api/auth/register", async (req, res) => {
  try {
    const { nom, email, password } = req.body;
    // Verifier si l ’ email existe
    const existingUser = await User.findOne({ email });
    if (existingUser) {
      return res.status(400).json({ error: "Email deja utilise" });
    }
    // Hasher le mot de passe
    const hashedPassword = await bcrypt.hash(password, 12);
    // Creer l ’ utilisateur
    const user = await User.create({
      nom,
      email,
      password: hashedPassword,
    });
    // Generer le token
    const token = jwt.sign(
      { id: user._id, email: user.email, role: user.role },
      JWT_SECRET,
      { expiresIn: "24h" },
    );
    res.status(201).json({ success: true, token });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.post("/api/auth/login", async (req, res) => {
  try {
    const { email, password } = req.body;
    // Trouver l ’ utilisateur
    const user = await User.findOne({ email });
    if (!user) {
      return res.status(401).json({ error: "Email ou mot de passe incorrect" });
    }
    // Verifier le mot de passe
    const isMatch = await bcrypt.compare(password, user.password);
    if (!isMatch) {
      return res.status(401).json({ error: "Email ou mot de passe incorrect" });
    }
    // Generer le token
    const token = jwt.sign(
      { id: user._id, email: user.email, role: user.role },
      JWT_SECRET,
      { expiresIn: "24h" },
    );
    res.json({
      success: true,
      token,
      user: { nom: user.nom, email: user.email },
    });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.get("/api/profile", authenticateToken, async (req, res) => {
  const user = await User.findById(req.user.id).select("-password");
  res.json({ user });
});

app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: "Erreur serveur" });
});

mongoose
  .connect(process.env.DB_URI)
  .then(() => console.log("MongoDB connecte"));

const PORT = process.env.PORT;
app.listen(PORT, () => console.log(`Server is listening on port ${PORT}`));

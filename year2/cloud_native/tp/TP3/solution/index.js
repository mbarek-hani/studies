import express from "express";
import livreRouter from "./routes/livreRoutes.js";
import "./config/db.js";

const app = express();

app.use(express.json());

app.use("/livres", livreRouter);

const PORT = process.env.PORT;

app.listen(PORT, () =>
  console.log(`server is running on http://localhost:${PORT}`),
);

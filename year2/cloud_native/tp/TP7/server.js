import express from "express";
import { setupLogging } from "./logging.js";
import { setupProxies } from "./proxy.js";
import { setupAuth } from "./auth.js";
import { ROUTES } from "./routes.js";

const app = express();

setupLogging(app);
setupProxies(app, ROUTES);
setupAuth(app, ROUTES);

app.listen(8000, () => {
  console.log(`Server started listening on localhost:8000`);
});

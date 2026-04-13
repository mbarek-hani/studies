import session from "express-session";
import Keycloak from "keycloak-connect";

export const setupAuth = (app, routes) => {
  var memoryStore = new session.MemoryStore();
  var keycloak = new Keycloak({ store: memoryStore });

  app.use(
    session({
      secret: "<RANDOM GENERATED TOKEN>",
      resave: false,
      saveUninitialized: true,
      store: memoryStore,
    }),
  );

  app.use(keycloak.middleware());

  routes.forEach((r) => {
    if (r.auth) {
      app.use(r.url, keycloak.protect());
    }
  });
};

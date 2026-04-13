export const ROUTES = [
  {
    url: "/free",
    auth: false,
    creditCheck: false,
    rateLimit: {
      windowMs: 5 * 1000,
      max: 1,
    },
    proxy: {
      target: "https://www.google.com",
      changeOrigin: true,
      pathRewrite: {
        [`^/free`]: "",
      },
    },
  },
  {
    url: "/premium",
    auth: true,
    creditCheck: true,
    proxy: {
      target: "https://www.google.com",
      changeOrigin: true,
      pathRewrite: {
        [`^/premium`]: "",
      },
    },
  },
];

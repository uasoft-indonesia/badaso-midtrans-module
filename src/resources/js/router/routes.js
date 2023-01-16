import Pages from "./../pages/index.vue";

let prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  : "/badaso-dashboard";

export default [
  {
    path: prefix + "/midtrans/configuration",
    name: "MidtransConfiguration",
    component: Pages,
    meta: {
      title: "Midtrans Configuration",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/midtrans/key-configuration",
    name: "MidtransKeyConfiguration",
    component: Pages,
    meta: {
      title: "Midtrans Key Configuration",
      useComponent: "AdminContainer",
    },
  },
];

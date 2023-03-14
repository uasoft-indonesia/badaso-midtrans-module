import Pages from "./../pages/index.vue";

let prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  : "/badaso-dashboard";

export default [
  {
    path: prefix + "/midtrans/payment-type",
    name: "MidtransPayments",
    component: Pages,
    meta: {
      title: "Midtrans Payment Type",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/midtrans/configuration",
    name: "MidtransConfigurations",
    component: Pages,
    meta: {
      title: "Midtrans Configuration",
      useComponent: "AdminContainer",
    },
  },
];

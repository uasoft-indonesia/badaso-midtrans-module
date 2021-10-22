<template>
  <div @click="openSnap()">
    <slot />
  </div>
</template>

<script>
import api from "../../js/api/index";
export default {
  props: {
    order: Object,
  },
  created() {
    this.fetchConfig();
  },
  methods: {
    fetchConfig() {
      if (document.getElementsByClassName("midtrans-script").length === 0) {
        this.$openLoading();
        api.badasoSnap
          .getConfig()
          .then((res) => {
            let script = document.createElement("script");
            script.setAttribute("class", "midtrans-script");
            script.setAttribute("type", "text/javascript");
            script.setAttribute("src", res.data.baseUrl);
            script.setAttribute("data-client-key", res.data.clientKey);
            document.head.appendChild(script);
          })
          .catch((err) => {
            this.$helper.displayErrors(err);
          })
          .finally(() => {
            this.$closeLoading();
          });
      }
    },
    openSnap() {
      snap.pay(this.order.orderPayment.token, {
        onSuccess: (result) => {
          window.scrollTo(0, 0)
          this.$router.push({
            name: "Order",
          }).catch(() => {})
        },
        onPending: (result) => {
          window.scrollTo(0, 0)
          this.$router.push({
            name: "Order",
          }).catch(() => {})
        },
        onError: (error) => {
          this.$helper.displayErrors(error);
        },
        onClose: () => {
          window.scrollTo(0, 0)
        },
      });
    },
  },
};
</script>
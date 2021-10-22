<template>
  <div @click="emit(option)">
    <slot />
  </div>
</template>

<script>
import api from "../../js/api/index";
export default {
  props: {
    option: Object,
    value: String,
  },
  created() {
    this.fetchConfig();
  },
  methods: {
    emit(o) {
      this.$emit("input", o.slug);
      this.$emit("checkout", this.checkout);
    },
    checkout(resOrder) {
      this.fetchSnapToken(resOrder);
    },
    fetchSnapToken(resOrder) {
      this.$openLoading();
      api.badasoSnap
        .getSnapToken({
          id: resOrder.data.order,
          paymentType: 'bni_va'
        })
        .then((res) => {
          snap.pay(res.data.token, {
            onSuccess: (result) => {
              this.$router.push({
                name: "Order",
              });
            },
            onPending: (result) => {
              this.$router.push({
                name: "Order",
              });
            },
            onError: (error) => {
              this.$helper.displayErrors(error);
              this.$router.push({
                name: "Order",
              });
            },
            onClose: () => {
              this.$router.push({
                name: "Order",
              });
            },
          });
        })
        .catch((err) => {
          this.$helper.displayErrors(err);
        })
        .finally(() => {
          this.$closeLoading();
        });
    },
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
  },
};
</script>
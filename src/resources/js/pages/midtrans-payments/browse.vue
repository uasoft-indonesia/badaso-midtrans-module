<template>
  <div>
    <badaso-breadcrumb-row />
    <vs-row v-if="$helper.isAllowed('browse_midtrans_payments')">
      <vs-col vs-lg="12">
        <vs-card>
          <vs-row>
            <vs-col v-for="payment, index in payments" :key="index">
              <vs-table :data="payment.options">
                <template slot="header">
                  <div :style="{marginTop: index === 0 ? '0' : '16px'}">
                    <h2>{{ payment.name }}</h2>
                    <badaso-switch
                      v-model="payment.isActive"
                      @input="savePayment($event, payment)"
                    ></badaso-switch>
                  </div>
                </template>
                <template slot="thead">
                  <vs-th style="width: 25%;">
                    Icon
                  </vs-th>
                  <vs-th style="width: 25%;">
                    Name
                  </vs-th>
                  <vs-th style="width: 25%;">
                    Slug
                  </vs-th>
                  <vs-th style="width: 25%;">
                    Active
                  </vs-th>
                </template>

                <template slot-scope="{ data }">
                  <vs-tr v-for="d, idx in data" :key="idx">
                    <vs-td :data="d.image">
                      <img :src="d.image" width="40">
                    </vs-td>
                    <vs-td :data="d.name">
                      {{ d.name }}
                    </vs-td>
                    <vs-td :data="d.slug">
                      {{ d.slug }}
                    </vs-td>
                    <vs-td :data="d.isActive">
                      <badaso-switch
                        v-model="d.isActive"
                        @input="saveOption($event, d)"
                      ></badaso-switch>
                    </vs-td>
                  </vs-tr>
                </template>
              </vs-table>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>
<script>
import _ from "lodash";

export default {
  name: "MidtransPayments",
  data: () => ({
    payments: [],
  }),
  mounted() {
    this.getPaymentList();
  },
  methods: {
    getPaymentList() {
      this.$openLoader();
      this.$api.badasoMidtrans
        .browseConfiguration()
        .then((response) => {
          this.payments = response.data.payments;
        })
        .catch((error) => {
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        })
        .finally(() => {
          this.$closeLoader();
        })
    },
    savePayment(event, payment) {
      this.$openLoader();
      this.$api.badasoMidtrans
        .savePaymentConfiguration({
          id: payment.id,
          isActive: event
        })
        .then((response) => {
          this.getPaymentList()
        })
        .catch((error) => {
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        })
        .finally(() => {
          this.$closeLoader();
        })
    },
    saveOption(event, option) {
      this.$openLoader();
      this.$api.badasoMidtrans
        .saveOptionConfiguration({
          id: option.id,
          isActive: event
        })
        .then((response) => {
          this.getPaymentList()
        })
        .catch((error) => {
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        })
        .finally(() => {
          this.$closeLoader();
        })
    }
  },
};
</script>

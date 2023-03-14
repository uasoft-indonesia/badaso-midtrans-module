<template>
  <div>
    <badaso-breadcrumb-row />
    <vs-row
      v-if="$helper.isAllowed('browse_midtrans_configurations') && groupList.length > 0"
    >
      <vs-col vs-lg="12">
        <vs-card>
          <vs-tabs :color="adminPanelHeaderFontColor">
            <vs-tab
              v-for="(group, index) in groupList"
              :key="index"
              :label="group.label"
            >
              <vs-row
                class="site-management__container"
                v-for="(config, index) in filterConfigurations('midtransModule')"
                :key="index"
              >
                <badaso-text
                  v-if="config.type === 'text'"
                  :label="config.displayName"
                  :placeholder="config.value"
                  v-model="config.value"
                  size="10"
                ></badaso-text>

                <badaso-switch
                  v-if="config.type === 'switch'"
                  :label="config.displayName"
                  size="10"
                  v-model="config.value"
                 :tooltip="$t('midtrans.help.paymentTypeByBadaso')"
                ></badaso-switch>

                <badaso-hidden
                  v-if="config.type === 'hidden'"
                  :label="config.displayName"
                  :placeholder="config.value"
                  v-model="config.value"
                ></badaso-hidden>

                <vs-col vs-lg="2">
                  <br />
                  <vs-button
                    color="danger"
                    type="relief"
                    @click.stop
                    @click="openConfirm(config.id)"
                    v-if="
                      $helper.isAllowed('delete_configurations') &&
                        config.canDelete
                    "
                    ><vs-icon icon="delete"></vs-icon>
                  </vs-button>
                </vs-col>
              </vs-row>
            </vs-tab>
          </vs-tabs>
        </vs-card>
      </vs-col>
      <vs-col vs-lg="12">
        <vs-card class="action-card">
          <vs-row>
            <vs-col vs-lg="12">
              <vs-button
                color="primary"
                type="relief"
                @click="submitMultipleEdit"
              >
                <vs-icon icon="save"></vs-icon> {{ $t("site.edit.multiple") }}
              </vs-button>
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
  name: "MidtransConfigurations",
  components: {},
  data: () => ({
    configurations: [],
    willDeleteConfigurationId: null,
  }),
  computed: {
    groupList: {
      get() {
        return [
          {
            label: 'Midtrans Configurations',
            value: 'midtransModule'
          }
        ]
      },
    },
    adminPanelHeaderFontColor: {
      get() {
        return "#06bbd3";
      },
    },
  },
  mounted() {
    this.getConfigurationList();
  },
  methods: {
    openConfirm(id) {
      this.willDeleteConfigurationId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteConfiguration,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {
          this.willDeleteConfigurationId = null;
        },
      });
    },
    acceptAlert(color) {
      this.$vs.notify({
        color: "danger",
        title: this.$t("site.deletedImage.title"),
        text: this.$t("site.deletedImage.text"),
      });
    },
    getConfigurationList() {
      this.$openLoader();
      this.$api.badasoConfiguration
        .browse()
        .then((response) => {
          this.$closeLoader();
          let configurations = response.data.configurations.map((data) => {
            try {
              data.details = JSON.parse(data.details);
              if (data.type === "hidden") {
                data.value = data.details.value ? data.details.value : "";
              }
              if (data.type === "switch") {
                data.value = data.value == "1" ? true : false;
              }
              const typeRequiredItems = [
                "checkbox",
                "radio",
                "select",
                "select_multiple",
              ];
              if (typeRequiredItems.includes(data.type)) {
                if (!data.details || !data.details.items) {
                  data.details = {};
                  data.details.items = [];
                  this.$vs.notify({
                    title: this.$t("alert.danger"),
                    text:
                      "Invalid options for Checkbox, Radio, Select, Select-multiple.",
                    color: "danger",
                  });
                }
              }
            } catch (error) {}
            return data;
          });
          this.configurations = JSON.parse(JSON.stringify(configurations));
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    filterConfigurations(group) {
      return _.filter(this.configurations, ["group", group]);
    },
    deleteConfiguration() {
      this.$openLoader();
      this.$api.badasoConfiguration
        .delete({
          id: this.willDeleteConfigurationId,
        })
        .then((response) => {
          this.$closeLoader();
          this.getConfigurationList();
          this.$store.commit("badaso/FETCH_MENU");
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    submitForm(config) {
      this.$openLoader();
      this.$api.badasoConfiguration
        .edit(this.$caseConvert.snake(config))
        .then((response) => {
          this.$closeLoader();
          this.getConfigurationList();
          this.$store.commit("badaso/FETCH_CONFIGURATION");
          this.$vs.notify({
            title: this.$t("alert.success"),
            text: this.$t("site.configUpdated"),
            color: "success",
          });
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    submitMultipleEdit() {
      this.$openLoader();
      this.$api.badasoConfiguration
        .editMultiple({ configurations: this.configurations })
        .then((response) => {
          this.$closeLoader();
          this.getConfigurationList();
          this.$store.commit("badaso/FETCH_CONFIGURATION");
          this.$vs.notify({
            title: this.$t("alert.success"),
            text: this.$t("site.configUpdated"),
            color: "success",
          });
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
  },
};
</script>

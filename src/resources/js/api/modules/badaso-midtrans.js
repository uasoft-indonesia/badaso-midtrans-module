import resource from "../../../../../../core/src/resources/js/api/resource";
import QueryString from "../../../../../../core/src/resources/js/api/query-string";

let apiPrefix = process.env.MIX_API_ROUTE_PREFIX
  ? "/" + process.env.MIX_API_ROUTE_PREFIX + "/module/midtrans"
  : "/badaso-api/module/midtrans";

export default {
  browseConfiguration(data = {}) {
    let ep = apiPrefix + "/v1/payment/configuration";
    let qs = QueryString(data);
    let url = ep + qs;
    return resource.get(url);
  },

  savePaymentConfiguration(data) {
    return resource.post(apiPrefix + "/v1/payment/configuration/save/payment", data);
  },

  saveOptionConfiguration(data) {
    return resource.post(apiPrefix + "/v1/payment/configuration/save/option", data);
  },
};

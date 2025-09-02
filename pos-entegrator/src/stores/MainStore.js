import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";

export const useMainStore = defineStore("MainStore", {
  state: () => ({
    isTestMode: window.gpos.is_test_mode,
    paymentGateways: window.gpos.payment_gateways || [],
    pluginVersion: window.gpos.version,
    dashboard: window.gpos.dashboard || {},
    homeUrl: window.gpos.home_url || "",
  }),
  actions: {
    async updateTestMode(isTestMode) {
      return await ajax.post("update_test_mode", { test_mode: isTestMode });
    },
    gatewayCanRefund(transaction) {
      const gateway = this.paymentGateways.find(
        (gateway) => gateway.id === transaction.payment_gateway_id
      );
      return gateway && gateway.supports.includes("refund");
    },
  },
});

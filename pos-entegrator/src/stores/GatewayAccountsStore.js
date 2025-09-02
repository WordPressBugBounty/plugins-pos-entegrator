import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";

export const useGatewayAccounts = defineStore("GatewayAccounts", {
  state: () => ({
    virtualPOSAccounts: window.gpos.virtual_pos_accounts || [],
    alternativeAccounts: window.gpos.alternative_payment_accounts || [],
    commonFormAccounts: window.gpos.common_form_accounts || [],
    iFrameAccounts: window.gpos.iframe_accounts || [],
  }),
  actions: {
    async addGatewayAccount(gateway) {
      return await ajax.post("add_gateway_account", { gateway });
    },
    async getGatewayAccounts() {
      const data = await ajax.get("get_gateway_accounts");
      this.virtualPOSAccounts = data;
    },
    updateActiveStatus(id, status) {
      ajax.post("update_active_status", { id, status });
    },
    async updateDefaultStatus(id, status) {
      return await ajax.post("update_default_status", { id, default: status });
    },
  },
});

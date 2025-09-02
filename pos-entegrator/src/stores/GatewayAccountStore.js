import { defineStore } from "pinia";
import ajax from "../plugins/ajax";
import Swal from "sweetalert2";

export const useGatewayAccount = defineStore("GatewayAccount", {
  state: () => ({
    gatewayAccount: window.gpos.gateway_account || {},
    assetsUrl: window.gpos.assets_url || "/",
  }),
  actions: {
    async updateAccountSettings() {
      const response = await ajax.post("update_account_settings", {
        id: this.gatewayAccount.id,
        gateway_id: this.gatewayAccount.gateway_id,
        settings: this.gatewayAccount.gateway_settings,
      });
      this.swal(this.gatewayAccount.gateway_property.save_message.message, this.gatewayAccount.gateway_property.save_message.type);
      if (response) {
        this.gatewayAccount.id = response.id;
      }
    },
    async updateGatewayAccount() { },
    async updateInstallments() {
      await ajax.post("update_installments", {
        id: this.gatewayAccount.id,
        installments: this.gatewayAccount.installments,
      });
      this.swal(window.gpos.alert_texts.setting_saved);
    },
    async resetInstallments() {
      await ajax.post("update_installments", {
        id: this.gatewayAccount.id,
        installments: false,
      });
      this.swal(window.gpos.alert_texts.setting_saved, "success", () => {
        window.location.reload();
      });
    },
    async getInstallments() {
      const data = await ajax.post("get_installments_from_api", {
        id: this.gatewayAccount.id,
      });
      let res = {};
      if (data.result === "success") {
        this.gatewayAccount.installments = data.installments;
        res = {
          text: window.gpos.alert_texts.installments_applied,
          icon: "success",
        };
      } else {
        res = {
          text: `${window.gpos.alert_texts.installments_get_error} : ${data.installments}`,
          icon: "error",
        };
      }
      this.swal(res.text, res.icon);
    },
    async updateInstallmentStatus() {
      await ajax.post("update_installment_status", {
        id: this.gatewayAccount.id,
        status: this.gatewayAccount.is_installments_active,
      });
    },
    async testConnection(gateway_id) {
      const data = await ajax.post("check_connection", {
        gateway_id,
        settings: this.gatewayAccount.gateway_settings,
      });

      this.swal(data.message, data.result);
    },
    async deleteAccount() {
      await ajax.post("remove_gateway_account", {
        id: this.gatewayAccount.id,
      });
      this.swal(window.gpos.alert_texts.deletion_completed, "success", () => {
        window.location.href = "/wp-admin/admin.php?page=gpos-payment-methods";
      });
    },
    swal(text, icon = "success", callback) {
      Swal.fire({
        html: text,
        icon: icon,
        confirmButtonText: window.gpos.alert_texts.ok,
        confirmButtonColor: "#1A56DB",
      }).then(callback);
    },
  },
});

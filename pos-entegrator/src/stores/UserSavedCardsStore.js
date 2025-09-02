import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";
import Swal from "sweetalert2";

export const useUserSavedCards = defineStore("UserSavedCards", {
  state: () => ({
    isProActive: window.gpos.is_pro_active || false,
    isTestMode: window.gpos.is_test_mode || false,
    assetsUrl: window.gpos.asset_dir_url || "/",
    savedCards: window.gpos.saved_cards || [],
  }),
  actions: {
    async setDefault(id) {
      await ajax.post("set_default_saved_card", { id });
      this.swalFire();
    },
    async deleteCard(id) {
      await ajax.post("delete_saved_card", { id });
      this.swalFire();
    },
    swalFire() {
      Swal.fire({
        html: window.gpos.alert_texts.process_success,
        icon: "success",
        confirmButtonText: window.gpos.alert_texts.ok,
        confirmButtonColor: "#1A56DB",
      }).then(() => window.location.reload());
    },
  },
});

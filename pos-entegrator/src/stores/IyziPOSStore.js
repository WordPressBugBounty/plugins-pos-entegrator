import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";

export const useIyziPOS = defineStore("IyziPOS", {
  actions: {
    async getSavedCards() {
      return await ajax.post("get_iyzipos_saved_cards")
    },
    async saveCard(data) {
      return await ajax.post("iyzipos_save_card", data)
    },
    async updateGateway() {
      return await ajax.post("iyzipos_update_gateway")
    },
  },
});

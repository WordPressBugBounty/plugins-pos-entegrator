import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";

export const useUiStore = defineStore("UiStore", {
  state: () => ({
    loading: false,
  }),
  actions: {
    async hideRatingMessage() {
      return await ajax.post("hide_notice").then(() => {
        window.location.reload();
      });
    },
  },
});

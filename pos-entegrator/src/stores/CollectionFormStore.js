import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";
import Swal from "sweetalert2";

export const useCollectionFormStore = defineStore("CollectionFormStore", {
  state: () => ({
    form: window.gpos.collection_form || {},
  }),
  actions: {
    async updateOrSaveForm() {
      const data = await ajax.post("collection_form_update_or_save", {
        ...this.form,
      });
      Swal.fire({
        html: window.gpos.alert_texts.process_success,
        icon: "success",
        confirmButtonText: window.gpos.alert_texts.ok,
        confirmButtonColor: "#1A56DB",
      }).then(() => data && !this.form.id ? window.location.href = data : null);
    },
  },
});

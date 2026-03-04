import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";
import Swal from "sweetalert2";


export const useCollectionCheckoutStore = defineStore("CollectionCheckoutStore", {
  state: () => ({
    collectionForm: window.gpos.collection_form,
    checkout_data: {
      key: "",
      form_id: window.gpos.collection_form.id,
      checkout_url: window.gpos.checkout_url,
      amount_name: window.gpos.collection_form.payment_settings.payment_amount_name ?? "Collection",
      total: 0,
      sub_total: 0,
      tax_total: 0,
      tax_rate: 0,
      currency: "TRY",
      customer_first_name: "",
      customer_last_name: "",
      customer_email: "",
      customer_phone: "",
      customer_address: "",
      customer_city: "",
      customer_state: "",
      customer_country: "",
      customer_zipcode: "",
      customer_company_name: "",
      customer_tax_number: "",
      customer_tax_type: "",
      customer_tax_office: "",
    }
  }),
  actions: {
    async processPayment() {
      if (!this.checkout_data.total) {
        Swal.fire({
          html: "Ödeme tutarı boş bırakılamaz!",
          icon: "error",
          confirmButtonText: window.gpos.alert_texts.ok,
          confirmButtonColor: "#C81E1E",
        });
        return;
      }
      const { data } = await ajax.post("collection_process_payment", {
        ...this.checkout_data,
        ...window.gpos.fragment,
        _gpos_nonce: document.getElementById("_gpos_nonce").value,
      });

      if (data.redirect) {
        window.location.href = data.redirect;
      } else {
        console.error(data.error_message);
      }
    },
    async initialize() {
      this.checkout_data.key = await this.getKey();

      const { is_valid_key } = await ajax.post("collection_init", {
        key: this.checkout_data.key,
      });

      if (!is_valid_key) {
        this.checkout_data.key = await this.getKey(true);
      }

    },
    async getKey(force = false) {
      let key = window.localStorage.getItem("gpos_collection_key");
      if (!key || force) {
        key = Math.random().toString(36).substring(2, 15);
        window.localStorage.setItem("gpos_collection_key", key);
      }
      return key;
    }

  },
});

import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";

export const useCheckout = defineStore("Checkout", {
  state: () => ({
    card: {
      bin: "",
      expiry_month: "",
      expiry_year: "",
      cvv: "",
      type: "",
      brand: "",
      family: "",
      bank_name: "",
      bank_code: "",
      country: "",
      country_code: "",
    },
    requested: {
      bin: "",
      installment: 1,
    },
    binRetrieveReq: false,
    saveCurrentCard: false,
    selectedInstallment: "1",
    selectedSavedCard: "",
    accountId: "",
    // Window Variables
    userId: window.gpos.user_id || false,
    isProActive: window.gpos.is_pro_active || false,
    isTestMode: window.gpos.is_test_mode || false,
    isInstallmentsActive: window.gpos.is_installments_active || false,
    assetsUrl: window.gpos.asset_dir_url || "/",
    installments: window.gpos.installments || [],
    savedCards: window.gpos.saved_cards || [],
    formSettings: window.gpos.form_settings || {},
    cardSaveSettings: window.gpos.card_save_settings || {},
    wcSubsSettings: window.gpos.wc_subscription_settings || {},
    platformData: window.gpos.platform_data || {},
    virtualPOS: window.gpos.virtual_pos || false,
    alternativePayments: window.gpos.alternative_payments || [],
    commonFormPayments: window.gpos.common_payments || [],
    bankTransfers: window.gpos.bank_transfers || [],
    shoppingCredits: window.gpos.shopping_credits || [],
    iFramePayments: window.gpos.iframe_payments || [],
    plugin: window.gpos.plugin || false,
    $: window.jQuery,
  }),
  actions: {
    binRetrieve(object) {
      this.binRetrieveReq = ajax.post("bin_retrieve", object);
      return this.binRetrieveReq;
    },
  },
});

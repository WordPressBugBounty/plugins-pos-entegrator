import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";
import Swal from "sweetalert2";

export const useSettingsStore = defineStore("SettingsStore", {
  state: () => ({
    wooCommerceSettings: window.gpos.woocommerce_settings || {},
    giveWpSettings: window.gpos.givewp_settings || {},
    formSettings: window.gpos.form_settings || {},
    tagManagerSettings: window.gpos.tag_manager_settings || {},
    cardSave: window.gpos.card_save_settings || {},
    wcSubsSettings: window.gpos.wc_subscription_settings || {},
    gateSettings: window.gpos.gate_settings || {},
    learnPressSettings: window.gpos.learn_press_settings || {},
    notificationSettings: window.gpos.notification_settings || {},
    otherSettings: window.gpos.other_settings || {},
    defaultPayerSettings: window.gpos.default_payer_settings || {},
    currencyConverterSettings: window.gpos.currency_converter_settings || {},
    insDisplaySettings: window.gpos.ins_display_settings || {},
    googleSheetSyncSettings: window.gpos.google_sheet_sync_settings || {},
    webHookSettings: window.gpos.webhook_settings || {},
    travelerWPSettings: window.gpos.travelerwp_settings || {},
  }),
  actions: {
    async updateWooCommerceSettings() {
      await ajax.post("update_woocommerce_settings", {
        settings: this.wooCommerceSettings,
      });
      this.swalFire();
    },
    async updateFormSettings() {
      await ajax.post("update_form_settings", { settings: this.formSettings });
      this.swalFire();
    },
    async updateTagManagerSettings() {
      await ajax.post("update_tag_manager_settings", {
        settings: this.tagManagerSettings,
      });
      this.swalFire();
    },
    async updateGiveWpSettings() {
      await ajax.post("update_givewp_settings", {
        settings: this.giveWpSettings,
      });
      this.swalFire();
    },
    async updateLearnPressSettings() {
      await ajax.post("update_learn_press_settings", {
        settings: this.learnPressSettings,
      });
      this.swalFire();
    },
    async updateCardSaveSettings() {
      await ajax.post("update_card_save_settings", { settings: this.cardSave });
      this.swalFire();
    },
    async updateWcSubsSettings() {
      await ajax.post("update_wc_subscription_settings", {
        settings: this.wcSubsSettings,
      });
      this.swalFire();
    },
    async updateGateSettings() {
      await ajax.post("update_gate_settings", { settings: this.gateSettings });

      this.swalFire();
    },
    async updateNotificationSettings() {
      await ajax.post("update_notification_settings", {
        settings: this.notificationSettings,
      });

      this.swalFire();
    },
    async updateDefaultPayerSettings() {
      await ajax.post("update_default_payer_settings", {
        settings: this.defaultPayerSettings,
      });

      this.swalFire();
    },
    async updateCurrencyConverterSettings() {
      await ajax.post("update_currency_converter_settings", {
        settings: this.currencyConverterSettings,
      });

      this.swalFire();
    },
    async updateOtherSettings() {
      await ajax.post("update_other_settings", {
        settings: this.otherSettings,
      });

      this.swalFire();
    },
    async updateInsDisplaySettings() {
      await ajax.post("update_ins_display_settings", {
        settings: this.insDisplaySettings,
      });

      this.swalFire();
    },
    async updateGoogleSheetSyncSettings() {
      await ajax.post("update_google_sheet_sync_settings", {
        settings: this.googleSheetSyncSettings,
      });

      this.swalFire(window.gpos.alert_texts.ok_test_success);
    },
    async updateWebHookSettings() {
      await ajax.post("update_webhook_settings", {
        settings: this.webHookSettings,
      });

      this.swalFire();
    },
    async reInstallTables() {
      await ajax.post("reinstall_tables", {});

      this.swalFire();
    },
    async reCheckStatus() {
      await ajax.post("recheck_status", {});
      this.swalFire(' ');
      location = window.location.hash = "#status"
      location.reload();
    },

    async updateTravelerWPSettings() {
      await ajax.post("update_travelerwp_settings", {
        settings: this.travelerWPSettings,
      });
      this.swalFire();
    },

    swalFire(text) {
      Swal.fire({
        html: text ? text : window.gpos.alert_texts.setting_saved,
        icon: "success",
        confirmButtonText: window.gpos.alert_texts.ok,
        confirmButtonColor: "#1A56DB",
      });
    },
  },
});

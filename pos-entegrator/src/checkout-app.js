import "@/plugins/create-app.js";
import "@/plugins/input-listener.js";
import "@/plugins/platform-data-listener.js";
import { createApp } from "vue";
import { createI18n } from "vue-i18n";
import VueCreditCardValidation from "vue-credit-card-validation";
import pinia from "@/plugins/store.js";
import "@/assets/checkout.css";

switch (window.gpos?.plugin) {
  case "elementor":
    import("@/plugins/extensions/elementor.js");
    break;
  case "woocommerce":
    import("@/plugins/extensions/woocommerce.js");
    break;
  case "ninja_forms":
    import("@/plugins/extensions/ninja-forms.js");
    break;
  case "wpforms":
    import("@/plugins/extensions/wpforms.js");
    break;
}
export default function init(App) {
  window.gposCreateCheckoutApplication = () => {
    const i18n = createI18n({
      locale: "en",
      messages: window.gpos.strings,
      legacy: false,
    });
    const app = createApp(App);
    app.use(VueCreditCardValidation);
    app.use(pinia);
    app.use(i18n);
    app.mount(`#app`);
    document.dispatchEvent(
      new CustomEvent("gpos-form-loaded", { detail: window.gpos })
    );
    return app;
  };
}

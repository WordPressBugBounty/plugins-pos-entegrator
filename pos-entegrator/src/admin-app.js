import { createApp } from "vue";
import { createI18n } from "vue-i18n";
import { createGtm } from "@gtm-support/vue-gtm";
import pinia from "@/plugins/store.js";
import VueNumberFormat from "vue-number-format";
import MoneyFormat from "@/components/MoneyFormat.vue";
import JsonViewer from "vue-json-viewer";

import "@/assets/admin.css";

const i18n = createI18n({
  locale: "en",
  messages: window.gpos.strings,
  legacy: false,
});

export default function init(App) {
  const app = createApp(App);
  app.component("MoneyFormat", MoneyFormat);
  app.use(JsonViewer);
  app.use(VueNumberFormat, { prefix: "", decimal: ".", thousand: "," });
  app.use(pinia);
  app.use(i18n);

  if (
    window.gpos?.tag_manager_settings?.active &&
    window.gpos?.tag_manager_settings?.gtm_id
  ) {
    try {
      app.use(
        createGtm({
          id: window.gpos.tag_manager_settings.gtm_id,
          debug: true,
          loadScript: true,
        })
      );
    } catch (e) {
      console.log(e);
    }
  }
  app.mount("#app");
}

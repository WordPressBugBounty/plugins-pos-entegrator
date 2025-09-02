import inputsChanged from "@/plugins/inputs-changed.js";

try {
  let gposCheckoutApp = false;
  const $ = window.jQuery;

  const gposCreateApp = async () => {
    if (gposCheckoutApp) {
      await gposCheckoutApp.unmount();
    }

    if (document.getElementById("app")) {
      gposCheckoutApp = window.gposCreateCheckoutApplication();
      setTimeout(() => {
        inputsChanged(); // Store'un tetiklenmesi için eklenmiştir.
      }, 2);
    }
  };

  // Global
  setInterval(() => {
    if ("object" !== typeof gposCheckoutApp || !gposCheckoutApp.mount) {
      gposCreateApp();
    }
  }, 1000);

  $(document).ready(gposCreateApp);

  // WooCommerce
  $(document.body).on("updated_checkout", gposCreateApp);

  // GiveWP
  $(document).on("give_gateway_loaded", gposCreateApp);

  $(document).on("give_option_change", gposCreateApp);

  $(".givewp-fields-gateways__gateway--gpos_givewp_v3 > label").on(
    "click",
    () => {
      setTimeout(gposCreateApp, 100);
    }
  );

  $("input[name='radio-control-wc-payment-method-options']").on(
    "change",
    function (event) {
      if ("gpos" === event.target.value) {
        gposCreateApp();
      }
    }
  );
} catch (error) {
  console.error(error);
}

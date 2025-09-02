import pinia from "@/plugins/store.js";
import inputsChanged from "@/plugins/inputs-changed.js";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";

const { platformData } = storeToRefs(useCheckout(pinia));

document.addEventListener("gpos-platform-data-changed", async (event) => {
  platformData.value = event.detail;
});

window.gposDispatchAmount = (details) => {
  document.dispatchEvent(
    new CustomEvent("gpos-platform-data-changed", {
      detail: details,
    })
  );
  inputsChanged();
};

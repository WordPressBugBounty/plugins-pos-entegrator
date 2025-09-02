import pinia from "@/plugins/store.js";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { watch } from "vue";
import inputsChanged from "@/plugins/inputs-changed.js";

const {
  card,
  requested,
  binRetrieveReq,
  virtualPOS,
  isInstallmentsActive,
  installments,
  plugin,
  isProActive,
  platformData,
  selectedInstallment,
  accountId,
} = storeToRefs(useCheckout(pinia));
const { binRetrieve, $ } = useCheckout(pinia);

document.addEventListener("gpos-inputs-changed", async () => {
  const bin = card.value.bin?.replace(/\D/g, "").slice(0, 8);
  const installment = selectedInstallment.value;
  const amount = platformData.value.amount;
  if (!bin || bin.length < 8) {
    requested.value.bin = "";
    card.value.type = "";
    card.value.brand = "";
    card.value.family = "";
    card.value.bank_name = "";
    card.value.bank_code = "";
    card.value.country = "";
    card.value.country_code = "";
    return;
  }

  if (
    requested.value.bin !== bin ||
    requested.value.installment !== installment ||
    requested.value.amount !== amount
  ) {
    requested.value.bin = bin;
    requested.value.installment = installment;
    requested.value.amount = amount;

    if (binRetrieveReq.value) {
      binRetrieveReq.value.abort();
    }
    await binRetrieve({
      bin,
      plugin: plugin.value,
      platform_data: platformData.value,
      installment,
    }).then((response) => {
      if (isProActive.value) {
        virtualPOS.value = response?.virtual_pos;
        installments.value = response?.installments;
        isInstallmentsActive.value = response?.is_installments_active;
      }

      card.value.type = response.card.type;
      card.value.brand = response.card.brand;
      card.value.family = response.card.family;
      card.value.bank_name = response.bank.name;
      card.value.bank_code = response.bank.code;
      card.value.country_code = response.country.code;
      card.value.country = response.country.name;
    });
    inputsChanged();
  }
});

watch(card, inputsChanged, { deep: true });
watch(accountId, inputsChanged, { deep: true });

if (isProActive.value) {
  watch(selectedInstallment, inputsChanged, { deep: true });
}

$(document).on(
  {
    input: inputsChanged,
  },
  ".gpos-checkout-class :input"
);

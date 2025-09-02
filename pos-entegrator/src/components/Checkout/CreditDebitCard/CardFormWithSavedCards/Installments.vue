<script setup>
import { computed } from "vue";
import { useCheckout } from "@/stores/CheckoutStore";
import RowList from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Installments/RowList.vue";
import TableList from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Installments/TableList.vue";
import SelectBoxList from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Installments/SelectBoxList.vue";
import BoxList from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Installments/BoxList.vue";
import { storeToRefs } from "pinia";
//import SelectList from "./Installments/SelectBoxList.vue";
const { isInstallmentsActive, installments, formSettings, card } = storeToRefs(
  useCheckout()
);
const rates = computed(() => {
  let family = card.value.family?.toLowerCase().replaceAll(/\s/g, "");
  switch (family) {
    case "qnbfinansbankcc":
      family = "cardfinans";
      break;
    case "kuveytturkcc":
      family = "saglamkart";
      break;
    case "ziraatbankascc":
      family = "bankkartcombo";
      break;
  }
  return installments.value[family];
});

const getInstallmentText = (rate) => {
  if(rate.extra){
    return `${rate.installment_number} + ${rate.extra}`; 
  } 
 return rate.installment_number
}
</script>
<template>
  <div
    v-if="
      rates &&
        Object.keys(rates).length > 1 &&
        isInstallmentsActive &&
        card.type === 'credit'
    "
    id="gpos-checkout-installment-container"
    class="w-full"
  >
    <RowList
      v-if="formSettings.installment_view === 'row_view'"
      :rates="rates"
      :get-installment-text="getInstallmentText"
    />
    <TableList
      v-if="formSettings.installment_view === 'table_view'"
      :rates="rates"
      :get-installment-text="getInstallmentText"
    />
    <SelectBoxList
      v-if="formSettings.installment_view === 'select_box_view'"
      :rates="rates"
      :get-installment-text="getInstallmentText"
    />
    <BoxList
      v-if="formSettings.installment_view === 'box_view'"
      :rates="rates"
      :get-installment-text="getInstallmentText"
    />
  </div>
</template>

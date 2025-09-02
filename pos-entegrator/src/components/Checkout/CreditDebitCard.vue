<script setup>
import CardFormWithSavedCards from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards.vue";
import MethodSelect from "@/components/Checkout/CreditDebitCard/MethodSelect.vue";
import EmptyForm from "@/components/Checkout/CreditDebitCard/EmptyForm.vue";
import { storeToRefs } from "pinia";
import { useCheckout } from "@/stores/CheckoutStore";
const { virtualPOS, commonFormPayments, iFramePayments, assetsUrl } =
  storeToRefs(useCheckout());
const paymentOptions = () => {
  const options = [];

  if (virtualPOS.value) {
    options.push({
      account_id: "",
      logo: `${assetsUrl.value}/images/creditcardform.svg`,
      component: CardFormWithSavedCards,
    });
  }
  return options.concat(commonFormPayments.value, iFramePayments.value);
};
</script>
<template>
  <div class="w-full">
    <CardFormWithSavedCards
      v-if="virtualPOS && paymentOptions().length === 1"
    />
    <EmptyForm
      v-else-if="
        (commonFormPayments.length === 1 || iFramePayments.length === 1) &&
          paymentOptions().length === 1
      "
      :method="paymentOptions()[0]"
    />
    <MethodSelect
      v-else-if="paymentOptions().length > 1"
      :methods="paymentOptions()"
      class="flex gap-2"
    />
  </div>
</template>

<script setup>
import Fragments from "@/components/Checkout/Fragments.vue";
import GatewayError from "@/components/Checkout/GatewayError.vue";
import TabbedForm from "@/components/Checkout/TabbedForm.vue";
import CreditDebitCard from "@/components/Checkout/CreditDebitCard.vue";
import Alternatives from "@/components/Checkout/Alternatives.vue";
import PaymentAlerts from "@/components/Checkout/PaymentAlerts.vue";
import { useCheckout } from "@/stores/CheckoutStore";
import { onMounted } from "vue";
import inputsChanged from "@/plugins/inputs-changed.js";
import { storeToRefs } from "pinia";

const {
  virtualPOS,
  iFramePayments,
  commonFormPayments,
  alternativePayments,
  bankTransfers,
  shoppingCredits,
} = useCheckout();
const { accountId } = storeToRefs(useCheckout());

onMounted(inputsChanged);

const needTabbedForm = () => {
  const withoutCards = !![
    alternativePayments.length,
    bankTransfers.length,
    shoppingCredits.length,
  ].filter((x) => x).length;

  const withCards = !![iFramePayments.length, commonFormPayments.length].filter(
    (x) => x
  ).length;

  if (withoutCards && (withCards || virtualPOS)) {
    return true;
  }
  return false;
};

const prepareComponent = () => {
  if (needTabbedForm()) {
    return TabbedForm;
  } else if (iFramePayments.length || commonFormPayments.length || virtualPOS) {
    return CreditDebitCard;
  } else if (alternativePayments.length) {
    return Alternatives;
  } else {
    return GatewayError;
  }
};
</script>
<template>
  <div class="flex flex-col gap-2 w-full gpos-checkout-class">
    <component :is="prepareComponent()" />
    <Fragments />
    <input
      id="gpos-account-id"
      type="hidden"
      :value="accountId"
    >
    <PaymentAlerts />
  </div>
</template>

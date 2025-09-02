<script setup>
import StandartForm from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm/StandartForm.vue";
import { useCheckout } from "@/stores/CheckoutStore";
const { formSettings } = useCheckout();

const getComponent = () => {
  switch (formSettings.display_type) {
    case "standart_form":
      return StandartForm;
    default:
      return StandartForm;
  }
};
</script>
<template>
  <component :is="getComponent()" />
</template>
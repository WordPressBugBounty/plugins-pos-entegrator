<script setup>
import Select from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm/StandartForm/Expiry/Select.vue";
import Text from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm/StandartForm/Expiry/Text.vue";
import { useCheckout } from "@/stores/CheckoutStore";
const { formSettings } = useCheckout();
const expiry = formSettings.expiry_style == 'select' ? Select : Text;
</script>
<template>
  <component :is="expiry" />
</template>

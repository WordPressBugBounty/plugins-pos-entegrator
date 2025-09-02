<script setup>
import Optional from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Threed/Optional.vue";
import Force from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Threed/Force.vue";
import { useCheckout } from "@/stores/CheckoutStore";
const { formSettings } = useCheckout();
</script>
<template>
  <template
    v-if="'none_threed' !== formSettings.threed"
  >
    <Optional v-if="'optional_threed' === formSettings.threed" />
    <Force v-else />
  </template>
</template>
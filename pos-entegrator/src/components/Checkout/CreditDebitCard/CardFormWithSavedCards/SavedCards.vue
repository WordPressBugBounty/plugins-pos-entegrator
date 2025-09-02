<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import SavedCards from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/SavedCards/SavedCard.vue";

const { savedCards } = useCheckout();
</script>
<template>
  <div class="flex flex-col gap-2 mb-4">
    <SavedCards
      v-for="(savedCard, index) in savedCards"
      :key="index"
      :index="index"
      :saved-card="savedCard"
    />
    <input
      id="gpos-use-saved-card"
      type="hidden"
      value="on"
    >
  </div>
</template>

<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
const { card } = storeToRefs(useCheckout());
</script>
<template>
  <div class="hidden">
    <input
      v-for="field in [
        'type',
        'brand',
        'family',
        'bank_name',
        'bank_code',
        'country',
        'country_code',
      ]"
      :id="`gpos-card-${field.replaceAll('_', '-')}`"
      :key="field"
      v-model="card[field]"
      type="hidden"
    >
  </div>
</template>

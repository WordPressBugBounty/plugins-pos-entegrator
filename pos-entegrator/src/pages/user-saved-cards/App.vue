<script setup>
import SavedCard from "@/components/UserSavedCards/SavedCard.vue";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
const { savedCards } = storeToRefs(useCheckout());
</script>
<template>
  <div
    v-if="savedCards.length > 0"
    class="w-full flex flex-col gap-3"
  >
    <SavedCard
      v-for="item in savedCards"
      :key="item.id"
      :saved-card="item"
    />
  </div>
  <div v-else>
    <div class="w-full flex p-4 bg-blue-200 text-blue-600 rounded">
      {{ $t('saved_card_not_found') }}
    </div>
  </div>
</template>

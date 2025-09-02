<script setup>
import CardForm from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm.vue";
import SavedCards from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/SavedCards.vue";
import ViewChanger from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/ViewChanger.vue";
import Threed from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Threed.vue";
import Installments from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/Installments.vue";
import { storeToRefs } from "pinia";
import { useCheckout } from "@/stores/CheckoutStore";
import { onMounted, ref } from "vue";
const { savedCards,accountId ,virtualPOS} = storeToRefs(useCheckout());
const useSavedCard = ref(true);
onMounted(() => {
  useSavedCard.value = !!savedCards.value.length;
  accountId.value = '';
});
</script>
<template>
  <div
    v-if="virtualPOS"
    class="w-full flex flex-col gap-3"
  >
    <ViewChanger
      v-if="savedCards.length"
      v-model="useSavedCard"
    />
    <SavedCards v-if="useSavedCard" />
    <CardForm v-else />
    <Threed />
    <Installments />
  </div>
</template>

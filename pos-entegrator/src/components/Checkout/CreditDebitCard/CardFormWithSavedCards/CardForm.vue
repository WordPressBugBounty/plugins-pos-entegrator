<script setup>
import TestMode from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/TestMode.vue";
import HolderName from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/HolderName.vue";
import CardInputForm from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm.vue";
import SaveCard from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/SaveCard.vue";
import HiddenCardData from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/HiddenCardData.vue";
</script>
<template>
  <div class="flex flex-col gap-4">
    <TestMode />
    <HolderName />
    <CardInputForm />
    <SaveCard />
    <HiddenCardData />
  </div>
</template>

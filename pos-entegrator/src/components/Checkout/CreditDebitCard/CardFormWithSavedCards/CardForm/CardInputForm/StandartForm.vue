<script setup>
import BinNumber from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm/StandartForm/BinNumber.vue";
import Expiry from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm/StandartForm/Expiry.vue";
import Cvc from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/CardInputForm/StandartForm/Cvc.vue";
</script>
<template>
  <div class="flex flex-col w-full gap-4">
    <BinNumber />
    <div class="flex w-full flex-col gap-2 md:flex-row md:justify-between ">
      <Expiry />
      <Cvc />
    </div>
  </div>
</template>

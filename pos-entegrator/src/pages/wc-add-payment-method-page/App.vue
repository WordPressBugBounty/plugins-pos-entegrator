<script setup>
import CardForm from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm.vue";
import CardName from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/SaveCard/CardName.vue";
import GatewayError from "@/components/Checkout/GatewayError.vue";
import { useCheckout } from "@/stores/CheckoutStore";
import { onMounted } from "vue";
import inputChanged from "@/plugins/inputs-changed.js";
import Fragments from "@/components/Checkout/Fragments.vue";
import { storeToRefs } from "pinia";
const { virtualPOS } = useCheckout();
const { formSettings } = storeToRefs(useCheckout());
formSettings.value.holder_name_field = true;
onMounted(inputChanged);
</script>
<template>
  <div class="flex flex-col gpos-checkout-class">
    <template v-if="virtualPOS && virtualPOS.supports.includes('save_card')">
      <CardForm />
      <CardName />
      <Fragments />
    </template>
    <GatewayError v-else />
  </div>
</template>

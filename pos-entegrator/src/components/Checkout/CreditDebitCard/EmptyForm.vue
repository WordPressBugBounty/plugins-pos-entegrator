<script setup>
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useCheckout } from "@/stores/CheckoutStore";
import PaymentStepsDescription from "@/components/Checkout/CreditDebitCard/MethodSelect/PaymentStepsDescription.vue";
const props = defineProps({
  method: {
    required: true,
    type: Object,
  },
});
const { accountId } = storeToRefs(useCheckout());
onMounted(() => {
  accountId.value = props.method.account_id;
});
</script>
<template>
  <PaymentStepsDescription
    :descriptions="method.payment_steps_description"
  />
</template>

<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import PaymentMethod from "@/components/Checkout/Alternatives/PaymentMethod.vue";
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
const { alternativePayments } = useCheckout();
const { accountId } = storeToRefs(useCheckout());
onMounted(() => {
    accountId.value = alternativePayments[0].account_id;
});
</script>
<template>
  <div class="flex flex-col gap-3">
    <PaymentMethod
      v-for="paymentMethod in alternativePayments"
      :key="paymentMethod.account_id"
      :payment-method="paymentMethod"
    />
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useCheckout } from "@/stores/CheckoutStore";
import inputsChanged from "@/plugins/inputs-changed.js";
import PaymentStepsDescription from "@/components/Checkout/CreditDebitCard/MethodSelect/PaymentStepsDescription.vue";
const props = defineProps({
  methods: {
    required: true,
    type: Object,
  },
});
const { accountId } = storeToRefs(useCheckout());
onMounted(() => {
  accountId.value = props.methods[0].account_id;
  inputsChanged();
});

const methodChanged = (methodAccountId) => {
  accountId.value = methodAccountId;
  setTimeout(() => {
    inputsChanged()
  }, 100)
};
</script>
<template>
  <div class="flex flex-col w-full gap-2">
    <div class="flex w-full flex-wrap gap-2">
      <div
        v-for="method in methods"
        :key="method.account_id"
        :class="`relative flex items-center h-10 justify-center border-2 rounded-lg px-2 py-5 cursor-pointer ${
          method.account_id === accountId
            ? 'border-blue-500'
            : ' border-slate-200'
        }`"
        @click="methodChanged(method.account_id);"
      >
        <img
          class="!m-0 w-24 max-h-[40px] object-contain"
          :src="method.logo"
        >
      </div>
    </div>
    <!-- eslint-disable -->
    <template v-for="(method, key) in methods" :key="key">
      <!-- eslint-enable -->
      <template v-if="method.component && accountId === method.account_id">
        <component :is="method.component" />
      </template>
      <PaymentStepsDescription
        v-else-if="
          method.payment_steps_description && accountId === method.account_id
        "
        :descriptions="method.payment_steps_description"
      />
    </template>
  </div>
</template>

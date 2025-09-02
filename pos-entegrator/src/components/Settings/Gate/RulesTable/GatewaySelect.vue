<script setup>
import { computed } from "vue";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
import { useMainStore } from "@/stores/MainStore";
const { paymentGateways } = useMainStore();
const { virtualPOSAccounts } = useGatewayAccounts();
const props = defineProps({
  modelValue: { type: [String, Number], required: true },
});
const emit = defineEmits(["update:modelValue"]);
const componentValue = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});

const getProperty = (account, property) => {
  const gateway = paymentGateways.find(
    (gateway) => gateway.id == account.gateway_id
  );

  return gateway[property];
};


</script>
<template>
  <select
    v-model="componentValue"
    class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
  >
    <option
      v-for="account in virtualPOSAccounts"
      :key="account.id"
      :value="account.id"
    >
      {{ getProperty(account, "title") }}
    </option>
  </select>
</template>

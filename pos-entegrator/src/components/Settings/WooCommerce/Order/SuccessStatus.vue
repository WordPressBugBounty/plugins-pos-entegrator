<script setup>

import { computed } from "vue";
const props = defineProps({ modelValue: { type: String, required: true } });
const emit = defineEmits(["update:modelValue"]);
const orderStatus = window.gpos.wc_order_statuses;
const componentValue = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});
</script>
<template>
  <label>
    {{ $t("pay_to_status") }}
    <select
      id="countries"
      v-model="componentValue"
      class="!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !max-w-none !w-full !p-2.5"
    >
      <option
        v-for="(status, index) in orderStatus"
        :key="index"
        :value="status.value"
        :selected="status.value === componentValue.success_status"
        class="w-full"
      >
        {{ status.text }}
      </option>
    </select>
  </label>
</template>

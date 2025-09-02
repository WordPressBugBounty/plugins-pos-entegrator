<script setup>
import { computed } from "vue";
const props = defineProps({
  modelValue: { type: [String, Number], required: true },
  placeholder: { type: String, default: "" },
  required: { type: Boolean, default: false },
  label: { type: String, default: "" },
  rate: { type: Object,  required: true},
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
</script>

<template>
  <div class="flex">
    <div
      class="!bg-gray-200 !border !border-r-0 !border-gray-300 !text-gray-900 !text-md !rounded-l-md p-1 w-1/4 text-center font-semibold"
    >
      {{ label }}
    </div>
    <input
      v-model="componentValue"
      :disabled="!rate.enabled"
      type="text"
      style="border-radius: 0 !important"
      :class="`!border !border-l-0 !border-gray-300 !text-gray-900 !text-sm !rounded-r-md w-3/4 ${
        rate.enabled ? '!bg-white' : '!bg-gray-200'
      }`"
    >
  </div>
</template>

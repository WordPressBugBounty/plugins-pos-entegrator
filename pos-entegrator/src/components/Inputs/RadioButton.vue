<script setup>
import { computed } from "vue";
const props = defineProps({
  modelValue: {
    type: [String, Boolean, Number],
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  value: {
    type: [String, Boolean],
    required: true,
  },
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
    <div class="flex items-center">
      <input
        :id="value"
        v-model="componentValue"
        :name="name"
        :value="value"
        aria-describedby="helper-radio-text"
        type="radio"
        class="!w-4 !h-4 !text-blue-600 !bg-gray-100 !border-gray-300 !focus:ring-blue-500"
        :disabled="disabled"
      >
    </div>
    <div class="ml-2 text-sm">
      <label
        :for="value"
        :class="`font-medium ${
          disabled ? 'text-gray-300' : 'text-gray-900'
        } flex items-center gap-2`"
      >
        <slot /></label>
      <p
        id="helper-radio-text"
        class="text-xs font-normal text-gray-400"
      >
        <slot name="subtitle" />
      </p>
    </div>
  </div>
</template>

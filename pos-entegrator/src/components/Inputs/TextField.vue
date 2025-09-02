<script setup>
import { computed } from "vue";
const props = defineProps({
  modelValue: { type: [String, Number], required: true },
  placeholder: { type: String, default: "" },
  required: { type: Boolean, default: false },
  id: { type: [String, Number], default: "" },
  label: { type: String, default: "" },
  type: { type: String, default: "text" },
  maxlength: { type: [String, Number], default: "" },
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
  <label :for="id">
    {{ label }}
    <input
      :id="id"
      v-model="componentValue"
      step="0.1"
      :type="type"
      class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
      :placeholder="placeholder"
      :required="required"
      :maxlength="maxlength"
    >
    <p
      id="helper-text-field-text"
      class="text-xs font-normal text-gray-400 mt-2"
    >
      <slot name="subtitle" />
    </p>
  </label>
</template>

<script setup>
import { computed } from "vue";

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
</script>
<template>
  <textarea
    v-model="componentValue"
    style="resize: none"
    rows="4"
    class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 condition-list"
  />
</template>

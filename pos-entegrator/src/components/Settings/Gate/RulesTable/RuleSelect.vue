<script setup>
import { computed } from "vue";
const props = defineProps({
  modelValue: { type: [String, Boolean], required: true },
  options: { type: Object, required: true },
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
  <select
    v-model="componentValue"
    class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
  >
    <optgroup
      :label="$t(option.group)"
      v-for="option in options"
      :key="option.group"
    >
      <option :value="rule.rule" v-for="rule in option.rules" :key="rule.rule">
        {{ $t(rule.rule) }}
      </option>
    </optgroup>
  </select>
</template>

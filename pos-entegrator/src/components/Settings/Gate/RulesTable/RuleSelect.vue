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

const optGroups = [
  'gate_card', 'gate_price', 'gate_installment', 'gate_woocommerce'
]

</script>
<template>
  <select
    v-model="componentValue"
    class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
  >
    <optgroup
      v-for="group in optGroups"
      :key="group"
      :label="$t(group)"
    >
      <template v-for="(rule, key) in options">
        <option
          v-if="rule.group == group"
          :key="key"
          :value="key"
        >
          {{ $t(key) }}
        </option>
      </template>
    </optgroup>
  </select>
</template>

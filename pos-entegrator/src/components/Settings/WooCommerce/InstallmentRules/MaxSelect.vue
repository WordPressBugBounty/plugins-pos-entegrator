<script setup>
import { computed } from "vue";
const props = defineProps({
  modelValue: { type: Number, required: true },
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
    class="flex border !border-gray-300 bg-white font-medium !rounded-lg text-sm px-5 py-2.5"
  >
    <option
      v-for="i in 12"
      :key="i"
      :value="i"
    >
      {{ i === 1 ? $t('disable_inst') : i }}
    </option>
  </select>
</template>

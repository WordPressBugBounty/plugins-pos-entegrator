<script setup>
import { computed } from "vue";
const props = defineProps(["modelValue", "disabled", "value"]);
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
  <div>
    <label class="relative inline-flex cursor-pointer">
      <input
        v-model="componentValue"
        :value="value"
        type="checkbox"
        class="sr-only peer"
        :disabled="disabled"
      >
      <div
        class="w-11 min-w-[2.75rem] h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"
      />
      <div class="flex flex-col gap-1">
        <div class="flex items-center">
          <span
            :class="`ml-3 text-sm font-medium ${
              disabled ? 'text-gray-300' : 'text-gray-900'
            }`"
          ><slot /></span>
        </div>
        <span class="ml-3 text-xs font-normal text-gray-400"><slot name="subtitle" /></span>
      </div>
    </label>
  </div>
</template>

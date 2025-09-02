<script setup>
import { computed } from "vue";
const gposCountries = window.gpos.countries;
const props = defineProps({
  modelValue: {
    type: [String],
    required: true,
  },
  countries: {
    type: Array,
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
  <div class="p-4">
    <select
      id="gpos-isbank-girogate-country"
      v-model="componentValue"
      class="w-full flex justify-between border font-medium !rounded-lg text-sm px-5 py-2.5 cursor-pointer select-none !bg-transparent"
    >
      <option value="">
        {{ $t("select_country") }}
      </option>
      <option
        v-for="country in countries"
        :key="country"
        class="p-2"
        :value="country"
      >
        {{ gposCountries[country] }}
      </option>
    </select>
  </div>
</template>

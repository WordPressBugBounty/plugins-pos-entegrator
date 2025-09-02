<script setup>
import { ChevronDownIcon, ChevronUpIcon } from "@heroicons/vue/24/solid";
import { computed, onMounted, ref } from "vue";
const props = defineProps({
  modelValue: { type: [Array, String], required: true },
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
const open = ref(false);
onMounted(() => {
  componentValue.value =
    "" === componentValue.value ? [] : componentValue.value;
});
const familyCodes = {
	'advantage': 'Advantage',
	'axess': 'Axess',
	'bankkartcombo': 'Bankartcombo',
	'bonus': 'Bonus',
	'cardfinans': 'Cardfinans',
	'qnbfinansbankcc': 'QNB Finansbank',
	'denizbankcc': 'Denizbank',
	'ingbankcc': 'ING Bank',
	'maximum': 'Maximum',
	'paraf': 'Paraf',
	'saglamkart': 'SağlamKart',
	'world': 'World',
}
</script>
<template>
  <div class="relative w-full">
    <button
      class="w-full flex justify-between font-medium px-5 py-2.5 text-center items-center !bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg"
      type="button"
      @click="open = !open"
    >
      {{
        componentValue.length > 0
          ? `${componentValue.length} ${$t("selected")}`
          : $t("select_bank")
      }}
      <ChevronUpIcon
        v-if="open"
        class="h-4 w-4"
      />
      <ChevronDownIcon
        v-else
        class="h-4 w-4"
      />
    </button>
    <div
      v-if="open"
      class="grid grid-cols-1 lg:grid-cols-2 z-20 gap-1 absolute p-3 w-full bg-white rounded-lg shadow"
    >
      <label
        v-for="(family, code) in familyCodes"
        :key="code"
        :for="code"
        class="text-xs flex"
      >
        <input
          :id="code"
          v-model="componentValue"
          type="checkbox"
          :value="code"
        >
        {{ family }}
      </label>
    </div>
  </div>
</template>

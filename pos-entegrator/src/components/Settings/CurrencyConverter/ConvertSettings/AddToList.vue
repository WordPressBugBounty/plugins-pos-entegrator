<script setup>
import { ChevronDownIcon, ChevronUpIcon } from "@heroicons/vue/24/solid";
import OutlineButton from "@/components/Inputs/OutlineButton.vue";
import { ref } from "vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const store = useSettingsStore();
const { currencyConverterSettings } = storeToRefs(store);
const currencies = window.gpos.supported_currencies;
const open = ref(false);
const toAddList = ref([]);
const filteredCurrencies = () => {
  return currencies
    .filter(
      (currency) =>
        !currencyConverterSettings.value.convert_list.find(
          (el) => el.currency === currency
        )
    )
    .filter(
      (currency) =>
        currencyConverterSettings.value.payment_currency !== currency
    );
};
const addToList = () => {
  toAddList.value.forEach((currency) => {
    currencyConverterSettings.value.convert_list.push({
      currency,
      rate: 1,
      type: "manual_convert",
    });
  });
  open.value = !open.value;
  toAddList.value = [];
};
</script>
<template>
  <div class="flex w-full gap-3 justify-end">
    <div class="relative">
      <button
        class="w-64 flex justify-between font-medium px-5 py-2.5 text-center items-center !bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg"
        type="button"
        @click="open = !open"
      >
        {{
          toAddList.length > 0
            ? `${toAddList.length} ${$t("selected")}`
            : $t("select_currencies")
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
        class="w-64 grid grid-cols-1 lg:grid-cols-3 z-20 gap-2 absolute p-3 bg-white rounded-lg shadow"
      >
        <label
          v-for="currency in filteredCurrencies()"
          :key="currency"
          :for="currency"
          class="text-left"
        >
          <input
            :id="currency"
            v-model="toAddList"
            type="checkbox"
            :value="currency"
          >
          {{ currency }}
        </label>
      </div>
    </div>
    <div>
      <OutlineButton
        :disabled="toAddList.length === 0"
        class="w-full justify-center col-span-3"
        @click="addToList()"
      >
        {{ $t("add") }}
      </OutlineButton>
    </div>
  </div>
</template>

<script setup>
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const store = useSettingsStore();
const { currencyConverterSettings } = storeToRefs(store);
const currencies = window.gpos.supported_currencies;
</script>
<template>
  <div class="flex gap-4 flex-col justify-between">
    <div class="font-semibold">
      {{ $t("payment_currency") }}
    </div>
    <div>{{ $t("payment_currency_desc") }}</div>

    <select
      v-model="currencyConverterSettings.payment_currency"
      class="font-medium px-5 !py-3 items-center !bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg w-1/2"
    >
      <option
        v-for="currency in currencies"
        :key="currency"
        :value="currency"
      >
        {{ currency }}
      </option>
    </select>
  </div>
</template>

<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import Activate from "@/components/Settings/CurrencyConverter/Activate.vue";
import ConvertSettings from "@/components/Settings/CurrencyConverter/ConvertSettings.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const store = useSettingsStore();
const { currencyConverterSettings } = storeToRefs(store);
</script>
<template>
  <SettingsTab>
    <Activate />
    <ConvertSettings v-if="currencyConverterSettings.active" />
    <template
      #action
    >
      <SaveButton @click="store.updateCurrencyConverterSettings()" />
    </template>
  </SettingsTab>
</template>

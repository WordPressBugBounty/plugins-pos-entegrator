<script setup>
import Switch from "@/components/Inputs/Switch.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const store = useSettingsStore();
const { currencyConverterSettings } = storeToRefs(store);
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("currency_converter") }}
    </template>
    <div class="flex flex-col gap-4">
      <Switch v-model="currencyConverterSettings.active">
        {{ $t("activate") }}
        <template #subtitle>
          {{ $t("currency_converter_desc") }}
        </template>
      </Switch>

      <Switch v-model="currencyConverterSettings.installment_convert">
        {{ $t("activate_for_installments") }}
        <template #subtitle>
          {{ $t("installment_convert_desc") }}
        </template>
      </Switch>
    </div>
  </SettingsCard>
</template>

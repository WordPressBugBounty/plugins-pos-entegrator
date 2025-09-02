<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { giveWpSettings } = storeToRefs(store);
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("show_billing_fields") }}
    </template>
    <Switch
      v-model="giveWpSettings.show_billing_fields"
      @change="store.updateGiveWpSettings()"
    >
      {{ $t("activate")
      }}<template #subtitle>
        {{ $t("show_billing_fields_desc") }}
      </template>
    </Switch>
  </SettingsCard>
</template>

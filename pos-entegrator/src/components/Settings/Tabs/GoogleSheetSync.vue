
<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Active from "@/components/Settings/GoogleSheetSync/Active.vue";
import SheetSettings from "@/components/Settings/GoogleSheetSync/SheetSettings.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { googleSheetSyncSettings } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <Active
      v-model="googleSheetSyncSettings"
    />
    <SheetSettings
      v-if="googleSheetSyncSettings.active"
      v-model="googleSheetSyncSettings"
    />
    <template #action>
      <SaveButton @click="store.updateGoogleSheetSyncSettings()" />
    </template>
  </SettingsTab>
</template>

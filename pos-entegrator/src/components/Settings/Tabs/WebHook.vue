
<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Active from "@/components/Settings/WebHook/Active.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { webHookSettings } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <Active
      v-model="webHookSettings"
    />
    <template #action>
      <SaveButton @click="store.updateWebHookSettings()" />
    </template>
  </SettingsTab>
</template>

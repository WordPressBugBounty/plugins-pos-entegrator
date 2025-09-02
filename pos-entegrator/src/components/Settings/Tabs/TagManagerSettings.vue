<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Active from "@/components/Settings/TagManager/Active.vue";
import GTMSettings from "@/components/Settings/TagManager/GTMSettings.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { tagManagerSettings } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <Active
      v-model="tagManagerSettings"
    />
    <GTMSettings v-if="tagManagerSettings.active" />
    <template #action>
      <SaveButton @click="store.updateTagManagerSettings()" />
    </template>
  </SettingsTab>
</template>

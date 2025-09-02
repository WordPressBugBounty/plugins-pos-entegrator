<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Form from "@/components/Settings/TravelerWP/Form.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
const store = useSettingsStore();
</script>
<template>
  <SettingsTab>
    <Form />
    <template #action>
      <SaveButton @click="store.updateTravelerWPSettings()" />
    </template>
  </SettingsTab>
</template>

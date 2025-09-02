<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Form from "@/components/Settings/LearnPress/Form.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
const store = useSettingsStore();
</script>
<template>
  <SettingsTab>
    <Form />
    <template #action>
      <SaveButton @click="store.updateLearnPressSettings()" />
    </template>
  </SettingsTab>
</template>

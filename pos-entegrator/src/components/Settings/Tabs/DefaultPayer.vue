<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import DefaultPayer from "@/components/Settings/DefaultPayer/DefaultPayer.vue";
import Active from "@/components/Settings/DefaultPayer/Active.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { defaultPayerSettings } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <div class="w-full">
      <Active v-model="defaultPayerSettings.active" />
    </div>
    <div
      v-if="defaultPayerSettings.active"
      class="w-full"
    >
      <DefaultPayer v-model="defaultPayerSettings.default_payer" />
    </div>
    <template #action>
      <SaveButton @click="store.updateDefaultPayerSettings()" />
    </template>
  </SettingsTab>
</template>

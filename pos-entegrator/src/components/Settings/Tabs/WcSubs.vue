<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Other from "@/components/Settings/WcSubs/Other.vue";
import Support from "@/components/Settings/WcSubs/Support.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { wcSubsSettings } = storeToRefs(store);
</script>
<template>
  <SettingsTab>
    <div class="w-full">
      <Support v-model="wcSubsSettings" />
    </div>
    <div class="w-full">
      <Other v-model="wcSubsSettings" />
    </div>
    <template #action>
      <SaveButton @click="store.updateWcSubsSettings()" />
    </template>
  </SettingsTab>
</template>

<script setup>
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
const store = useSettingsStore();
</script>
<template>
  <div class="flex items-center justify-between gap-4">
    <p
      class="w-1/2 text-sm font-normal text-gray-400"
    >
      {{ $t("reinstall_tables_desc") }}
    </p>
    <PrimaryButton @click="store.reInstallTables()">
      {{ $t("reinstall_tables_btn") }}
    </PrimaryButton>
  </div>
</template>
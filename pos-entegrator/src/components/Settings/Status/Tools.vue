<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import ReInstallDB from "@/components/Settings/Status/Actions/ReInstallDB.vue";
import ExportSettings from "@/components/Settings/Status/Actions/ExportSettings.vue";
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t('tools') }}
    </template>
    <div class="w-full flex flex-col">
      <ReInstallDB />
      <div class="border border-gray-100  my-5" />
      <ExportSettings />
      <div class="border border-gray-100  my-5" />
    </div>
  </SettingsCard>
</template>

<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
const serverStats = window.gpos.status.server;
</script>
<template>
  <SettingsCard>
    <template #header>
      Server
    </template>
    <div
      v-for="(stat, index) in serverStats"
      :key="index"
      :class="`flex flex-row items-center justify-between p-2 ${
        index % 2 === 0 ? 'bg-gray-100' : ''
      }`"
    >
      <span v-text="stat.label" />
      <span v-text="stat.value" />
    </div>
  </SettingsCard>
</template>

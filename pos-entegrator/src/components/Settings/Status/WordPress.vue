<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
const wordPressStats = window.gpos.status.wordpress;
</script>
<template>
  <SettingsCard>
    <template #header>
      WordPress
    </template>
    <div
      v-for="(stat, index) in wordPressStats"
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

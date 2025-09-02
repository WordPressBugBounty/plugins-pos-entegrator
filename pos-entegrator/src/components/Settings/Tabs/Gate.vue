<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import AddNew from "@/components/Settings/Gate/AddNew.vue";
import RulesTable from "@/components/Settings/Gate/RulesTable.vue";
import VideoTutorialBadge from "@/components/Badges/VideoTutorialBadge.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
</script>
<template>
  <SettingsTab>
    <div class="w-full flex justify-end mb-2">
      <VideoTutorialBadge video="https://www.youtube.com/watch?v=X9b-UlLjLCo" />
    </div>
    <SettingsCard>
      <template #header>
        {{ $t("gate") }}
      </template>
      <div class="w-full flex flex-col gap-4">
        <div>{{ $t("gate_desc") }}</div>
        <div class="mt-3">
          {{ $t("gate_default") }}
        </div>
        <AddNew />
        <RulesTable />
      </div>
    </SettingsCard>
    <template #action>
      <SaveButton @click="useSettingsStore().updateGateSettings()" />
    </template>
  </SettingsTab>
</template>

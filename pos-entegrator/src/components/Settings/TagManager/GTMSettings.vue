<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const { tagManagerSettings } = storeToRefs(useSettingsStore());
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("tag_manager_events") }}
    </template>
    <div class="flex w-full flex-col gap-4">
      <TextField
        v-model="tagManagerSettings.event_refund"
        class="w-full"
        label="refund"
        :placeholder="$t('event_refund')"
      >
        <template #subtitle>
          {{ $t("tag_manager_events_desc") }}
        </template>
      </TextField>
    </div>
  </SettingsCard>
</template>

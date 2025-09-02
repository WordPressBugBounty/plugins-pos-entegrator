<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import { storeToRefs } from "pinia";
import { computed } from "vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import EMails from "@/components/Settings/NotificationSettings/EMails.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
const { notificationSettings } = storeToRefs(useSettingsStore());
const store = useSettingsStore();
const disabled = computed(
  () =>
    (notificationSettings.value.daily.active &&
      !notificationSettings.value.daily.emails) ||
    (notificationSettings.value.weekly.active &&
      !notificationSettings.value.weekly.emails) ||
    (notificationSettings.value.errors.active &&
      !notificationSettings.value.errors.emails) ||
    (notificationSettings.value.success.active &&
      !notificationSettings.value.success.emails)
);
</script>
<template>
  <SettingsTab>
    <EMails />
    <template #action>
      <SaveButton
        :disabled="disabled"
        @click="store.updateNotificationSettings()"
      />
      <div
        v-if="disabled"
        class="text-red-600 mt-2"
      >
        {{ $t('notification_error') }}
      </div>
    </template>
  </SettingsTab>
</template>

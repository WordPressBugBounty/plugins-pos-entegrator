<script setup>
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import TransactionNotification from "@/components/Settings/NotificationSettings/EMails/TransactionNotification.vue";
import Daily from "@/components/Settings/NotificationSettings/EMails/Daily.vue";
import Weekly from "@/components/Settings/NotificationSettings/EMails/Weekly.vue";
const { notificationSettings } = storeToRefs(useSettingsStore());
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t('emails') }}
      <div class="text-sm font-normal text-black">
        {{ $t('emails_below_desc') }}
      </div>
    </template>
    <div class="w-full flex flex-col">
      <Daily v-model="notificationSettings.daily" />
      <div class="border border-gray-100  my-5" />
      <Weekly v-model="notificationSettings.weekly" />
      <div class="border border-gray-100  my-5" />
      <TransactionNotification 
        v-model="notificationSettings.errors" 
        :title="$t('active_error_mails')"
        :description="$t('active_error_mails_desc')"
      />
      <div class="border border-gray-100  my-5" />
      <TransactionNotification 
        v-model="notificationSettings.success" 
        :title="$t('active_success_mails')"
        :description="$t('active_success_mails_desc')"
      />
    </div>
  </SettingsCard>
</template>
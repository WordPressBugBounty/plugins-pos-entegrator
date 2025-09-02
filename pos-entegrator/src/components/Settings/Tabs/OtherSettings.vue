<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import AdminBarMenu from "@/components/Settings/OtherSettings/AdminBarMenu.vue";
import PaymentIDSettings from "@/components/Settings/OtherSettings/PaymentIDSettings.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";

import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const store = useSettingsStore();
const { otherSettings } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <div class="w-full">
      <AdminBarMenu
        v-model="otherSettings.admin_bar_menu"
      />
    </div>
    <div class="w-full">
      <PaymentIDSettings
        v-model="otherSettings.payment_id_settings"
      />
    </div>
    <template #action>
      <SaveButton
        :disabled="otherSettings.payment_id_settings.active && otherSettings.payment_id_settings.separator.length === 0"
        @click="store.updateOtherSettings()"
      />
    </template>
  </SettingsTab>
</template>

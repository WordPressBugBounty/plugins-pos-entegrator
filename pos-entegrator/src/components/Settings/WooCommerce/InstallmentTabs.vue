<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import TextField from "@/components/Inputs/TextField.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { storeToRefs } from "pinia";
const { wooCommerceSettings } = storeToRefs(useSettingsStore());
</script>
<template>
  <SettingsCard>
    <template #header>
      <div class="flex items-center gap-2">
        {{ $t("installment_tab") }} 
      </div>
    </template>
    <div
      class="w-full flex justify-between gap-4 items-center"
    >
      <Switch v-model="wooCommerceSettings.installment_tab_active">
        {{ $t("activate") }}
      </Switch>
      <TextField
        v-model="wooCommerceSettings.installment_tab_title"
        class="w-full"
        :label="$t('installment_tab_title')"
        :placeholder="$t('installment_tab_title')"
      />
      <TextField
        v-model="wooCommerceSettings.installment_tab_priority"
        class="w-full"
        :label="$t('installment_tab_priority')"
        :placeholder="$t('installment_tab_placeholder')"
      />
    </div>
  </SettingsCard>
</template>

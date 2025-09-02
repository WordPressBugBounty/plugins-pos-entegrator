<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const { travelerWPSettings } = storeToRefs(useSettingsStore());
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("form") }}
    </template>
    <div class="flex gap-7">
      <div class="flex w-1/2 flex-wrap">
        <TextField
          v-model="travelerWPSettings.title"
          class="w-1/2 pl-2"
          :label="$t('method_name')"
          :placeholder="$t('your_method_name')"
        />

        <TextField
          v-model="travelerWPSettings.icon"
          class="w-full mt-8"
          :label="$t('icon')"
          :placeholder="$t('icon')"
        />
      </div>
      <label class="w-1/2">
        {{ $t("pay_form_desc") }}
        <textarea
          id="message"
          v-model="travelerWPSettings.description"
          rows="6"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
          :placeholder="$t('enter_desc')"
        />
      </label>
    </div>
  </SettingsCard>
</template>

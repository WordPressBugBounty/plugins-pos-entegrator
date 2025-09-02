<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const { wooCommerceSettings } = storeToRefs(useSettingsStore());
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("form") }}
    </template>
    <div class="flex gap-7">
      <div class="flex w-1/2 flex-wrap">
        <TextField
          v-model="wooCommerceSettings.button_text"
          class="w-1/2 pr-2"
          :label="$t('pay_button_value')"
          :placeholder="$t('pay_button_value')"
        />
	
        <TextField
          v-model="wooCommerceSettings.title"
          class="w-1/2 pl-2"
          :label="$t('method_name')"
          :placeholder="$t('your_method_name')"
        />

        <TextField
          v-model="wooCommerceSettings.icon"
          class="w-full mt-8"
          :label="$t('icon')"
          :placeholder="$t('icon')"
        />
      </div>
      <label class="w-1/2">
        {{ $t("pay_form_desc") }}
        <textarea
          id="message"
          v-model="wooCommerceSettings.description"
          rows="6"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
          :placeholder="$t('enter_desc')"
        />
      </label>
    </div>
  </SettingsCard>
</template>

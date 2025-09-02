<script setup>
import { storeToRefs } from "pinia";
import { useSettingsStore } from "@/stores/SettingsStore";
import SettingsTab from "@/layouts/SettingsTab.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import ViewStyle from "@/components/Settings/InsDisplaySettings/ViewStyle.vue";
import ShortCode from "@/components/Settings/InsDisplaySettings/ShortCode.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";

const { insDisplaySettings } = storeToRefs(useSettingsStore());
const { updateInsDisplaySettings } = useSettingsStore();
</script>
<template>
  <SettingsTab>
    <ShortCode />
    <SettingsCard>
      <template #header>
        {{ $t("settings") }}
      </template>
      <div class="w-full flex flex-col gap-8">
        <label class="w-1/2">
          {{ $t("desc") }}
          <textarea
            v-model="insDisplaySettings.description"
            rows="3"
            :placeholder="$t('ins_display_desc')"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
          />
        </label>
        <ViewStyle v-model="insDisplaySettings.style" />
      </div>
    </SettingsCard>
    <template #action>
      <SaveButton @click="updateInsDisplaySettings()" />
    </template>
  </SettingsTab>
</template>

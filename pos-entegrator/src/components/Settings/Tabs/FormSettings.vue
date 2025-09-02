<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Threed from "@/components/Settings/FormSettings/Threed.vue";
import Other from "@/components/Settings/FormSettings/Other.vue";
import Lang from "@/components/Settings/FormSettings/Lang.vue";
import Display from "@/components/Settings/FormSettings/Display.vue";
import ExpiryDisplay from "@/components/Settings/FormSettings/ExpiryDisplay.vue";
import Installment from "@/components/Settings/FormSettings/Installment.vue";
import AlertDisplay from "@/components/Settings/FormSettings/AlertDisplay.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import VideoTutorialBadge from "@/components/Badges/VideoTutorialBadge.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { formSettings } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <div class="w-full flex justify-end mb-4">
      <VideoTutorialBadge video="https://www.youtube.com/watch?v=cZ6OHuGDgXE" />
    </div>
    <div class="w-1/2">
      <Threed v-model="formSettings.threed" />
    </div>
    <div class="w-1/2 flex flex-col">
      <Other v-model="formSettings" />
      <Lang v-model="formSettings.payment_lang" />
    </div>
    <div class="w-full">
      <Display v-model="formSettings.display_type" />
    </div>
    <div class="w-full">
      <ExpiryDisplay
        v-if="'standart_form' === formSettings.display_type"
        v-model="formSettings.expiry_style"
      />
    </div>
    <div class="w-full">
      <Installment v-model="formSettings.installment_view" />
    </div>
    <div class="w-full">
      <AlertDisplay v-model="formSettings.show_alerts" />
    </div>
    <template #action>
      <SaveButton
        id="gpos-save-settings-button"
        @click="store.updateFormSettings()"
      />
    </template>
  </SettingsTab>
</template>

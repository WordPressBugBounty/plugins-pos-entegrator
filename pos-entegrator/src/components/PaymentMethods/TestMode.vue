<script setup>
import Toggle from "@/components/Inputs/Toggle.vue";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";

const mainStore = useMainStore();
const { isTestMode } = storeToRefs(mainStore);
const { t } = useI18n();

const changeTestMode = async (isTestMode) => {
  await mainStore.updateTestMode(isTestMode);
  const adminBarMenu = jQuery("#wp-admin-bar-gurmepos");

  if (isTestMode) {
    adminBarMenu.addClass("gpos-test-mode-active");
    adminBarMenu.children("a").children('span').children('span.ab-label').html(`POS Entegratör ${t("test_mode")}`);
  } else {
    adminBarMenu.removeClass("gpos-test-mode-active");
    adminBarMenu.children("a").children('span').children('span.ab-label').html("POS Entegratör");
  }
};
</script>

<template>
  <div class="flex gap-2 items-center">
    <Toggle
      id="gpos-test-mode"
      v-model="isTestMode"
      @change="changeTestMode(isTestMode)"
    >
      {{ $t("test_mode") }}
    </Toggle>
  </div>
</template>

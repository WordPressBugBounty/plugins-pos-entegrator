<script setup>
import Help from "@/components/Navbar/Help.vue";
import { FireIcon } from "@heroicons/vue/24/solid";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const assetsUrl = window.gpos.assets_url;
const mainStore = useMainStore();
const isProActive = window.gpos.is_pro_active;
const isFormActive = window.gpos.is_form_active;
const { pluginVersion } = storeToRefs(mainStore);
function getVersionText() {
  if (isFormActive) {
    return "Business";
  }
  if (isProActive) {
    return "Pro";
  }

  return t("Free");
}
function pattern() {
  if (isFormActive) {
    return "bg-slate-200 text-slate-600";
  }
  if (isProActive) {
    return "bg-purple-100 text-purple-800";
  }

  return "bg-purple-100 text-purple-800";
}
</script>

<template>
  <div>
    <div class="flex justify-between items-center py-5 px-5 bg-white">
      <div class="flex gap-2 items-center">
        <div class="flex items-center">
          <img
            class="w-60"
            :src="`${assetsUrl}/images/logo.svg`"
          >
          <span class="text-blue-800 text-xs font-medium">v{{ pluginVersion }}</span>
        </div>

        <span :class="`${pattern()} text-sm font-medium px-2.5 py-0.5 rounded`">
          {{ getVersionText() }}</span>
      </div>

      <div class="flex gap-5 items-center">
        <a
          v-if="!isProActive"
          href="https://posentegrator.com?utm_source=wp_plugin&utm_medium=referal&utm_campaign=ust_menu"
          target="_blank"
          class="text-sm flex gap-1 items-center text-[#6B7280]"
        >
          <FireIcon class="w-4 h-4 text-blue-600" />
          {{ $t("update_pro") }}
        </a>
        <Help />
      </div>
    </div>
  </div>
</template>

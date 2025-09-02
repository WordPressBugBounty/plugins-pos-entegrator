<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Info from '@/components/Alerts/Info.vue';

import { ref } from "vue";
import { ClipboardDocumentIcon } from "@heroicons/vue/24/solid";

let copied = ref([true, true]);
const copy = async (text, index) => {
  await navigator.clipboard.writeText(text);
  copied.value[index] = false;
  setTimeout(() => {
    copied.value[index] = true;
  }, 1000);
};

const priced = '[gpos_installment_table price="100"]';
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("short_code") }}
    </template>
    <div class="flex gap-8">
      <div
        class="flex justify-between w-full border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"
      >
        <span> [gpos_installment_table] </span>
        <span
          class="cursor-pointer"
          @click="copy('[gpos_installment_table]', 0)"
        >
          <ClipboardDocumentIcon
            v-if="copied[0]"
            class="w-4 h-4 text-blue-600"
          />
          <span
            v-else
            class="text-blue-600"
            v-text="'copied !'"
          />
        </span>
      </div>
      <div
        class="flex justify-between w-full border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"
      >
        <span> [gpos_installment_table price="100" currency="TRY"] </span>
        <span
          class="cursor-pointer"
          @click="copy(priced, 1)"
        >
          <ClipboardDocumentIcon
            v-if="copied[1]"
            class="w-4 h-4 text-blue-600"
          />
          <span
            v-else
            class="text-blue-600"
            v-text="'copied !'"
          />
        </span>
      </div>
    </div>
    <template #footer>
      <Info :text="$t('ins_display_short_code_desc')" />
    </template>
  </SettingsCard>
</template>

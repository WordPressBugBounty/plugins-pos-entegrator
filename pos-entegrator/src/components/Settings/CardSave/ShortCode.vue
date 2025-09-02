<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import { ref } from "vue";
import { ClipboardDocumentIcon } from "@heroicons/vue/24/solid";

let copied = ref(true);
const copy = async (text) => {
  await navigator.clipboard.writeText(text);
  copied.value = false;
  setTimeout(() => {
    copied.value = true;
  }, 1000);
};
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("short_code") }}
    </template>

    <div
      class="flex justify-between w-full border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"
    >
      <span> [gpos_user_saved_cards] </span>
      <span
        class="cursor-pointer"
        @click="copy('[gpos_user_saved_cards]')"
      >
        <ClipboardDocumentIcon
          v-if="copied"
          class="w-4 h-4 text-blue-600"
        />
        <span
          v-else
          class="text-blue-600"
          v-text="'copied !'"
        />
      </span>
    </div>
    <template #footer>
      {{ $t("save_card_short_code_desc") }}
    </template>
  </SettingsCard>
</template>

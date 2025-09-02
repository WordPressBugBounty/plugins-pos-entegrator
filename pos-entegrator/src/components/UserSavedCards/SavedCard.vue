<script setup>
import { TrashIcon } from "@heroicons/vue/24/solid";
import { useUserSavedCards } from "@/stores/UserSavedCardsStore";
import SetDefaultBadge from "@/components/Badges/SetDefaultBadge.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
const { assetsUrl, setDefault, deleteCard, savedCards } = useUserSavedCards();
defineProps({
  savedCard: {
    required: true,
    type: Object,
  },
});
</script>
<template>
  <div
    class="w-full flex bg-[#fbfbfb] border rounded border-gray-200 px-3 py-4 items-center"
  >
    <div class="w-2/12 flex justify-center">
      <img
        class="w-9 h-9 object-contain rounded-md"
        :src="`${assetsUrl}/images/card/${
          savedCard.card_family
            ? savedCard.card_family.toLowerCase().replaceAll(/\s/g, '')
            : 'default'
        }.svg
          `"
        :alt="savedCard.card_family"
      >
    </div>
    <div class="w-2/12">
      <SetDefaultBadge v-if="savedCard.default">
        {{ $t("default") }}
      </SetDefaultBadge>
      <PrimaryButton
        v-else
        class="!inline-flex !items-center !bg-blue-700 !text-white !text-xs !font-medium !mr-2 !px-2.5 !py-0.5 !rounded-full"
        @click="setDefault(savedCard.id)"
      >
        {{ $t("make_default") }}
      </PrimaryButton>
    </div>
    <div class="w-3/12">
      {{ savedCard.card_name || $t("saved_card") }}
    </div>
    <div class="w-2/12 text-end">
      {{ savedCard.masked_card_bin }}
    </div>
    <div class="w-1/12 text-end">
      {{ savedCard.card_expiry_month }}/{{
        savedCard.card_expiry_year.substr(-2)
      }}
    </div>
    <div class="w-2/12 flex justify-end items-center gap-1">
      <div
        :class="`flex items-center justify-end gap-1 ${
          !savedCard.default || savedCards.length === 1
            ? 'text-red-600 cursor-pointer'
            : 'pointer-events-none text-gray-300'
        }`"
        @click="deleteCard(savedCard.id)"
      >
        <TrashIcon class="w-6 h-6" />
        {{ $t("delete") }}
      </div>
    </div>
  </div>
</template>

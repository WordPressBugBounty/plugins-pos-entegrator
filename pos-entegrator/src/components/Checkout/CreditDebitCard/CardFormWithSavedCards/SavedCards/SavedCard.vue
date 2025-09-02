<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { onBeforeMount } from "vue";
import { useUiStore } from "@/stores/UiStore";
import Spinner from "@/components/Checkout/Spinner.vue";
const { selectedSavedCard, card, assetsUrl } = storeToRefs(useCheckout());
const { loading } = storeToRefs(useUiStore());
const props = defineProps({
  index: {
    required: true,
    type: Number,
  },
  savedCard: {
    required: true,
    type: Object,
  },
});

onBeforeMount(() => {
  if (props.savedCard.default || props.index === 0) {
    savedCardChange();
  }
});

const savedCardChange = () => {
  selectedSavedCard.value = props.savedCard.id;
  card.value.bin = props.savedCard.masked_card_bin;
};
</script>
<template>
  <div
    :class="`${
      selectedSavedCard === savedCard.id
        ? 'border-l-green-400'
        : 'border-l-gray-50'
    } rounded border-l-4  bg-[#fbfbfb] w-full px-3 py-4 cursor-pointer flex items-center font-semibold`"
    @click="savedCardChange()"
  >
    <template v-if="selectedSavedCard === savedCard.id">
      <input
        id="gpos-card-bin"
        :value="savedCard.masked_card_bin"
        type="hidden"
      >
      <input
        id="gpos-saved-card"
        :value="savedCard.id"
        type="hidden"
      >
    </template>
    <div class="w-2/12">
      <Spinner v-if="loading && selectedSavedCard === savedCard.id" />
      <img
        v-else
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
    <div class="w-6/12">
      {{ savedCard.card_name || $t("saved_card") }}
    </div>
    <div class="w-2/12 text-end">
      {{ savedCard.last_four_digit }}
    </div>
    <div class="w-2/12 text-end">
      {{ savedCard.card_expiry_month }}/{{
        savedCard.card_expiry_year.substr(-2)
      }}
    </div>
  </div>
</template>

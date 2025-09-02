<script setup>
defineProps({
  transaction: {
    required: true,
    type: Object,
  },
});
const assetsUrl = window.gpos.assets_url;
</script>
<template>
  <div class="p-5 bg-white rounded flex flex-col shadow-md">
    <div
      class="text-blue-600 font-bold text-lg"
      v-text="$t('card_info')"
    />
    <div class="border border-[#F7F7F7] my-4" />
    <div class="flex flex-wrap gap-y-4">
      <div
        v-for="key in ['card_holder_name', 'masked_card_bin']"
        :key="key"
        class="flex flex-col w-1/4 gap-2 ph-no-capture"
      >
        <span class="text-base font-semibold text-gray-900">{{ $t(key) }}</span>
        <span class="text-md">{{ transaction[key] }}</span>
      </div>

      <div class="flex flex-col w-1/4 gap-2">
        <span class="text-base font-semibold text-gray-900">{{
          $t("card_type")
        }}</span>
        <span class="text-md">{{
          $t(transaction.card_type === "credit" ? "credit_card" : "debit_card")
        }}</span>
      </div>

      <div class="flex flex-col w-1/4 gap-2">
        <span class="text-base font-semibold text-gray-900">{{
          $t("saved_card")
        }}</span>
        <span class="text-md">{{
          $t(transaction.use_saved_card ? "yes" : "no")
        }}</span>
      </div>

      <div class="flex flex-col w-1/4 gap-2">
        <span class="text-base font-semibold text-gray-900">{{
          $t("card_bank_name")
        }}</span>
        <span class="text-md">{{ transaction.card_bank_name }}</span>
      </div>

      <div class="flex flex-col w-1/4 gap-2">
        <span class="text-base font-semibold text-gray-900">{{
          $t("card_brand")
        }}</span>
        <img
          v-if="transaction.card_brand"
          class="w-[80px] object-contain"
          :src="`${assetsUrl}/images/card/${transaction.card_brand}.svg`"
        >
      </div>

      <div class="flex flex-col w-1/4 gap-2">
        <span class="text-base font-semibold text-gray-900">{{
          $t("card_family")
        }}</span>
        <img
          class="w-[60px] rounded-md object-contain"
          :src="`${assetsUrl}/images/card/${
            transaction.card_family
              ? transaction.card_family.toLowerCase().replaceAll(/\s/g, '')
              : 'default'
          }.svg`"
          :alt="transaction.card_family"
        >
      </div>

      <div class="flex flex-col w-1/4 gap-2">
        <span class="text-base font-semibold text-gray-900">{{
          $t("card_country")
        }}</span>
        <span class="text-md">{{ transaction.card_country }}</span>
      </div>
    </div>
  </div>
</template>

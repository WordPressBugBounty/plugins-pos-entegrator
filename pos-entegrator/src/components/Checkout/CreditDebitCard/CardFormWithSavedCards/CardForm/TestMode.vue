<script setup>
import {
  ExclamationTriangleIcon,
  ClipboardDocumentIcon,
} from "@heroicons/vue/24/solid";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
const { card, virtualPOS, assetsUrl, isTestMode} = storeToRefs(useCheckout());

const setCard = (test) => {
  card.value.bin = test.bin;
  card.value.expiry_year = test.expiry_year;
  card.value.expiry_month = test.expiry_month;
  card.value.expiry = `${test.expiry_month} / ${test.expiry_year}`;
  card.value.cvv = test.cvv;
};
</script>
<template>
  <div
    v-if="isTestMode"
    class="bg-yellow-100 text-yellow-700 p-3 flex flex-col rounded gap-2"
  >
    <div class="flex items-center justify-between text-lg font-semibold">
      <div class="flex items-center gap-2">
        <ExclamationTriangleIcon class="w-6" />{{ $t("test_mode_title") }}
      </div>
      <img
        :src="virtualPOS.logo"
        class="w-[80px]"
      >
    </div>
    <div>
      {{ $t("test_mode_checkout_desc") }}
    </div>
    <table
      v-if="virtualPOS.test_cards.length > 0"
      class="text-xs"
    >
      <tr>
        <th />
        <th>{{ $t("card_bin") }}</th>
        <th class="hidden md:table-cell">
          {{ $t("month_year") }}
        </th>
        <th class="hidden md:table-cell">
          Cvc
        </th>
        <th class="hidden md:table-cell">
          3ds
        </th>
        <th />
      </tr>
      <tbody>
        <tr
          v-for="(testCard, key) in virtualPOS.test_cards"
          :key="key"
          class="!border-b !border-yellow-700"
        >
          <td>
            <img
              class="!w-8"
              :src="`${assetsUrl}/images/card/${testCard.brand}.svg`"
            >
          </td>
          <td>{{ testCard.bin }}</td>
          <td class="hidden md:table-cell">
            {{ testCard.expiry_month }}/{{ testCard.expiry_year }}
          </td>
          <td class="hidden md:table-cell">
            {{ testCard.cvv }}
          </td>
          <td class="hidden md:table-cell">
            {{ testCard.secure }}
          </td>
          <td>
            <ClipboardDocumentIcon
              class="!w-6 cursor-pointer"
              @click="setCard(testCard)"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

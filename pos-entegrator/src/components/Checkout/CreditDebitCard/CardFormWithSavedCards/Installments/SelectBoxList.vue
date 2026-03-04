<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";

const decodeHtml = (html) => {
  const txt = document.createElement("textarea");
  txt.innerHTML = html;
  return txt.value;
};
defineProps({
  rates: {
    required: true,
    type: Object,
  },
  getInstallmentText: {
    required: true,
    type: Function,
  },
});
const focus = ref(false);
const { selectedInstallment } = storeToRefs(useCheckout());
</script>

<template>
  <div
    :class="`w-full flex flex-col gap-3 !border !bg-white !rounded ${
      focus ? '!border-blue-700' : '!border-gray-300'
    }`"
  >
    <select
      v-model="selectedInstallment"
      class="!rounded !p-3"
      data-name="gpos-installment"
      @focus="focus = !focus"
      @focusout="focus = !focus"
    >
      <!-- eslint-disable-next-line -->
      <template v-for="(rate, key) in rates" :key="key">
        <option
          v-if="rate.installment_number !== 1"
          :value="rate.installment_number"
          :data-rate="rate.rate"
        >
          {{ getInstallmentText(rate) }} {{ $t("installment") }} x
          {{ rate.amount_per_month }} {{ $t("total") }}:
          {{ rate.amount_total }} {{ decodeHtml(rate.currency_symbol) }}
        </option>
        <option
          v-else
          :value="rate.installment_number"
          :data-rate="rate.rate"
        >
          Tek Çekim
        </option>
      </template>
    </select>
  </div>
</template>

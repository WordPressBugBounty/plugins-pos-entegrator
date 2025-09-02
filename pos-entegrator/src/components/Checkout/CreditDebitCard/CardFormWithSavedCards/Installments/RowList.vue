<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
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
const { selectedInstallment } = storeToRefs(useCheckout());
</script>
<template>
  <div class="w-full flex flex-col gap-4">
    <div
      class="w-full !text-md bg-gray-200 border border-gray-300 flex justify-between items-center rounded-md p-2 font-semibold"
    >
      <div>
        {{ $t("installment_number") }}
      </div>
      <div>
        {{ $t("monthly_payment") }}
      </div>
    </div>

    <label
      v-for="(rate, key) in rates"
      :key="key"
      :for="`gpos-installment-${rate.installment_number}`"
      class="bg-white border border-gray-300 flex p-2 rounded-md items-center cursor-pointer font-semibold ml-2"
    >
      <div class="flex gap-1 w-1/6">
        <input
          :id="`gpos-installment-${rate.installment_number}`"
          v-model="selectedInstallment"
          type="radio"
          data-name="gpos-installment"
          :data-rate="rate.rate"
          :value="rate.installment_number"
          class="!block !m-0"
        >
        <div class="block w-12 text-left text-xs md:text-md">
          {{ getInstallmentText(rate) }}
        </div>
      </div>

      <div class="flex gap-3 items-center justify-end text-xs md:text-md w-5/6">
        <div class="flex flex-col md:flex-row text-gray-400">
          <span> {{ $t("total") }}: </span>
          <div>
            {{ rate.amount_total
            }}<!-- eslint-disable --><span
              v-html="rate.currency_symbol"
            /><!-- eslint-enable -->
          </div>
        </div>
        <div class="flex items-center justify-end font-semibold">
          {{ rate.amount_per_month }}
          <!-- eslint-disable -->
          <span v-html="rate.currency_symbol" />&nbsp;/ {{ $t("month") }}
          <!-- eslint-enable -->
        </div>
      </div>
    </label>
  </div>
</template>

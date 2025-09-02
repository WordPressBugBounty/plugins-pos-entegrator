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
  <table class="w-full text-sm text-gray-500">
    <thead class="text-xs text-gray-700 bg-gray-50">
      <tr>
        <th
          scope="col"
          class="!px-6 !py-3"
        >
          {{ $t("installment_number") }}
        </th>
        <th
          scope="col"
          class="!px-6 !py-3"
        >
          {{ $t("monthly_payment") }}
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(rate, key) in rates"
        :key="key"
        class="bg-white !border-gray-900 !border-b !border-collapse"
      >
        <td
          scope="row"
          class="!px-6 !py-4 font-medium text-gray-900"
          colspan="2"
        >
          <label
            :for="`gpos-installment-${rate.installment_number}`"
            class="cursor-pointer flex w-full justify-between items-center"
          >
            <div>
              <input
                :id="`gpos-installment-${rate.installment_number}`"
                v-model="selectedInstallment"
                type="radio"
                data-name="gpos-installment"
                :data-rate="rate.rate"
                :value="rate.installment_number"
              >

              {{ getInstallmentText(rate) }} {{ $t("installment") }}
            </div>

            <div>
              {{ rate.amount_per_month }}
              <!-- eslint-disable -->
              <span v-html="rate.currency_symbol" />
              <!-- eslint-enable -->
            </div>
          </label>
        </td>
      </tr>
    </tbody>
  </table>
</template>

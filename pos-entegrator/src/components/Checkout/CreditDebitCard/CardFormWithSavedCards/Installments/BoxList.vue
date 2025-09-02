<script setup>
import { ArrowDownIcon, ArrowUpIcon } from "@heroicons/vue/24/solid";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";
const props = defineProps({
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
selectedInstallment.value = 1;
const selectInstallment = (installmentNumber) => {
  selectedInstallment.value = installmentNumber;
};
const ratesArray = Object.values(props.rates).slice(0, 3);
const counter = () => Object.keys(props.rates).length;
let show = ref(false);
</script>

<template>
  <div class="grid grid-cols-3 gap-2 text-center">
    <div
      v-for="(rate, key) in show ? rates : ratesArray"
      :key="key"
      data-name="gpos-installment"
      :class="`border rounded p-3 cursor-pointer  ${
        selectedInstallment === rate.installment_number
          ? ' border-blue-500'
          : ' border-slate-200'
      }`"
      @click="selectInstallment(rate.installment_number)"
    >
      <input
        :id="`gpos-installment-${rate.installment_number}`"
        v-model="selectedInstallment"
        type="radio"
        data-name="gpos-installment"
        :data-rate="rate.rate"
        :value="rate.installment_number"
        class="hidden"
      >
      <div class="text-lg font-bold">
        {{
          rate.installment_number === 1
            ? $t("advace")
            : getInstallmentText(rate) + " " + $t("installment")
        }}
      </div>
      <div class="text-sm">
        {{ rate.amount_per_month }} <span v-html="rate.currency_symbol" /> x
        {{ rate.installment_number }}
      </div>
      <div class="my-2 border-t border-gray-500" />
      <div class="font-bold text-lg">
        {{ rate.amount_total }} <span v-html="rate.currency_symbol" />&nbsp;
      </div>
    </div>

    <div
      v-if="counter() > 3"
      class="col-span-3 cursor-pointer flex justify-center items-center gap-2 mt-2 text-blue-500 underline"
      @click="show = !show"
    >
      <template v-if="!show">
        {{ $t("other_installment_options") }} ({{ counter() - 3 }})
        <ArrowDownIcon class="w-4 h-4" />
      </template>
      <template v-else>
        {{ $t("hide") }}
        <ArrowUpIcon class="w-4 h-4" />
      </template>
    </div>
  </div>
</template>

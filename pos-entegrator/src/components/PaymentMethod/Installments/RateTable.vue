<script setup>
import ApplyAll from "@/components/PaymentMethod/Installments/RateTable/ApplyAll.vue";
import InstallmentInput from "@/components/PaymentMethod/Installments/RateTable/InstallmentInput.vue";
import { storeToRefs } from "pinia";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
const { gatewayAccount, assetsUrl } = storeToRefs(useGatewayAccount());
</script>
<template>
  <div class="w-full grid grid-cols-4 gap-6">
    <ApplyAll />
    <div
      v-for="(rates, family) in gatewayAccount.installments"
      :key="family"
      class="flex flex-col gap-2 rounded-lg p-2 bg-slate-200"
    >
      <div class="flex gap-4 h-8">
        <img
          :src="`${assetsUrl}/images/card/${family}.svg`"
          class="rounded-lg w-8 h-8"
        >
        <div class="px-2 py-1 w-10/12 font-semibold text-center">
          {{ $t(family) }}
        </div>
      </div>
      <table class="border text-left !rounded-lg bg-white">
        <tr
          v-for="rateOpt in rates"
          :key="rateOpt.number"
          class="border-b"
        >
          <td class="px-2 py-1 w-1/12">
            {{ rateOpt.number }}
          </td>
          <td class="px-2 py-1 w-1/12">
            <input
              v-model="rateOpt.enabled"
              type="checkbox"
              class="text-blue-600 bg-gray-100 border-gray-300 rounded"
            >
          </td>
          <td class="px-2 py-1 w-5/12">
            <InstallmentInput
              v-model="rateOpt.rate"
              :rate="rateOpt"
              label="%"
            />
          </td>
          <td class="px-2 py-1 w-5/12">
            <InstallmentInput
              v-model="rateOpt.extra"
              :rate="rateOpt"
              label="+"
            />
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

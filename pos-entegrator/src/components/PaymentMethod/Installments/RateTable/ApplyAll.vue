<script setup>
import InstallmentInput from "@/components/PaymentMethod/Installments/RateTable/InstallmentInput.vue";
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
const { gatewayAccount } = storeToRefs(useGatewayAccount());

const applyInstallment = ref([
  { number: 2, enabled: false, rate: "", extra: "" },
  { number: 3, enabled: false, rate: "", extra: "" },
  { number: 4, enabled: false, rate: "", extra: "" },
  { number: 5, enabled: false, rate: "", extra: "" },
  { number: 6, enabled: false, rate: "", extra: "" },
  { number: 7, enabled: false, rate: "", extra: "" },
  { number: 8, enabled: false, rate: "", extra: "" },
  { number: 9, enabled: false, rate: "", extra: "" },
  { number: 10, enabled: false, rate: "", extra: "" },
  { number: 11, enabled: false, rate: "", extra: "" },
  { number: 12, enabled: false, rate: "", extra: "" },
]);

const applyAll = () => {
  Object.keys(gatewayAccount.value.installments).forEach((family) => {
    applyInstallment.value.forEach((opt) => {
      gatewayAccount.value.installments[family][opt.number].enabled =
        opt.enabled;
      gatewayAccount.value.installments[family][opt.number].rate = opt.rate;
      gatewayAccount.value.installments[family][opt.number].extra = opt.extra;
    });
  });
};
</script>
<template>
  <div class="flex flex-col gap-2 justify-center rounded-lg p-2 bg-slate-200">
    <table class="border text-left !rounded-lg bg-white">
      <tr
        v-for="rateOpt in applyInstallment"
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
    <div class="flex gap-4 h-8 justify-center">
      <div
        class="py-2 px-3 bg-white text-blue-600 rounded-lg border border-blue-600 flex justify-center items-center cursor-pointer"
        @click="applyAll()"
      >
        {{ $t("apply_all") }}
      </div>
    </div>
  </div>
</template>

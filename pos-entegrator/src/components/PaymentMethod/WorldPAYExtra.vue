<script setup>
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import { storeToRefs } from "pinia";
import { onMounted } from "vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
const { updateAccountSettings } = useGatewayAccount();
const { gatewayAccount } = storeToRefs(useGatewayAccount());

onMounted(() => {
  if (typeof gatewayAccount.value.gateway_settings.installments === "string") {
    gatewayAccount.value.gateway_settings.installments = {
      2: "",
      3: "",
      4: "",
      5: "",
      6: "",
      7: "",
      8: "",
      9: "",
      10: "",
      11: "",
      12: "",
    };
  }
});
</script>
<template>
  <div class="bg-white p-6 rounded-lg shadow-md flex flex-col gap-3">
    <span class="text-2xl font-bold text-[#111928]">{{
      $t("installment_options")
    }}</span>
    <div class="flex gap-3">
      <div
        v-for="(rate, number) in gatewayAccount.gateway_settings.installments"
        :key="number"
        class="flex items-center flex-col"
      >
        <span>{{ number }}</span>
        <div class="flex">
          <div
            class="!bg-gray-200 !border !border-r-0 !border-gray-300 !text-gray-900 !text-md !rounded-l-md p-1"
          >
            %
          </div>
          <input
            v-model="gatewayAccount.gateway_settings.installments[number]"
            type="text"
            style="border-radius: 0 !important"
            class="!border !border-l-0 !border-gray-300 !text-gray-900 !text-sm !rounded-r-md w-12 !bg-white"
          >
        </div>
      </div>
    </div>
    <span class="">{{
      $t(`${gatewayAccount.gateway_id}.installment_desc`)
    }}</span>
    <div>
      <PrimaryButton
        id="gpos-save-settings"
        @click="updateAccountSettings"
      >
        {{ $t("save_settings") }}
      </PrimaryButton>
    </div>
  </div>
</template>

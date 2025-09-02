<script setup>
import { CheckCircleIcon, BanknotesIcon } from "@heroicons/vue/24/solid";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
const { gatewayAccount } = useGatewayAccount();
</script>
<template>
  <div class="bg-white p-6 rounded-lg shadow-md flex flex-col gap-3">
    <template v-if="gatewayAccount.gateway_property.supports.length">
      <span class="text-2xl font-bold text-[#111928]">{{
        $t("supports_features")
      }}</span>
      <div class="w-full flex flex-wrap gap-5 mt-4">
        <div
          v-for="(feature, index) in gatewayAccount.gateway_property.supports"
          :key="index"
          class="w-72 flex justify-between py-4 px-3 bg-gray-50 rounded-lg items-center"
        >
          <span class="text-base"> {{ $t(feature) }}</span>
          <CheckCircleIcon class="w-6 h-6 text-green-300" />
        </div>
      </div>
    </template>
    <span class="text-2xl font-bold text-[#111928]">{{
      $t("supports_currency")
    }}</span>
    <div
      class="flex items-center flex-wrap break-words bg-gray-50 rounded-lg py-4 px-3"
    >
      <div class="flex gap-2 items-center">
        <BanknotesIcon class="w-5 h-5 text-gray-900" />
        <span class="text-xs text-gray-900 font-medium">
          {{ gatewayAccount.gateway_property.currencies.join(", ") }}</span>
      </div>
    </div>
  </div>
</template>

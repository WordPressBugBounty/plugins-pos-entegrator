<script setup>
import { Cog6ToothIcon } from "@heroicons/vue/24/solid";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";

const { paymentGateways } = storeToRefs(useMainStore());
const { iFrameAccounts } = storeToRefs(useGatewayAccounts());

const getProperty = (account, property) => {
  const gateway = paymentGateways.value.find(
    (gateway) => gateway.id == account.gateway_id
  );

  return gateway[property];
};
</script>

<template>
  <table class="w-full text-sm text-left bg-white shadow-md">
    <thead class="text-xs text-gray-500 uppercase bg-[#F9FAFB]">
      <tr>
        <th
          scope="col"
          class="px-6 py-3 w-5/6"
        >
          {{ $t("payment_method") }}
        </th>
        <th
          scope="col"
          class="px-6 py-3 sr-only w-1/6"
        >
          {{ $t("actions") }}
        </th>
      </tr>
    </thead>
    <tbody>
      <template v-if="iFrameAccounts.length === 0">
        <tr>
          <td
            colspan="2"
            class="px-6 py-4 text-sm text-gray-400"
          >
            {{ $t("not_active_comp") }}
          </td>
        </tr>
      </template>
      <template v-else>
        <tr
          v-for="(account, index) in iFrameAccounts"
          :key="index"
          class="bg-white border border-gray-100"
        >
          <th
            scope="row"
            class="px-3 py-4 font-medium text-gray-900 rounded-lg whitespace-nowrap flex gap-5 items-center !min-w-[300px]"
          >
            <img
              class="w-[100px] max-h-[35px] object-contain"
              :src="getProperty(account, 'logo')"
            >
            {{ account.post_title ? account.post_title : getProperty(account, "title") }}
          </th>

          <td class="px-6 py-4">
            <div class="w-full flex justify-end">
              <PrimaryButton :href="account.settings_url">
                <Cog6ToothIcon class="w-4 h-4" />
              </PrimaryButton>
            </div>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>

<script setup>
import { ref } from "vue";
import { Cog6ToothIcon, BanknotesIcon } from "@heroicons/vue/24/solid";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import SetDefaultBadge from "@/components/Badges/SetDefaultBadge.vue";

const { paymentGateways } = storeToRefs(useMainStore());
const { updateDefaultStatus, getGatewayAccounts } = useGatewayAccounts();
const { virtualPOSAccounts } = storeToRefs(useGatewayAccounts());
const hover = ref(false);

const getProperty = (account, property) => {
  const gateway = paymentGateways.value.find(
    (gateway) => gateway.id == account.gateway_id
  );

  return gateway[property];
};

const setDefault = async (id, defaltStatus) => {
  await updateDefaultStatus(id, defaltStatus);
  getGatewayAccounts();
};

const show = ref([]);
</script>

<template>
  <table class="w-full text-sm text-left bg-white shadow-md">
    <thead class="text-xs text-gray-500 uppercase bg-[#F9FAFB]">
      <tr>
        <th
          scope="col"
          class="px-6 py-3 w-1/12"
        />
        <th
          scope="col"
          class="px-6 py-3 w-4/12"
        >
          {{ $t("payment_method") }}
        </th>
        <th
          scope="col"
          class="px-6 py-3 w-5/12"
        >
          {{ $t("features") }}
        </th>
        <th
          scope="col"
          class="w-1/12"
        />
        <th
          scope="col"
          class="px-6 py-3 sr-only w-1/12"
        >
          {{ $t("actions") }}
        </th>
      </tr>
    </thead>
    <tbody>
      <template v-if="virtualPOSAccounts.length === 0">
        <tr>
          <td
            colspan="5"
            class="px-6 py-4 text-sm text-gray-400"
          >
            <div>
              {{ $t("not_active_comp") }}
            </div>
          </td>
        </tr>
      </template>
      <template v-else>
        <tr
          v-for="(account, index) in virtualPOSAccounts"
          :key="index"
          class="bg-white border border-gray-100"
          @mouseleave="hover = false"
          @mouseover="hover = index"
        >
          <td class="px-2">
            <img
              class="w-full max-h-[35px] object-contain"
              :src="getProperty(account, 'logo')"
            >
          </td>
          <td>
            <div
              class="font-medium text-gray-900 justify-start rounded-lg whitespace-nowrap flex gap-5 items-center !min-w-[300px] w-full"
            >
              {{ account.post_title ? account.post_title : getProperty(account, "title") }}
              <SetDefaultBadge v-if="account.is_default">
                {{ $t("default") }}
              </SetDefaultBadge>

              <div v-if="hover === index && !account.is_default">
                <PrimaryButton
                  class="!inline-flex !items-center !bg-blue-700 !text-white !text-xs !font-medium !mr-2 !px-2.5 !py-0.5 !rounded-full"
                  @click="setDefault(account.id, true)"
                >
                  {{ $t("make_default") }}
                </PrimaryButton>
              </div>
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="flex gap-2 flex-wrap">
              <span
                v-for="(support, key) in getProperty(account, 'supports').slice(
                  0,
                  5
                )"
                :key="key"
                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded"
              >{{ $t(support) }}</span>

              <a
                v-if="getProperty(account, 'supports').length > 5"
                :href="account.settings_url"
                class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded underline"
              >{{ $t("all_features") }}</a>
            </div>
          </td>
          <td>
            <span
              class="z-10 cursor-pointer"
              @mouseenter="show[account.id] = true"
              @mouseleave="show[account.id] = false"
            >
              <BanknotesIcon class="w-5 h-5 text-green-600" />
            </span>
            <div
              v-if="show[account.id]"
              :id="`currency-${account.id}`"
              class="absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm tooltip"
            >
              <div class="max-w-xs flex flex-wrap break-words">
                {{ getProperty(account, "currencies").join(", ") }}
              </div>
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="w-full flex justify-end">
              <PrimaryButton
                :id="`${getProperty(account, 'id')}-settings-button`"
                :href="account.settings_url"
              >
                <Cog6ToothIcon class="w-4 h-4" />
              </PrimaryButton>
            </div>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>

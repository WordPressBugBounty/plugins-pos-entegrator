<script setup>
import { ArrowRightIcon } from "@heroicons/vue/24/solid";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
import { useMainStore } from "@/stores/MainStore";
import NeedBadge from "@/components/Badges/NeedBadge.vue";
defineProps({
  transaction: {
    type: Object,
    required: true,
  },
});
const { gatewayAccounts } = useGatewayAccounts();
const { paymentGateways } = useMainStore();

const getAccount = (id) => {
  return gatewayAccounts.find((e) => parseInt(e.id) === parseInt(id));
};

const getLogo = (gateway) => {
  return paymentGateways.find((e) => e.id === gateway.gateway_id).logo;
};
const bankCodes = window.gpos.bank_codes || [];
const assetUrl = window.gpos.assets_url;
</script>
<template>
  <div class="flex flex-col p-3 bg-white rounded h-fit shadow-md">
    <div
      class="text-blue-600 font-bold text-lg leading-none mb-[2px] flex items-center gap-2"
    >
      Gate <NeedBadge />
    </div>
    <div class="border border-[#F7F7F7] my-4" />
    <div class="flex items-center justify-between gap-4">
      <img
        class="w-16 max-h-12"
        :src="getLogo(getAccount(transaction.id_before_gate))"
        alt=""
      >

      <ArrowRightIcon class="w-4 h-4" />
      <img
        class="w-8 h-8"
        :src="`${assetUrl}/images/settings/gate_blue.svg`"
        alt=""
      >
      <ArrowRightIcon class="w-4 h-4" />
      <img
        class="w-16 max-h-12"
        :src="getLogo(getAccount(transaction.account_id))"
        alt=""
      >
    </div>
    <div class="mt-3 flex flex-col w-full">
      <div class="flex">
        <div class="font-semibold w-1/6">
          {{ $t("rule") }} :
        </div>
        <div class="w-5/6">
          {{ $t(transaction.gate_affected_rule.rule) }}
        </div>
      </div>
      <div class="flex">
        <div class="font-semibold w-1/6">
          {{ $t("condition") }} :
        </div>
        <div class="w-5/6">
          <template
            v-if="transaction.gate_affected_rule.rule === 'card_bank_in_list'"
          >
            {{
              transaction.gate_affected_rule.condition
                .map((e) => bankCodes[e])
                .join(", ")
            }}
          </template>
          <template v-else>
            {{ transaction.gate_affected_rule.condition }}
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

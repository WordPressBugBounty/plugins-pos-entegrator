<script setup>
import { ArrowRightIcon } from "@heroicons/vue/24/solid";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
import { useMainStore } from "@/stores/MainStore";
import NeedBadge from "@/components/Badges/NeedBadge.vue";
import { useI18n } from "vue-i18n";
import RuleShow from "./Gate/RuleShow.vue";
const { t } = useI18n();
const props = defineProps({
  transaction: {
    type: Object,
    required: true,
  },
});
const { gatewayAccounts: allGatewayAccounts } = useGatewayAccounts();
const { paymentGateways } = useMainStore();

const getAccount = (id) => {
  return allGatewayAccounts().find((e) => parseInt(e.id) === parseInt(id));
};

const getLogo = (gateway) => {
  return paymentGateways.find((e) => e.id === gateway.gateway_id).logo;
};

const getRules = () => {
  return props.transaction.gate_affected_rule.rule
    .map((e) => t(e))
    .join(" && ");
};
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
      />

      <ArrowRightIcon class="w-4 h-4" />
      <img
        class="w-8 h-8"
        :src="`${assetUrl}/images/settings/gate_blue.svg`"
        alt=""
      />
      <ArrowRightIcon class="w-4 h-4" />
      <img
        class="w-16 max-h-12"
        :src="getLogo(getAccount(transaction.account_id))"
        alt=""
      />
    </div>
    <template v-if="typeof transaction.gate_affected_rule.rule === 'string'">
      <RuleShow
        :rule="transaction.gate_affected_rule.rule"
        :condition="transaction.gate_affected_rule.condition"
      />
    </template>
    <template v-else>
      <RuleShow
        v-for="(rule, index) in transaction.gate_affected_rule.rule"
        :key="index"
        :rule="rule"
        :condition="transaction.gate_affected_rule.condition[index]"
      />
    </template>
  </div>
</template>

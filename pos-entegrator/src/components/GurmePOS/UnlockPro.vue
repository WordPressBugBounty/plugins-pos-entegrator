<script setup>
import DashboardCard from "@/components/GurmePOS/DashboardCard.vue";
import ListTable from "@/components/GurmePOS/UnlockPro/ListTable.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
const assetsUrl = window.gpos.assets_url;
const pro = [
  'more_gateways',
  'givewp_integration',
  'wcsubs_integration',
  'edd_integration',
  'learnpress_integration',
  'disable_installments',
  'saved_card_feat',
  'gate_feat',
];

const business = [
  'all_pro_feats',
  'elementor_integration',
  'wpforms_integration',
  'nijaforms_integration',
  'stand_alone',
];
</script>
<template>
  <DashboardCard class="bg-white rounded">
    <div class="w-full text-center mb-2 text-xl font-bold  text-blue-600">
      {{ $t('empower_pos') }}
    </div>
    <div class="w-full mb-4 text-lg text-center">
      {{ $t('empower_desc') }}
    </div>
    <div class="flex justify-around">
      <ListTable
        class="w-1/3"
        :properties="pro"
      >
        <template #head>
          <img
            :src="`${assetsUrl}/images/pro.png`"
            class="w-80 mb-2"
          >
        </template>
      </ListTable>
      <ListTable
        class="w-1/3"
        :properties="business"
      >
        <template #head>
          <img
            :src="`${assetsUrl}/images/business.png`"
            class="w-80 mb-2"
          >
        </template>
      </ListTable>
    </div>
    <div class="flex w-full justify-center">
      <PrimaryButton href="https://posentegrator.com/?utm_source=wp_plugin&utm_medium=referral&utm_campaign=dashboard">
        {{ $t('upgrade_now') }}
      </PrimaryButton>
    </div>
  </DashboardCard>
</template>

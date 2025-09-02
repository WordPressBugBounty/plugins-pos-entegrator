<script setup>
import Page from "@/layouts/Page.vue";
import Status from "@/components/GurmePOS/Status.vue";
import LastTransactions from "@/components/GurmePOS/LastTransactions.vue";
import Support from "@/components/GurmePOS/Support.vue";
import UnlockPro from "@/components/GurmePOS/UnlockPro.vue";
import Banners from "@/components/GurmePOS/Banners.vue";
const assetsUrl = window.gpos.assets_url;
</script>
<template>
  <page>
    <div class="flex w-full flex-col gap-4">
      <a
        href="https://faturaentegrator.com/satis-kanallari/woocommerce-fatura-entegrasyonu/?utm_source=wp_plugin&utm_medium=referral&utm_campaign=dashboard"
        target="_blank"
        class="p-2"
      >
        <img
          :src="`${assetsUrl}/images/fatura-entegrator-banner.png`"
          class="w-full rounded"
        >
      </a>
      <div class="flex w-full">
        <div class="flex w-1/2 p-2 flex-col gap-4">
          <Status />
          <LastTransactions />
        </div>
        <div class="flex w-1/2 p-2 flex-col gap-4">
          <Banners />
          <Support />
        </div>
      </div>
      <div class="flex w-full">
        <UnlockPro />
      </div>
    </div>
  </page>
</template>
<script setup>
import { ArrowLeftCircleIcon } from "@heroicons/vue/24/solid";
import Page from "@/layouts/Page.vue";
import TestDelete from "@/components/PaymentMethod/TestDelete.vue";
import ApiFields from "@/components/PaymentMethod/ApiFields.vue";
import Installments from "@/components/PaymentMethod/Installments.vue";
import Supports from "@/components/PaymentMethod/Supports.vue";
import WorldPAYExtra from "@/components/PaymentMethod/WorldPAYExtra.vue";
import { onBeforeMount } from "vue";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";

const { gatewayAccount } = storeToRefs(useGatewayAccount());
const { paymentGateways } = useMainStore();

onBeforeMount(() => {
  gatewayAccount.value.gateway_property = paymentGateways.find(
    (gateway) => gateway.id === gatewayAccount.value.gateway_id
  );
  // Sanal POS menüsünü seçili yap.
  const $ = window.jQuery;
  $("#toplevel_page_gurmepos").addClass("wp-has-current-submenu");
  $(".toplevel_page_gurmepos").addClass("wp-has-current-submenu");
  $("a[href='admin.php?page=gpos-payment-methods']")
    .parent("li")
    .addClass("current");
});

const prevPage = () => {
  window.history.back();
};
</script>

<template>
  <page
    :text="gatewayAccount.gateway_property.title"
    :href="`https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/${gatewayAccount.gateway_property.id}-sanal-pos-ayarlar/`"
  >
    <span
      class="w-max flex gap-1 items-center my-4 cursor-pointer"
      @click="prevPage"
    >
      <ArrowLeftCircleIcon class="text-blue-600 w-6 h-6" />
      <span class="text-blue-600 text-md">{{ $t("back_to") }}</span>
    </span>
    <div class="w-full flex flex-col gap-6">
      <TestDelete />
      <ApiFields />
      <WorldPAYExtra v-if="gatewayAccount.gateway_property.id === 'worldpay'" />
      <Installments v-if="gatewayAccount.gateway_property.payment_method_type === 'virtual_pos'" />
      <Supports />
    </div>
  </page>
</template>

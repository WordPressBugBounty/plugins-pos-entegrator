<script setup>
import Page from "@/layouts/Page.vue";
import AddPaymentMethod from "@/components/PaymentMethods/AddPaymentMethod.vue";
import TablesWithTabs from "@/components/PaymentMethods/TablesWithTabs.vue";
import TestMode from "@/components/PaymentMethods/TestMode.vue";
import Warning from "@/components/Alerts/Warning.vue";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";

const mainStore = useMainStore();
const { isTestMode } = storeToRefs(mainStore);

</script>
<template>
  <page
    :text="$t('payment_methods')"
    href="https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"
    video="https://www.youtube.com/watch?v=Qr9krF5aCp0"
  >
    <Warning
      v-if="isTestMode"
      class="p-4 mb-4"
    >
      {{ $t("test_mode_title") }}<template #content>
        {{ $t("test_mode_content") }}
      </template>
    </Warning>
    <div
      class="w-full flex justify-between items-center border mb-4 border-gray-100 rounded-lg p-5 bg-white shadow-md"
    >
      <TestMode />
      <AddPaymentMethod />
    </div>
    <TablesWithTabs />
  </page>
</template>
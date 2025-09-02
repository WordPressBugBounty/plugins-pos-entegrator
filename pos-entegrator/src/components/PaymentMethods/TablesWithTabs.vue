<script setup>
import { ref, shallowRef } from "vue";
import Tab from "@/components/PaymentMethods/TablesWithTabs/Tab.vue";
import VirtualPOSTable from "@/components/PaymentMethods/TablesWithTabs/VirtualPOSTable.vue";
import AlternativesTable from "@/components/PaymentMethods/TablesWithTabs/AlternativesTable.vue";
import CommonsTable from "@/components/PaymentMethods/TablesWithTabs/CommonsTable.vue";
import IFramesTable from "@/components/PaymentMethods/TablesWithTabs/IFramesTable.vue";
const tabs = ref([
  {
    title: "virtual_pos",
    description: "virtual_pos_tab_desc",
    active: true,
    component: shallowRef(VirtualPOSTable),
    count: window.gpos.virtual_pos_accounts.length,
  },
  {
    title: "iframe_payments",
    description: "iframe_payments_tab_desc",
    component: shallowRef(IFramesTable),
    count: window.gpos.iframe_accounts.length,
  },
  {
    title: "common_form_payments",
    description: "common_form_payments_tab_desc",
    component: shallowRef(CommonsTable),
    count: window.gpos.common_form_accounts.length,
  },
  {
    title: "alternative_payments",
    description: "alternative_payments_tab_desc",
    component: shallowRef(AlternativesTable),
    count: window.gpos.alternative_payment_accounts.length,
  },
  { title: "bank_transfers", soon: true },
  { title: "shopping_credits", soon: true },
]);

const component = shallowRef(VirtualPOSTable);
const description = ref(tabs.value[0].description);

const tabToActive = (selectedTab) => {
  tabs.value.forEach((tab) => {
    if (tab.title === selectedTab.title) {
      tab.active = true;
      component.value = tab.component;
      description.value = tab.description;
    } else {
      tab.active = false;
    }
  });
};
</script>
<template>
  <div class="w-full flex flex-col rounded-lg">
    <div class="flex gap-2 w-full">
      <Tab
        v-for="tab in tabs"
        :key="tab"
        :active="tab.active"
        :soon="tab.soon"
        :count="tab.count"
        @click="tab.soon ? false : tabToActive(tab)"
      >
        {{ $t(tab.title) }}
      </Tab>
    </div>
    <div class="bg-white w-full flex flex-col pt-2">
      <div class="p-3 break-words text-gray-400">
        {{ $t(description) }}
      </div>
      <component :is="component" />
    </div>
  </div>
</template>

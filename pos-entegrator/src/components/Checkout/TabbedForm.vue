<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { onMounted, provide, ref, shallowRef } from "vue";
import Single from "@/components/Checkout/CreditDebitCard.vue";
import Alternatives from "@/components/Checkout/Alternatives.vue";
import inputsChanged from "@/plugins/inputs-changed.js";

const { alternativePayments, bankTransfers, shoppingCredits } = useCheckout();
const component = shallowRef(Single);
provide("inTabbedForm", true);
const tabs = ref([
  {
    title: "credit_card",
    component: shallowRef(Single),
    active: true,
  },
]);

const tabToActive = async (title) => {
  await tabs.value.forEach(async (tab) => {
    if (tab.title === title) {
      tab.active = true;
      component.value = tab.component;
    } else {
      tab.active = false;
    }
  });
  setTimeout(() => {
    inputsChanged();
  }, 100);
};

onMounted(() => {
  if (alternativePayments.length) {
    tabs.value.push({
      title: "alternative_payments",
      component: shallowRef(Alternatives),
      // Tek alternatif ödeme varsa sekmede genel başlık yerine yöntemin kendisi gösterilir.
      method: 1 === alternativePayments.length ? alternativePayments[0] : false,
    });
  }
  if (bankTransfers.length) {
    tabs.value.push({
      title: "bank_transfers",
      component: "",
    });
  }
  if (shoppingCredits.length) {
    tabs.value.push({
      title: "shopping_credits",
      component: "",
    });
  }
});
</script>
<template>
  <div class="w-full flex flex-col">
    <div class="flex gap-1">
      <div
        v-for="tab in tabs"
        :key="tab.title"
        :class="`${
          tab.active ? '' : 'bg-slate-300'
        } border border-slate-300 border-b-0 rounded-t ${
          tab.method ? 'px-2 py-2' : 'p-2'
        } break-word border-box cursor-pointer text-md font-semibold w-full`"
        @click="tabToActive(tab.title)"
      >
        <div
          v-if="tab.method"
          class="h-full flex items-center justify-center"
        >
          <img
            v-if="tab.method.logo"
            :src="tab.method.logo"
            :alt="tab.method.title"
            :title="tab.method.title"
            class="h-auto w-auto max-h-[36px] max-w-[65%] object-contain"
          >
          <span v-else>{{ tab.method.title }}</span>
        </div>
        <template v-else>
          {{ $t(tab.title) }}
        </template>
      </div>
    </div>
    <div
      class="w-full px-2 py-6 border border-slate-300 border-t-0 rounded-b-md"
    >
      <component :is="component" />
    </div>
  </div>
</template>

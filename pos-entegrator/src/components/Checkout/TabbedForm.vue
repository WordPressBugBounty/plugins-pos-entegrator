<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { onMounted, ref, shallowRef } from "vue";
import Single from "@/components/Checkout/CreditDebitCard.vue";
import Alternatives from "@/components/Checkout/Alternatives.vue";

const { alternativePayments, bankTransfers, shoppingCredits } = useCheckout();
const component = shallowRef(Single);
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
};

onMounted(() => {
  if (alternativePayments.length) {
    tabs.value.push({
      title: "alternative_payments",
      component: shallowRef(Alternatives),
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
        } border border-slate-300 border-b-0 rounded-t p-2 break-word border-box cursor-pointer text-md font-semibold w-full`"
        @click="tabToActive(tab.title)"
      >
        {{ $t(tab.title) }}
      </div>
    </div>
    <div
      class="w-full px-2 py-6 border border-slate-300 border-t-0 rounded-b-md"
    >
      <component :is="component" />
    </div>
  </div>
</template>

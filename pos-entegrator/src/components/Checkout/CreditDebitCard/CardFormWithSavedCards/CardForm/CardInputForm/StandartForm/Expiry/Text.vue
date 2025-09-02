<script setup>
import { CalendarDaysIcon } from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { computed, ref  } from "vue";
const { card } = storeToRefs(useCheckout());
const focus = ref(false);
const month = computed(
  () => card.value.expiry?.replaceAll(/\s/g, "")?.split("/")[0]
);
const year = computed(() =>
  card.value.expiry?.replaceAll(/\s/g, "")?.split("/")[1]?.slice(-2)
);
</script>
<template>
  <div
    :class="`flex w-full !border !rounded ${
      focus ? '!border-blue-700' : '!border-gray-300'
    }`"
  >
    <span
      class="inline-flex relative !rounded-l items-center justify-center text-sm !bg-white !w-12 !min-w-max"
    >
      <CalendarDaysIcon
        class="!w-6 !h-6"
        aria-hidden="true"
      />
    </span>
    <input
      id="gpos-card-expiry"
      v-model="card.expiry"
      v-cardformat:formatCardExpiry
      :placeholder="$t('mmyy')"
      inputmode="numeric"
      type="tel"
      autocomplete="cc-exp"
      @focus="focus = !focus"
      @focusout="focus = !focus"
    >
    <input
      id="gpos-card-expiry-month"
      type="hidden"
      :value="month"
    >
    <input
      id="gpos-card-expiry-year"
      type="hidden"
      :value="year"
    >
  </div>
</template>

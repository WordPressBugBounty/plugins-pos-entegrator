<script setup>
import Spinner from "@/components/Checkout/Spinner.vue";
import { CreditCardIcon } from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
import { useUiStore } from "@/stores/UiStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";
const { card, assetsUrl } = storeToRefs(useCheckout());
const { loading } = storeToRefs(useUiStore());
const focus = ref(false);
</script>
<template>
  <div
    :class="`flex w-full !border !rounded ${
      focus ? '!border-blue-700' : '!border-gray-300'
    }`"
  >
    <span
      class="inline-flex relative !rounded-l items-center justify-start text-sm !bg-white !w-12 !min-w-max"
    >
      <Spinner
        v-if="loading"
        class="!w-6 !h-6"
      />
      <img
        v-else-if="['visa', 'mastercard', 'amex', 'troy'].includes(card.brand)"
        class="!w-12 !h-12 !m-0"
        :src="`${assetsUrl}/images/card/${card.brand}.svg`"
      >
      <CreditCardIcon
        v-else
        class="!w-6 h-6 !mx-3"
        aria-hidden="true"
      />
    </span>
    <input
      id="gpos-card-bin"
      v-model="card.bin"
      v-cardformat:formatCardNumber
      class=""
      placeholder="•••• •••• •••• ••••"
      inputmode="numeric"
      type="tel"
      autocomplete="cc-number"
      @focus="focus = !focus"
      @focusout="focus = !focus"
    >
  </div>
</template>

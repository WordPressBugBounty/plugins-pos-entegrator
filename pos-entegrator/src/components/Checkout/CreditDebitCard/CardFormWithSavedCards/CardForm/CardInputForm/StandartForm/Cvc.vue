<script setup>
import { LockClosedIcon } from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";
const store = useCheckout();
const { card, assetsUrl } = storeToRefs(store);
const focus = ref(false);
</script>
<template>
  <div
    :class="`relative flex w-full !border !bg-white !rounded ${
      focus ? '!border-blue-700' : '!border-gray-300'
    }`"
  >
    <span
      class="inline-flex relative !rounded-l !items-center justify-center text-sm !bg-white !w-12 !min-w-max"
    >
      <LockClosedIcon
        class="!w-6 !h-6 !mx-3"
        aria-hidden="true"
      />
    </span>
    <input
      id="gpos-card-cvv"
      v-model="card.cvv"
      v-cardformat:formatCardCVC
      placeholder="CVC"
      inputmode="numeric"
      type="tel"
      autocomplete="cc-csc"
      @focus="focus = !focus"
      @focusout="focus = !focus"
    >
    <span
      class="inline-flex relative !rounded z-10 items-center justify-center text-sm !bg-white !w-12 !min-w-max !px-2"
      :style="`${
        focus ? 'transform: rotateY(180deg);' : ''
      }   transform-style: preserve-3d;
        transition: transform 0.5s;`"
    >
      <div
        class="!w-6 !h-6 absolute"
        aria-hidden="true"
        style="backface-visibility: hidden"
      />
      <img
        class="!w-8 !h-6 absolute"
        :src="`${assetsUrl}/images/cvc.svg`"
        style="backface-visibility: hidden; transform: rotateY(180deg)"
      >
    </span>
  </div>
</template>

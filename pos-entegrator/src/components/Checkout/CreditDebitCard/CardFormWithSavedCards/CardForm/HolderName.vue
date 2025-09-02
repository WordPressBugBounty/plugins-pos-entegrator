<script setup>
import { UserCircleIcon } from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
const { formSettings } = useCheckout();
import { ref } from "vue";
const focus = ref(false);
</script>
<template>
  <div
    v-if="formSettings.holder_name_field"
    :class="`flex w-full border !rounded ${
      focus ? 'border-blue-700' : 'border-gray-300'
    }`"
  >
    <span
      class="inline-flex relative !rounded-l items-center justify-start text-sm !bg-white !w-12 !min-w-max"
    >
      <UserCircleIcon
        class="w-6 h-6 mx-3"
        aria-hidden="true"
      />
    </span>
    <input
      id="gpos-card-holder-name"
      type="text"
      :placeholder="$t('name_on_card')"
      @focus="focus = !focus"
      @focusout="focus = !focus"
    >
  </div>
</template>

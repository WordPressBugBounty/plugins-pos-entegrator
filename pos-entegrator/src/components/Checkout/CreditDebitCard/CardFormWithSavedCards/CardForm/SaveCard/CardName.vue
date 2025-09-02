<script setup>
import { TagIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
const focus = ref(false);
</script>
<template>
  <div
    :class="`flex w-full border !rounded ${
      focus ? 'border-blue-700' : 'border-gray-300'
    }`"
  >
    <span
      class="inline-flex relative !rounded-l items-center justify-start text-sm !bg-white !w-12 !min-w-max"
    >
      <TagIcon
        class="w-6 h-6 mx-3"
        aria-hidden="true"
      />
    </span>
    <input
      id="gpos-card-name"
      type="text"
      :placeholder="$t('card_name')"
      @focus="focus = !focus"
      @focusout="focus = !focus"
    >
  </div>
</template>

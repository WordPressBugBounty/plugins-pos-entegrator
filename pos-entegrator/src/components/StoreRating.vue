<script setup>
import { useUiStore } from "@/stores/UiStore";
const hideRatingMessage = useUiStore().hideRatingMessage;
const hide = window.gpos.hide_rating_message;
</script>
<template>
  <div
    v-if="!hide"
    class="p-4 mb-4 border border-blue-200 border-l-8 rounded-lg bg-white w-full flex flex-col"
    role="alert"
  >
    <div class="flex text-blue-600">
      Fuat POYRAZ | {{ $t("store_rating_founder") }}
    </div>
    <div class="flex items-center text-blue-600 text-md font-semibold mt-2">
      {{ $t("store_rating_title") }}
    </div>

    <div class="mb-4 text-sm">
      {{ $t("store_rating_desc") }}
    </div>
    <div class="flex underline gap-3">
      <a
        href="https://wordpress.org/plugins/pos-entegrator/#reviews"
        class="cursor-pointer"
        target="_blank"
        @click="hideRatingMessage"
      >
        {{ $t("store_rating_yes") }} 😊
      </a>
      <a
        href=""
        class="cursor-pointer"
        @click="hideRatingMessage"
      > {{ $t("store_rating_no") }} 👍 </a>
      <a
        href=""
        class="cursor-pointer"
        @click="hideRatingMessage"
      > {{ $t("store_rating_maybe") }} 🎉 </a>
    </div>
  </div>
</template>

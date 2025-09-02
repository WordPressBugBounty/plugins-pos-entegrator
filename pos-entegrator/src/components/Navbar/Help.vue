<script setup>
import {
  LifebuoyIcon,
  ReceiptRefundIcon,
  ChatBubbleLeftRightIcon,
  QuestionMarkCircleIcon,
} from "@heroicons/vue/24/solid";
import { ref } from "vue";
const show = ref(false);
</script>

<template>
  <div class="relative">
    <button
      class="flex items-center justify-center"
      @click="show = !show"
    >
      <div
        class="w-10 h-10 rounded-full bg-blue-600 flex justify-center items-center"
      >
        <QuestionMarkCircleIcon class="text-white w-6 h-6" />
      </div>
    </button>
    <div
      v-if="show"
      class="z-10 bg-white divide-y right-0 absolute divide-gray-100 rounded-lg shadow w-44"
    >
      <ul class="py-2 text-sm text-gray-700">
        <li>
          <a
            href="https://yardim.gurmehub.com/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic"
            target="_blank"
            class="flex gap-2 items-center px-4 py-2 hover:bg-gray-100"
          ><LifebuoyIcon class="w-4 h-4" /> {{ $t(`help`) }}</a>
        </li>
        <li>
          <a
            href="https://posentegrator.com/yol-haritasi/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic"
            target="_blank"
            class="flex gap-2 items-center px-4 py-2 hover:bg-gray-100"
          ><ReceiptRefundIcon class="w-4 h-4" />{{ $t("feedback") }}</a>
        </li>
        <li>
          <a
            href="https://forum.gurmehub.com/c/gurmehub/pos-entegrator/31/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic"
            target="_blank"
            class="flex gap-2 items-center px-4 py-2 hover:bg-gray-100"
          ><ChatBubbleLeftRightIcon class="w-4 h-4" /> {{ $t("forum") }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

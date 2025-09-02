<script setup>
import Warning from "@/components/Alerts/Warning.vue";
import { ref } from "vue";
const transaction = window.gpos.transaction;

const show = ref(false);
</script>
<template>
  <div
    v-if="transaction.status === 'gpos_failed'"
    class="cursor-pointer text-red-700 bg-red-200 rounded-full px-4 py-2"
    @click="show = !show"
  >
    {{ $t('error_notify') }}
  </div>

  <Warning
    v-if="show"
    class="p-3 absolute w-1/2 right-0 drop-shadow-2xl"
  >
    <div class="flex items-center justify-between w-full">
      <span> {{ $t('error_notify') }} </span>
      <span
        class="cursor-pointer"
        @click="show = !show"
      > &#x2715; </span>
    </div>

    <template #content>
      <div class="flex flex-col gap-4">
        <div>
          {{ $t('error_notify_desc_one') }}
        </div>
        <div>
          {{ $t('error_notify_desc_two') }}
          <a
            target="_blank"
            href="https://yardim.gurmehub.com/docs/pos-entegrator/neden-hata-aliyorum/"
            class="text-blue-600"
          >{{ $t('error_notify_link') }}</a>
        </div>
      </div>
    </template>
  </Warning>
</template>

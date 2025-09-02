<script setup>
import { ExclamationCircleIcon } from "@heroicons/vue/24/outline";

</script>
<template>
  <div class="w-full bg-red-200 text-red-700 p-3 rounded font-semibold flex gap-2">
    <ExclamationCircleIcon class="w-10" />  {{ $t('gateway_error') }}
  </div>
</template>
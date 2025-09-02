<script setup>
import { CheckIcon,XCircleIcon  } from "@heroicons/vue/24/outline"
const props = defineProps({
  status: {
    required: true,
    type: String,
  },
});
</script>
<template>
  <div
    v-if="'process_send_success' === props.status"
    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full "
  >
    <CheckIcon class="w-4 h-4" />
  </div>
  <div
    v-else-if="'process_send_fail' === props.status"
    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full "
  >
    <XCircleIcon class="w-4 h-4" />
  </div>
</template>

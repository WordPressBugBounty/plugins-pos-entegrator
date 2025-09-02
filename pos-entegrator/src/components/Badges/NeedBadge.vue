<script setup>
import { LockClosedIcon } from "@heroicons/vue/24/solid";
const isProActive = window.gpos.is_pro_active;
const isFormActive = window.gpos.is_form_active;
const props = defineProps({
  type: {
    required: false,
    type: String,
    default:'pro'
  },
});
</script>

<template>
  <div>
    <span
      v-if="!isProActive && props.type === 'pro'"
      class="bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"
    ><LockClosedIcon class="w-3 h-3" />Pro</span>
    <span
      v-if="!isFormActive && props.type === 'form'"
      class="text-slate-600 bg-slate-200 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"
    ><LockClosedIcon class="w-3 h-3" />Business</span>
  </div>
</template>
<script setup>
import { CheckIcon } from "@heroicons/vue/24/solid";

defineProps({
  disabled: {
    default: false,
    type: Boolean,
  },
});
</script>

<template>
  <button
    id="gpos-save-settings"
    type="button"
    :disabled="disabled"
    :class="`${disabled ? 'text-white bg-blue-400 cursor-not-allowed focus:ring-4 focus:outline-none focus:ring-blue-300' : 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300'} font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center`"
  >
    <CheckIcon class="w-4 h-4 mr-2" />
    {{ $t("save_settings") }}
  </button>
</template>

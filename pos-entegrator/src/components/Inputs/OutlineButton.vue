<script setup>
defineProps({
  href: {
    default: "",
    type: String,
  },
  disabled: {
    default: false,
    type: Boolean,
  },
});
</script>
<template>
  <a
    v-if="href"
    :href="href"
    class="!text-blue-700 border border-blue-700 !focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"
  >
    <slot />
  </a>
  <button
    v-else
    :disabled="disabled"
    type="button"
    :class="`${disabled ? '!text-gray-200 border border-gray-200' : '!text-blue-700 border border-blue-700'} focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2`"
  >
    <slot />
  </button>
</template>

<script setup>
defineProps({
  href: {
    type: String,
    default: "",
  },
  disabled: {
    type: Boolean,
    default: false,
  },
});
</script>
<template>
  <a
    v-if="href"
    :disabled="disabled"
    :href="href"
    class="!text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"
  >
    <slot />
  </a>
  <button
    v-else
    :disabled="disabled"
    type="button"
    :class="`text-white ${
      disabled ? 'bg-gray-300' : ' bg-blue-700'
    } focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2`"
  >
    <slot />
  </button>
</template>

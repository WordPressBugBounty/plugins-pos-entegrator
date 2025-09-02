<script setup>
const props = defineProps({
  text: {
    required: true,
    type: String,
  },
})
</script>

<template>
  <div
    class="p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"
  >
    {{ props.text }}
  </div>
</template>
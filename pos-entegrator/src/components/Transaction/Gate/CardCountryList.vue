<script setup>
defineProps({
  condition: {
    type: Array,
    required: true,
  },
});
</script>
<template>
  <div>
    {{ condition.join(", ") }}
  </div>
</template>

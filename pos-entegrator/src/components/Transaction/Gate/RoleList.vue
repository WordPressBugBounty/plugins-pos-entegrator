<script setup>
defineProps({
  condition: {
    type: Array,
    required: true,
  },
});

const roles = window.gpos.wp_roles || [];
</script>
<template>
  <div>
    {{ condition.map((e) => roles[e]).join(", ") }}
  </div>
</template>

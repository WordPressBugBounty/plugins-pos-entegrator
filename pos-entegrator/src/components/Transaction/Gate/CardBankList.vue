<script setup>
defineProps({
  condition: {
    type: Array,
    required: true,
  },
});

const bankCodes = window.gpos.bank_codes || [];
</script>
<template>
  <div>
    {{ condition.map((e) => bankCodes[e]).join(", ") }}
  </div>
</template>

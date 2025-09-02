<script setup>
defineProps({
  number: {
    type: [Number, String],
    default: 0,
  },
  currency: {
    type: String,
    default: "TRY",
  },
});
</script>
<template>
  <span>
    {{
      vueNumberFormat(parseFloat(number), {
        suffix: ` ${currency}`,
      })
    }}
  </span>
</template>

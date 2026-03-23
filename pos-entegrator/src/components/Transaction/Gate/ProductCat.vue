<script setup>
const props = defineProps({
  condition: {
    type: String,
    required: true,
  },
});

const productCategories = window.gpos.wc_categories || [];

</script>
<template>
  <div>
    {{
      condition
        .split("\n")
        .map((e) => productCategories.find((c) => c.value == e)?.text)
        .join(", ")
    }}
  </div>
</template>

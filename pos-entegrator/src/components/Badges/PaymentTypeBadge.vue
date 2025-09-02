<script setup>
const props = defineProps({
  type: {
    required: true,
    type: String,
  },
});
const classes = () => {
  let classes = "";
  switch (props.type) {
    case "virtual_pos":
      classes = "border-blue-600 text-blue-600 bg-blue-200";
      break;
    case "common_form_payment":
      classes = "border-yellow-600 text-yellow-600 bg-yellow-200";
      break;
    case "iframe_payment":
      classes = "border-green-600 text-green-600 bg-green-200";
      break;
    case "alternative_payment":
      classes = "border-teal-600 text-teal-600 bg-teal-200";
      break;
    case "bank_transfer":
      classes = "border-slate-600 text-slate-600 bg-slate-200";
      break;
    case "shopping_credit":
      classes = "border-purple-600 text-purple-600 bg-purple-200";
      break;
  }

  return classes;
};
</script>
<template>
  <div
    :class="`border ${classes()} text-xs font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max`"
  >
    {{ $t(type) }}
  </div>
</template>

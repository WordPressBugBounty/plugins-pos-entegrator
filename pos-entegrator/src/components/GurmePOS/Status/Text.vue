<script setup>
defineProps({
  count: {
    type: [Number, String],
    default: 0,
  },
  status: {
    type: String,
    default: "",
  },
});

function getColorByStatus(status) {
  let color = "text-gray-400";
  switch (status) {
    case "gpos_started":
      color = "text-yellow-600";
      break;
    case "gpos_failed":
      color = "text-red-600 ";
      break;
    case "gpos_completed":
      color = "text-green-600";
      break;
    case "total":
      color = "text-blue-600";
      break;
  }
  return color;
}
</script>

<template>
  <div class="flex flex-col">
    <div :class="`flex gap-2 items-end font-bold ${getColorByStatus(status)}`">
      <span class="text-lg">{{ count }}</span>
      <span>{{ $t("transaction") }}</span>
    </div>
    <div
      class="text-gray-600"
      v-text="$t(status)"
    />
  </div>
</template>

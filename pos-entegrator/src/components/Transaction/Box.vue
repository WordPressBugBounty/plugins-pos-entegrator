<script setup>
defineProps({
  color: {
    type: String,
    default: "gray",
  },
});
const borderColor = (color) => {
  switch (color) {
    case "green":
      return "border-t-green-500";
    case "blue":
      return "border-t-blue-500";
    case "red":
      return "border-t-red-500";
  }
};
</script>
<template>
  <div
    :class="`w-full flex flex-col justify-around h-full bg-white p-4 rounded-lg border border-gray-200 border-t-[5px] ${borderColor(
      color
    )}`"
  >
    <slot />
  </div>
</template>

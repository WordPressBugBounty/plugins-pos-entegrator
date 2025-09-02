<script setup>
defineProps({
  descriptions: {
    required: true,
    type: Array,
  },
});
</script>
<template>
  <div
    class="border-l py-3 border-slate-600 border-dashed w-full flex flex-col gap-3 z-10 font-semibold"
  >
    <div
      v-for="(desc, index) in descriptions"
      :key="index"
      class="w-full z-20 flex gap-3 items-center"
    >
      <div class="-ml-1 font-semibold rounded-full bg-slate-600 h-1 w-1 p-1" />
      <div class="text-sm break-words px-2">
        {{ desc }}
      </div>
    </div>
  </div>
</template>

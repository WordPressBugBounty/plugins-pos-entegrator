<script setup>
import SoonBadge from "@/components/Badges/SoonBadge.vue";
defineProps({
  active: {
    type: Boolean,
    default: false,
  },
  soon: {
    type: Boolean,
    default: false,
  },
  count: {
    type: [Number, String],
    default: 0,
  },
});
</script>
<template>
  <div
    :class="`py-4 px-6 border-2  border-b-0 rounded-t-lg  cursor-pointer font-semibold relative flex items-center gap-1 justify-center break-words ${
      active ? 'bg-white border-white' : 'bg-gray-300 border-gray-300'
    }`"
  >
    <slot /> <span class="text-green-600 font-bold">{{ count ? `(${count})` : "" }} </span>
    <SoonBadge
      v-if="soon"
      class="ml-2"
    />
  </div>
</template>

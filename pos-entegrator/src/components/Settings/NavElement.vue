<script setup>
const assetUrl = window.gpos.assets_url;
const totalErrorCount = window.gpos.total_error_count;
defineProps({
  active: {
    type: Boolean,
    default: false,
  },
  icon: {
    type: String,
    required: true,
  },
  newBadge: {
    type: Boolean,
    default: false,
  },
  errorBadge: {
    type: Boolean,
    default: false,
  },
});
</script>
<template>
  <div
    :class="`relative py-4 pl-8 border-l-4 border-b cursor-pointer flex items-center font-medium text-sm
   ${
      active ? ' bg-white border-l-blue-800' : 'border-l-[#FAFAFA] bg-[#FAFAFA]'
    }`"
  >
    <img
      class="w-5 h-5 mr-3 text-blue-600"
      :src="`${assetUrl}/images/settings/${icon}.svg`"
      alt=""
    >
    <div
      :class="`${
        active ? 'text-black' : 'text-[#6E778A]'
      } flex gap-2 w-full items-center `"
    >
      <slot />
    </div>

    <div
      v-if="newBadge"
      class="text-white py-2 px-1 text-center text-[12px] absolute top-0 right-5 rounded-b-full"
      style="
        background-color: #0056ff;
        background-image: linear-gradient(19deg, #0056ff 30%, #b721ff 100%);
      "
    >
      {{ $t("new") }}
    </div>

    <div
      v-if="errorBadge && parseInt(totalErrorCount) > 0"
      class="inline-flex items-center bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-1 rounded-full gap-1"
    >
      {{ totalErrorCount }}
    </div>
  </div>
</template>

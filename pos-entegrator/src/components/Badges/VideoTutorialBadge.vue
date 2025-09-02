<script setup>
import { VideoCameraIcon } from "@heroicons/vue/24/solid";

defineProps({
  video: {
    default: "",
    type: String,
  },
});
</script>

<template>
  <a
    v-if="video"
    :href="video"
    target="_blank"
    class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full gap-1 hover:bg-red-800 hover:text-white"
  >
    <VideoCameraIcon class="w-5 h-5" />
    {{ $t("video_tutorial") }}</a>
</template>
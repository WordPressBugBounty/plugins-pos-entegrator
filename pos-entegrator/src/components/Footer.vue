<script setup>
import { QuestionMarkCircleIcon } from "@heroicons/vue/24/solid";
import VideoTutorialBadge from "@/components/Badges/VideoTutorialBadge.vue";
const assetsUrl = window.gpos.assets_url;
defineProps({
  text: {
    required: true,
    type: String,
  },
  href: {
    required: true,
    type: String,
  },
  video: {
    default: "",
    type: String,
  },
});
</script>
<template>
  <div class="w-full flex justify-center">
    <div class="flex flex-col gap-2">
      <div
        class="py-2 px-5 border rounded-full flex gap-2 bg-white items-center"
      >
        <QuestionMarkCircleIcon class="w-5 h-5" />
        <a
          :href="href"
          target="_blank"
          class="text-blue-600"
        >
          {{ $t("help_title_link", [text]) }}</a>
        <VideoTutorialBadge :video="video" />
      </div>
      <div class="w-full flex justify-center">
        <div class="flex gap-2 items-center mt-2">
          <a
            href="https://gurmehub.com/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"
            target="_blank"
          >
            <img
              :src="`${assetsUrl}/images/gurmehub-footer.svg`"
              class="w-32"
            >
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

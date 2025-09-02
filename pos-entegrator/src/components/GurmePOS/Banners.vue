<script setup>
import { ref } from "vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
const banners = window.gpos.dashboard.banners.dashboard;
const index = ref(0);
const showArrows = ref(false);
const downIndex = () => {
  if (index.value === 0) {
    index.value = banners.length - 1;
  } else {
    index.value--;
  }
};
const upIndex = () => {
  if (index.value === banners.length - 1) {
    index.value = 0;
  } else {
    index.value++;
  }
};

setInterval(() => {
  if (false === showArrows.value) {
    upIndex();
  }
}, 4000);
</script>
<template>
  <div
    v-if="banners"
    class="w-full relative flex items-center justify-center"
    @mouseenter="showArrows = true"
    @mouseleave="showArrows = false"
  >
    <div
      v-if="showArrows"
      class="absolute left-2 z-40 rounded-full p-2 shadow-lg bg-white cursor-pointer"
      @click="downIndex()"
    >
      <ChevronLeftIcon class="w-4 h-4" />
    </div>
    <div class="flex bg-white rounded">
      <img
        :src="banners[index].image"
        class="w-1/3 rounded-l object-contain"
      >
      <div class="w-2/3 flex flex-col px-3 py-5 gap-4 justify-between">
        <div class="text-2xl text-blue-700">
          {{ banners[index].title }}
        </div>
        <div class="">
          {{ banners[index].description }}
        </div>
        <div
          v-if="banners[index].actions.length > 0"
          class="flex gap-2"
        >
          <PrimaryButton
            v-for="(action, key) in banners[index].actions"
            :key="key"
            :href="action.href"
            target="_blank"
          >
            {{ action.buttonText }}
          </PrimaryButton>
        </div>
      </div>
    </div>
    <div
      v-if="showArrows"
      class="absolute right-2 z-40 rounded-full p-2 shadow-lg bg-white cursor-pointer"
      @click="upIndex()"
    >
      <ChevronRightIcon class="w-4 h-4" />
    </div>
  </div>
</template>

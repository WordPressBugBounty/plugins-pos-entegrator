<script setup>
import {
  PlayIcon,
  ArrowPathIcon,
  ExclamationCircleIcon,
  CheckIcon ,
} from "@heroicons/vue/24/outline";

defineProps({
  transaction: {
    required: true,
    type: Object,
  },
});

function getColorByType(type) {
  let color = "bg-gray-100";
  switch (type) {
    case "start":
      color = "bg-yellow-100";
      break;
    case "status_update":
      color = "bg-blue-100";
      break;
    case "failed":
      color = "bg-red-100";
      break;
    case "complete":
      color = "bg-green-200";
      break;
  }
  return color;
}

function getIconByType(type) {
  let icon = "";
  switch (type) {
    case "start":
      icon = PlayIcon;
      break;
    case "status_update":
      icon = ArrowPathIcon;
      break;
    case "failed":
      icon = ExclamationCircleIcon;
      break;
    case "complete":
      icon = CheckIcon;
      break;
  }
  return icon;
}
</script>
<template>
  <div class="flex flex-col p-3 bg-white rounded h-fit shadow-md">
    <div
      class="text-blue-600 font-bold text-lg"
      v-text="$t('timeline')"
    />
    <div class="border border-[#F7F7F7] my-4" />
    <ol class="relative border-l border-gray-200 space-y-10">
      <li
        v-for="(note, index) in transaction.notes"
        :key="index"
        class="ml-6"
      >
        <span
          :class="`absolute flex items-center  justify-center w-8 h-8 ${getColorByType(
            note.type
          )} rounded-full -left-4 ring-8 ring-white`"
        >
          <component
            :is="getIconByType(note.type)"
            class="w-6 h-6"
          />
        </span>
        <h3 class="mb-1 text-sm font-medium text-gray-900">
          {{ note.note }}
        </h3>
        <time
          class="block mb-2 text-xs font-normal leading-none text-gray-400"
        >{{ note.date }}</time>
      </li>
    </ol>
  </div>
</template>

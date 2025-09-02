<script setup>
import { ExclamationTriangleIcon } from "@heroicons/vue/24/solid";
</script>

<template>
  <div
    id="alert-additional-content-4"
    class="text-yellow-600 border border-yellow-200 rounded-lg bg-yellow-50 "
    role="alert"
  >
    <div class="flex items-center">
      <ExclamationTriangleIcon class="w-4 h-4 mr-2" />
      <h3 class="text-yellow-600  text-lg font-medium w-full">
        <slot />
      </h3>
    </div>
    <div class="text-yellow-600  mt-2 mb-4 text-sm">
      <slot name="content" />
    </div>
  </div>
</template>
<script setup>
import { ExclamationTriangleIcon } from "@heroicons/vue/24/solid";
</script>

<template>
  <div
    id="alert-additional-content-4"
    class="p-4 mb-4 text-red-600 border border-red-200 rounded-lg bg-red-50 "
    role="alert"
  >
    <div class="flex items-center">
      <ExclamationTriangleIcon class="w-4 h-4 mr-2" />
      <h3 class="text-red-600  text-lg font-medium">
        <slot />
      </h3>
    </div>
    <div class="text-red-600  mt-2 mb-4 text-sm">
      <slot name="content" />
    </div>
  </div>
</template>
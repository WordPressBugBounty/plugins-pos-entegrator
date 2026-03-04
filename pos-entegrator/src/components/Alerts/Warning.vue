<script setup>
import { ExclamationTriangleIcon } from "@heroicons/vue/24/solid";
</script>

<template>
  <div
    class="p-4 mb-4 text-orange-600 border border-orange-200 rounded-lg bg-orange-50 gpos-alert-warning"
    role="alert"
  >
    <div class="flex items-center">
      <ExclamationTriangleIcon class="w-4 h-4 mr-2" />
      <h3 class="text-orange-600  text-lg font-medium w-full">
        <slot />
      </h3>
    </div>
    <div class="text-orange-600  mt-2 mb-4 text-sm">
      <slot name="content" />
    </div>
  </div>
</template>
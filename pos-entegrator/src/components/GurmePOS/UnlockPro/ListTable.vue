<script setup>
import { CheckIcon } from "@heroicons/vue/24/outline";
defineProps({
  properties: {
    type: Array,
    default: () => [],
  },
});
</script>
<template>
  <table class="w-1/2 h-max">
    <thead>
      <tr>
        <th>
          <div class="flex justify-center">
            <slot name="head" />
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="text in properties"
        :key="text"
      >
        <td>
          <div class="flex gap-1 font-medium py-2 items-center">
            <CheckIcon class="text-green-600 w-6 h-6" />
            {{ $t(text) }}
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

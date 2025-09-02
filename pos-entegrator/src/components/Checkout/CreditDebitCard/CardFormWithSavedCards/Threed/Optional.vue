<script setup>
import { ShieldCheckIcon } from "@heroicons/vue/24/solid";
import { ref } from "vue";

const threed = ref(true);
</script>
<template>
  <label
    class="!flex text-sm font-medium items-center gap-1 cursor-pointer"
    for="gpos-threed"
  >
    <input
      id="gpos-threed"
      v-model="threed"
      type="checkbox"
      value="on"
      class="border-gray-300 rounded !block !m-0"
    >
    <ShieldCheckIcon
      :class="`w-5 ${threed ? 'text-green-600' : 'text-gray-300'}`"
    />
    {{ $t("threed_checkout") }}
  </label>
</template>

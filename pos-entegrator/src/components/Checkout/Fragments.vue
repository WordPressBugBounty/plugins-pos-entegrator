<script setup>
import { ref } from "vue";
import encrpyt from "@/plugins/forge.js";

const fragment = ref("");

document.addEventListener("gpos-inputs-changed", async (event) => {
  fragment.value = encrpyt(JSON.stringify(event.detail));
  window.gpos.fragment={
    _wp_refreshed_fragments:fragment.value.hex,
    _wp_fragment:fragment.value.iv 
  };

});
</script>
<template>
  <div>
    <input
      type="hidden"
      name="_wp_refreshed_fragments"
      :value="fragment.hex"
    >
    <input
      type="hidden"
      name="_wp_fragment"
      :value="fragment.iv"
    >
  </div>
</template>

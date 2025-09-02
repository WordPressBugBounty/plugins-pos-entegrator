<script setup>
const assetUrl = window.gpos.assets_url;
</script>
<template>
  <div class="h-full w-full flex relative justify-center items-center">
    <div
      class="absolute h-full w-full z-20 left-0 top-0 bg-white bg-opacity-0 backdrop-blur-sm rounded"
    />
    <img
      :src="`${assetUrl}/images/settings/display_installment_locked.jpg`"
      class="absolute h-full w-full z-10 left-0 top-0"
    >
    <a
      href="https://posentegrator.com/ozellikler/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=settings"
      target="_blank"
      class="z-30"
    >
      <img
        :src="`${assetUrl}/images/settings/display_installment_unlock.png`"
        class="rounded drop-shadow-lg w-[540px] h-[600px]"
      >
    </a>
  </div>
</template>

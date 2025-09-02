<template>
  <div class="w-full flex flex-col ">
    <div class="w-full flex flex-wrap">
      <slot />
    </div>
    <div class="w-full pt-8 px-3">
      <slot name="action" />
    </div>
  </div>
</template>

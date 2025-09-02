<template>
  <div class="flex flex-col gap-2 w-full rounded-lg">
    <span
      v-if="$slots.header"
      class="w-full  bg-gray-50 p-3 rounded-t-lg  text-lg"
    >
      <slot name="header" />
    </span>
    <div class="p-6">
      <slot />
    </div>
    <div>
      <slot name="footer" />
    </div>
  </div>
</template>

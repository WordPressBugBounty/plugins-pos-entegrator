<template>
  <div class="flex flex-col gap-2 m-1 p-2 w-full relative">
    <span
      v-if="$slots.header"
      class="w-full text-blue-600 font-bold text-md"
    >
      <slot name="header" />
    </span>
    <div
      v-if="$slots.header"
      class="border border-gray-100 mb-2"
    />
    <div>
      <slot />
    </div>
    <div>
      <slot name="footer" />
    </div>
  </div>
</template>

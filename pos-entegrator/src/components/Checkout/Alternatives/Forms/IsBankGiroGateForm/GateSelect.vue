<script setup>
import { ref, computed } from "vue";
import { ChevronDownIcon, ChevronUpIcon } from "@heroicons/vue/24/solid";
const assetUrl = window.gpos.asset_dir_url;
const show = ref(false);

const props = defineProps({
  modelValue: {
    type: [Object, Boolean],
    required: true,
  },
  gates: {
    type: Array,
    required: true,
  },
});
const emit = defineEmits(["update:modelValue"]);

const componentValue = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});
</script>
<template>
  <div class="w-full flex flex-col p-4">
    <input
      id="gpos-isbank-girogate-gateway"
      type="hidden"
      :value="componentValue.value"
    >
    <div
      class="w-full flex justify-between border font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center cursor-pointer select-none"
      @click="show = !show"
    >
      <div class="flex gap-3 items-center">
        <template v-if="componentValue">
          <img
            :src="`${assetUrl}/images/girogate/${componentValue.img}`"
            class="!w-16 !h-10 object-contain"
            alt=""
          >
          <div class="font-semibold text-sm">
            {{ componentValue.title }}
          </div>
        </template>
        <template v-else>
          {{ $t("select_method") }}
        </template>
      </div>
      <ChevronUpIcon
        v-if="show"
        class="h-4 w-4"
      />
      <ChevronDownIcon
        v-else
        class="h-4 w-4"
      />
    </div>
    <div
      v-if="show"
      class="w-full relative"
    >
      <div
        class="w-full divide-y border rounded-lg max-h-96 overflow-auto shadow-lg absolute bg-white z-50"
      >
        <div
          v-for="gate in gates"
          :key="gate.value"
          class="w-full p-2 cursor-pointer hover:bg-slate-50 select-none flex gap-4 items-center font-semibold text-sm"
          @click="(componentValue = gate), (show = false)"
        >
          <img
            :src="`${assetUrl}/images/girogate/${gate.img}`"
            class="!w-16 !h-10 object-contain"
            alt=""
          >
          <div>
            {{ gate.title }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

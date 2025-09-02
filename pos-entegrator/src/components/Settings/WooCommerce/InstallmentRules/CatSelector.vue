<script setup>
import { computed, ref } from "vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import { ChevronDownIcon, ChevronUpIcon } from "@heroicons/vue/24/solid";
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";
const isProActive = window.gpos.is_pro_active;
const props = defineProps({
  modelValue: { type: Array, required: true },
});
const emit = defineEmits(["update:modelValue"]);
const categories = window.gpos.wc_categories || {};
const open = ref(false);
const search = ref("");
const fiteredCats = computed(() =>
  categories.filter((cat) =>
    cat.text.toLowerCase().includes(search.value.toLowerCase())
  )
);
const componentValue = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});

const getTexts = () => {
  const selectedCats = categories.filter((cat) =>
    componentValue.value.includes(cat.value)
  );
  return selectedCats.map((e) => e.text).join(", ");
};
</script>
<template>
  <div class="w-full">
    <button
      class="w-full flex justify-between bg-white border font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center"
      type="button"
      :disabled="!isProActive"
      @click="open = !open"
    >
      {{ componentValue.length > 0 ? getTexts() : $t("select_category") }}
      <ChevronUpIcon
        v-if="open"
        class="h-4 w-4"
      />
      <ChevronDownIcon
        v-else
        class="h-4 w-4"
      />
    </button>
    <div
      v-if="open"
      class="z-10 relative"
    >
      <div class="absolute p-2 w-full bg-white rounded-lg shadow">
        <div class="relative w-full flex items-center">
          <span
            class="inline-flex items-center px-3 py-1 text-sm !border !border-r-0 border-gray-300 !rounded-l !rounded-r-none !bg-white"
          >
            <MagnifyingGlassIcon class="w-5 h-5 text-blue-600" />
          </span>
          <input
            v-model="search"
            type="text"
            class="!rounded-r !border-y !border-r !border-l-0 !rounded-l-none !w-full !border-gray-300 !bg-white !m-0 focus:ring-0 focus:ring-offset-0"
            :placeholder="$t('search')"
          >
        </div>
        <ul class="h-48 overflow-y-auto text-sm text-gray-700 mt-2 bg-gray-50">
          <li
            v-for="cat in fiteredCats"
            :key="cat.value"
          >
            <div class="flex items-center pl-2 rounded hover:bg-gray-100">
              <input
                :id="cat.value"
                v-model="componentValue"
                type="checkbox"
                :value="cat.value"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
              >
              <label
                :for="cat.value"
                class="w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded"
              >{{ cat.text }}</label>
            </div>
          </li>
        </ul>
        <div class="flex justify-end pt-2">
          <PrimaryButton @click="open = !open">
            {{ $t("select") }}
          </PrimaryButton>
        </div>
      </div>
    </div>
  </div>
</template>

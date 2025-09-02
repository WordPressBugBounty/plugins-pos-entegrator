<script setup>
import { ArrowUturnLeftIcon, PlusIcon } from "@heroicons/vue/24/solid";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { computed } from "vue";
const { selectedSavedCard, card } = storeToRefs(useCheckout());
const props = defineProps({
  modelValue: { type: [Number, Boolean], required: true },
});
const emit = defineEmits(["update:modelValue"]);
const useSavedCard = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});

const change = () => {
  selectedSavedCard.value = "";
  card.value.bin = "";
  card.value.type = "";
  useSavedCard.value = !useSavedCard.value;
};
</script>
<template>
  <div
    class="rounded bg-gray-100 w-full p-3 border shadow hover:shadow-md border-gray-300 cursor-pointer mb-3 text-md font-semibold flex items-center"
    @click="change()"
  >
    <template v-if="useSavedCard">
      <PlusIcon
        class="w-6 h-6 mx-3"
        aria-hidden="true"
      />
      {{ $t("pay_with_diff") }}
    </template>
    <template v-else>
      <ArrowUturnLeftIcon
        class="w-6 h-6 mx-3"
        aria-hidden="true"
      />

      {{ $t("pay_with_saved") }}
    </template>
  </div>
</template>

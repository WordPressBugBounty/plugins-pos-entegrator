<script setup>
import { computed, onMounted } from "vue";
const props = defineProps({
  modelValue: { type: [Array, String], required: true },
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
onMounted(() => {
  componentValue.value =
    ! componentValue.value ? [] : componentValue.value;
});
const days = [
  "monday",
  "tuesday",
  "wednesday",
  "thursday",
  "friday",
  "saturday",
  "sunday",
];
</script>
<template>
  <div class="grid grid-cols-2">
    <label
      v-for="day in days"
      :key="day"
      :for="day"
    >
      <input
        :id="day"
        v-model="componentValue"
        name="gpos-day-select"
        type="checkbox"
        :value="day"
      >
      {{ $t(day) }}
    </label>
  </div>
</template>

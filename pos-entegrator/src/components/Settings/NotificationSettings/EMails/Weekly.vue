<script setup>
import { computed } from "vue";
import Switch from "@/components/Inputs/Switch.vue";
import TextField from "@/components/Inputs/TextField.vue";

const props = defineProps({
  modelValue: { type: Object, required: true },
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
  <div class="flex items-center justify-between gap-4">
    <Switch
      v-model="componentValue.active"
      class="w-4/12"
    >
      {{ $t("active_weekly_mails")
      }}<template #subtitle>
        {{ $t("active_weekly_mails_desc") }}
      </template>
    </Switch>
    <div class=" w-3/12" />
    <div class="flex flex-col gap-2 w-2/12">
      <select
        v-model="componentValue.notify_day"
        class="w-full !bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !p-2.5"
      >
        <option
          v-for="day in days"
          :key="day"
          :value="day"
        >
          {{ $t(day) }}
        </option>
      </select>
      <TextField
        v-model="componentValue.notify_hour"
        placeholder="13:00"
        class="w-full"
      />
    </div>

    <textarea
      v-model="componentValue.emails"
      style="resize: none"
      placeholder="example1@example.com example2@example.com example3@example.com"
      rows="3"
      class="block p-2.5 w-3/12 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 condition-list"
    />
  </div>
</template>

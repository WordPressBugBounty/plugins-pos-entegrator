<script setup>
import { computed } from "vue";
import Switch from "@/components/Inputs/Switch.vue";
import TextField from "@/components/Inputs/TextField.vue";
import DaySelect from "@/components/Settings/NotificationSettings/EMails/Daily/DaySelect.vue";
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
</script>
<template>
  <div class="flex items-center justify-between gap-4">
    <Switch
      v-model="componentValue.active"
      class="w-4/12"
    >
      {{ $t("active_daily_mails")
      }}<template #subtitle>
        {{ $t("active_daily_mails_desc") }}
      </template>
    </Switch>
    <DaySelect
      v-model="componentValue.notify_days"
      class="w-3/12"
    />
    <TextField
      v-model="componentValue.notify_hour"
      placeholder="13:00"
      class="w-2/12"
    />

    <textarea
      v-model="componentValue.emails"
      style="resize: none"
      placeholder="example1@example.com example2@example.com example3@example.com"
      rows="3"
      class="block p-2.5 w-3/12 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 condition-list"
    />
  </div>
</template>

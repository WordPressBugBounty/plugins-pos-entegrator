<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import TextField from "@/components/Inputs/TextField.vue";
import { computed } from "vue";
const props = defineProps({ modelValue: { type: Object, required: true } });
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
  <SettingsCard>
    <template #header>
      {{ $t("other") }}
    </template>
    <TextField
      v-model="componentValue.save_info"
      :label="$t('save_info')"
      :placeholder="$t('note')"
    />
  </SettingsCard>
</template>

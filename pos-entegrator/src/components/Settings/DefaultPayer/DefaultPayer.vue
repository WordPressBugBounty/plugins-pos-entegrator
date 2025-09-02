<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Info from '@/components/Alerts/Info.vue';
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
      {{ $t("default_payer_info") }}
    </template>
    <div class="grid w-full grid-cols-2 gap-3">
      <TextField
        v-for="prop in [
          'first_name',
          'last_name',
          'phone',
          'email',
          'address',
          'state',
          'city',
          'zipcode',
          'country',
          'id'
        ]"
        :key="prop"
        v-model="componentValue[prop]"
        :label="$t(prop)"
        :placeholder="$t(prop)"
      />
    </div>
    <template #footer>
      <Info :text="$t('default_payer_long_desc')" />
    </template>
  </SettingsCard>
</template>

<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Switch from "@/components/Inputs/Switch.vue";
import TextField from "@/components/Inputs/TextField.vue";
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
      {{ $t("payment_id_settings") }}
    </template>
    <Switch
      v-model="componentValue.active"
    >
      {{ $t("activate")
      }}<template #subtitle>
        {{ $t("payment_id_settings_active") }}
      </template>
    </Switch>
    <div v-if="componentValue.active">
      <div class="flex w-full flex-col gap-4 mt-5">
        <Info :text="$t('payment_id_setting_desc')" />
        <TextField
          v-model="componentValue.separator"
        
          :label="$t('payment_id_settings_separator_value')"
          :placeholder="$t('payment_id_settings_separator_value')"
          maxlength="5"
        >
          <template #subtitle>
            {{ $t('payment_id_settings_separator_description') }}
          </template>
        </TextField>  
      </div>
    </div>
  </SettingsCard>
</template>

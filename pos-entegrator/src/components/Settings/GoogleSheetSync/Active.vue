<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import Switch from "@/components/Inputs/Switch.vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
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
      {{ $t("google_sheet_sync") }}
    </template>
    <Switch
      v-model="componentValue.active"
    >
      {{ $t("activate")
      }}<template #subtitle>
        {{ $t("gss_desc") }}
      </template>
    </Switch>
    <div
      v-if="componentValue.active"
      class="mt-5"
    >
      <div class="w-full flex flex-col gap-8">
        <label class="w-1/2">
          {{ $t("gss_credentials") }}
          <textarea
            v-model="componentValue.credentials"
            rows="3"
            :placeholder="$t('gss_credentials_desc')"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
          />
        </label>
      </div>
      <div class="mt-5 mb-5">
        <TextField
          v-model="componentValue.sheet_id"
          placeholder="14jzIqLQxfHLq_z6P4jtF-ZXF9d2UpzTnmB2TlFmrswI"
          :label="$t('gss_file')"
          class="w-2/12"
        >
          <template #subtitle>
            https://docs.google.com/spreadsheets/d/<strong>14jzIqLQxfHLq_z6P4jtF-ZXF9d2UpzTnmB2TlFmrswI</strong>/edit#gid=0
          </template>
        </TextField>
      </div>
    </div>
  </SettingsCard>
</template>
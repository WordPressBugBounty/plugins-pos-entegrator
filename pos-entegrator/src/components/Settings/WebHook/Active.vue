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
      {{ $t("webhook") }}
    </template>
    <Switch
      v-model="componentValue.active"
    >
      {{ $t("activate")
      }}<template #subtitle>
        {{ $t("webhook_desc") }}
      </template>
    </Switch>
    <div
      v-if="componentValue.active"
      class="mt-5"
    >
      <div class="w-full flex flex-col">
        <TextField
          v-model="componentValue.webhook_url"
          :placeholder="$t('webhook_url_placeholder')"
          :label="$t('url')"
        >
          <template #subtitle>
            {{ $t('webhook_url_desc') }}
          </template>
        </TextField>
      </div>
    </div>
  </SettingsCard>
</template>
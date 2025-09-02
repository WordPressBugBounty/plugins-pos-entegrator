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
      {{ $t("tag_manager_settings") }}
    </template>
    <Switch
      v-model="componentValue.active"
    >
      {{ $t("activate")
      }}<template #subtitle>
        {{ $t("tag_manager_desc") }}
      </template>
    </Switch>
    <div
      v-if="componentValue.active"
      class="mt-5"
    >
      <TextField
        v-model="componentValue.gtm_id"
        :label="$t('tag_manager_id')"
        :placeholder="$t('tag_manager_id')"
      >
        <template #subtitle>
          {{ $t('tag_manager_id_desc') }}
        </template>
      </TextField>
    </div>
  </SettingsCard>
</template>

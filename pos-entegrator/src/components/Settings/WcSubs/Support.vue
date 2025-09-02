<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Switch from "@/components/Inputs/Switch.vue";
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
      {{ $t("support_settings") }}
    </template>
    <div class="flex justify-between">
      <Switch
        v-model="componentValue.user_can_cancel"
      >
        {{ $t("activate")
        }}<template #subtitle>
          {{ $t("user_can_cancel_desc") }}
        </template>
      </Switch>

      <Switch
        v-if="componentValue.user_can_cancel"
        v-model="componentValue.user_can_change"
      >
        {{ $t("activate")
        }}<template #subtitle>
          {{ $t("user_can_cpm_desc") }}
        </template>
      </Switch>
    </div>
  </SettingsCard>
</template>

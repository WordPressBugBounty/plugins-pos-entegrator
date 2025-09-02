<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { computed } from "vue";
const props = defineProps({ modelValue: { type: Boolean, required: true } });
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
      {{ $t("saved_card") }}
    </template>

    <Switch id="gpos-card-save-active" v-model="componentValue">
      {{ $t("activate")
      }}<template #subtitle>
        {{ $t("saved_card_active") }}
      </template>
    </Switch>
  </SettingsCard>
</template>

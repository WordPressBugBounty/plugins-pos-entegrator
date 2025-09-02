<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import RadioButton from "@/components/Inputs/RadioButton.vue";
import Info from '@/components/Alerts/Info.vue';

import { computed } from "vue";
const props = defineProps({ modelValue: { type: String, required: true } });
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
      {{ $t("3d_settings") }}
    </template>
    <div class="flex flex-col gap-3">
      <RadioButton
        v-model="componentValue"
        value="none_threed"
        name="3dsettings"
      >
        {{ $t("not_3d")
        }}<template #subtitle>
          {{ $t("not_3d_subtitle") }}
        </template>
      </RadioButton>

      <RadioButton
        v-model="componentValue"
        value="optional_threed"
        name="3dsettings"
      >
        {{ $t("optional_3d")
        }}<template #subtitle>
          {{ $t("optional_3d_subtitle") }}
        </template>
      </RadioButton>

      <RadioButton
        v-model="componentValue"
        value="force_threed"
        name="3dsettings"
      >
        {{ $t("forced_3d")
        }}<template #subtitle>
          {{ $t("forced_3d_subtitle") }}
        </template>
      </RadioButton>
    </div>
    <template #footer>
      <Info :text="$t('3d_settings_note')" />
    </template>
  </SettingsCard>
</template>

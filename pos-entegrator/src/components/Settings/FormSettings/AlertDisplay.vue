<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import RadioButton from "@/components/Inputs/RadioButton.vue";
import { computed } from "vue";
const props = defineProps({
  modelValue: { type: [Boolean, String], required: true },
});
const emit = defineEmits(["update:modelValue"]);
const assetUrl = window.gpos.assets_url;

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
      {{ $t("display_alert") }}
    </template>
    <div class="flex w-full gap-6">
      <div class="flex w-1/3 flex-col gap-3">
        <RadioButton
          v-model="componentValue"
          :value="false"
          name="show_alerts"
        >
          {{ $t("dont_show_alerts")
          }}<template #subtitle>
            {{ $t("dont_show_alerts_desc") }}
          </template>
        </RadioButton>
        <RadioButton
          v-model="componentValue"
          value="with_alert"
          name="show_alerts"
        >
          {{ $t("show_with_alerts")
          }}<template #subtitle>
            {{ $t("show_with_alerts_desc") }}
          </template>
        </RadioButton>

        <RadioButton
          v-model="componentValue"
          value="with_message"
          name="show_alerts"
        >
          {{ $t("show_with_message")
          }}<template #subtitle>
            {{ $t("show_with_message_desc") }}
          </template>
        </RadioButton>
      </div>
      <div
        v-if="componentValue"
        class="flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"
      >
        <img
          :src="`${assetUrl}/images/settings/${componentValue}.png`"
          class="object-cover scale-75"
          alt=""
        >
      </div>
    </div>
  </SettingsCard>
</template>

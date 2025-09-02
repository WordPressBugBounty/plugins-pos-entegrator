<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import RadioButton from "@/components/Inputs/RadioButton.vue";
import SoonBadge from "@/components/Badges/SoonBadge.vue";
import { computed } from "vue";
const props = defineProps({ modelValue: { type: String, required: true } });
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
      {{ $t("view_settings") }}
    </template>
    <div class="flex w-full gap-6">
      <div class="flex w-1/3 flex-col gap-3">
        <RadioButton
          v-model="componentValue"
          name="display_type"
          value="standart_form"
        >
          {{ $t("standart_form_settings")
          }}<template #subtitle>
            {{ $t("standart_form_settings_subtitle") }}
          </template>
        </RadioButton>
        <RadioButton
          v-model="componentValue"
          disabled
          name="display_type"
          value="oneline_form"
        >
          {{ $t("oneline_form_settings")
          }}
          <SoonBadge /><template #subtitle>
            {{ $t("online_form_settings_subtitle") }}
          </template>
        </RadioButton>
      </div>
      <div class="flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3">
        <img
          :src="`${assetUrl}/images/settings/${componentValue}.png`"
          class="object-cover scale-75"
          alt=""
        >
      </div>
    </div>
  </SettingsCard>
</template>

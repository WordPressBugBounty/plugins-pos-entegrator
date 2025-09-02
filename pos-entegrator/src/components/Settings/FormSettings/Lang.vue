<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import RadioButton from "@/components/Inputs/RadioButton.vue";
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

const langs = window.gpos.locale_languages;
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("payment_lang") }}
    </template>
    <div class="flex flex-wrap items-center gap-3">
      <RadioButton
        v-for="(val, key) in langs"
        :key="key"
        v-model="componentValue"
        :value="key"
        name="payment_lang"
      >
        {{ val }}
      </RadioButton>
      <div class="w-full">
        <RadioButton
          v-model="componentValue"
          value="auto"
          name="payment_lang"
        >
          {{ $t("auto_lang") }}
          <template #subtitle>
            {{ $t("auto_lang_desc", ["TranslatePress, Polylang, Weglot"]) }}
          </template>
        </RadioButton>
      </div>
    </div>
  </SettingsCard>
</template>

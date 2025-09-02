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
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("card_name_field") }}
    </template>
    <div class="flex flex-col gap-3">
      <RadioButton
        v-model="componentValue"
        value="use_default"
        name="name_field"
      >
        {{ $t("card_name_default")
        }}<template #subtitle>
          {{ $t("card_name_default_desc") }}
        </template>
      </RadioButton>

      <RadioButton
        v-model="componentValue"
        value="show_field"
        name="name_field"
      >
        {{ $t("card_name_show_field")
        }}<template #subtitle>
          {{ $t("card_name_show_field_desc") }}
        </template>
      </RadioButton>
    </div>
  </SettingsCard>
</template>

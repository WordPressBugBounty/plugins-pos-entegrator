<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import RadioButton from "@/components/Inputs/RadioButton.vue";
import SoonBadge from "@/components/Badges/SoonBadge.vue";
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
      {{ $t("save_step") }}
    </template>
    <div class="flex flex-col gap-3">
      <RadioButton
        v-model="componentValue"
        value="at_payment"
        name="save_step"
      >
        {{ $t("at_payment")
        }}<template #subtitle>
          {{ $t("at_payment_desc") }}
        </template>
      </RadioButton>

      <RadioButton
        v-model="componentValue"
        value="after_payment"
        name="save_step"
        disabled
      >
        {{ $t("after_payment")
        }}<SoonBadge /><template #subtitle>
          {{ $t("after_payment_desc") }}
        </template>
      </RadioButton>
    </div>
  </SettingsCard>
</template>

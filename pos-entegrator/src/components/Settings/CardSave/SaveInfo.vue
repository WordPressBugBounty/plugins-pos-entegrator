<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import TextField from "@/components/Inputs/TextField.vue";
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
      {{ $t("other") }}
    </template>
    <TextField
      v-model="componentValue"
      label="Abonelik ürünleri için yada FunnelKit tüneli oluşturma gibi durumlarda zorunlu kart kayıt ediliyorsa, müşteriye kartının otomatik olarak kaydedileceğini bildirmek istiyorsanız not yazabilirsiniz."
      :placeholder="$t('note')"
    />
  </SettingsCard>
</template>

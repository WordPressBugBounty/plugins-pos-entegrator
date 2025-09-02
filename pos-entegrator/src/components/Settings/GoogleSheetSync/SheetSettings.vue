<script setup>
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
      {{ $t("settings") }}
    </template>
    <div class="flex w-full flex-col gap-4">
      <Switch
        v-model="componentValue.active_refund_transaction"
        class="w-full"
      >
        {{ $t("gss_refund_transaction")
        }}<template #subtitle>
          {{ $t("gss_refund_transaction_desc") }}
        </template>
      </Switch>
    </div>
  </SettingsCard>
</template>

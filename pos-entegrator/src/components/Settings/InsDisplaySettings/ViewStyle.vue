<script setup>
import RadioButton from "@/components/Inputs/RadioButton.vue";
import { computed } from "vue";
const assetUrl = window.gpos.assets_url;
const props = defineProps({
  modelValue: { type: [String, Boolean], required: true },
});
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
  <div class="flex w-full">
    <div class="flex w-1/2 flex-col gap-3">
      <RadioButton
        v-model="componentValue"
        name="installment_table_settings"
        value="multi"
      >
        {{ $t("multi_installment_view")
        }}<template #subtitle>
          {{ $t("multi_installment_desc") }}
        </template>
      </RadioButton>
      <RadioButton
        v-model="componentValue"
        name="installment_table_settings"
        value="single"
      >
        {{ $t("single_installment_view")
        }}<template #subtitle>
          {{ $t("single_installment_desc") }}
        </template>
      </RadioButton>
    </div>
    <div
      class="flex w-1/2 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50"
    >
      <img
        :src="`${assetUrl}/images/settings/${componentValue}-installment-view.png`"
        class="object-cover scale-75"
        alt=""
      >
    </div>
  </div>
</template>

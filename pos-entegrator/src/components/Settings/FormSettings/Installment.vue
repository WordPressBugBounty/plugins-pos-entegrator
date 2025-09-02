<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import RadioButton from "@/components/Inputs/RadioButton.vue";
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
      {{ $t("table_view_settings") }}
    </template>
    <div class="flex w-full gap-6">
      <div class="flex w-1/3 flex-col gap-3">
        <RadioButton
          v-model="componentValue"
          name="installment_table_settings"
          value="table_view"
        >
          {{ $t("table_view")
          }}<template #subtitle>
            {{ $t("table_view_desc") }}
          </template>
        </RadioButton>
        <RadioButton
          v-model="componentValue"
          name="installment_table_settings"
          value="row_view"
        >
          {{ $t("row_view")
          }}<template #subtitle>
            {{ $t("row_view_desc") }}
          </template>
        </RadioButton>
        <RadioButton
          v-model="componentValue"
          name="installment_table_settings"
          value="select_box_view"
        >
          {{ $t("select_box_view")
          }}<template #subtitle>
            {{ $t("select_box_view_desc") }}
          </template>
        </RadioButton>
        <RadioButton
          v-model="componentValue"
          name="installment_table_settings"
          value="box_view"
        >
          {{ $t("box_view")
          }}<template #subtitle>
            {{ $t("box_view_desc") }}
          </template>
        </RadioButton>
      </div>
      <div class="flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50">
        <img
          :src="`${assetUrl}/images/settings/${componentValue}.png`"
          class="object-cover scale-75"
          alt=""
        >
      </div>
    </div>
  </SettingsCard>
</template>

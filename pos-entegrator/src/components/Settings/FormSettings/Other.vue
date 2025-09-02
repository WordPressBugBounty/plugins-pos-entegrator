<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { SparklesIcon } from "@heroicons/vue/24/solid";
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
      {{ $t("other_settings") }}
    </template>
    <div class="w-full flex flex-col gap-2">
      <Switch
        id="holder_name"
        v-model="componentValue.holder_name_field"
      >
        {{ $t("form_name_settings")
        }}<template #subtitle>
          {{ $t("form_name_settings_subtitle") }}
        </template>
      </Switch>

      <Switch
        id="use_iframe"
        v-model="componentValue.use_iframe"
      >
        <div class="flex gap-2 items-center">
          {{ $t("use_iframe_settings") }}
          <span
            class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"
          ><SparklesIcon class="w-3 h-3" />Beta</span>
        </div>
        <template #subtitle>
          {{ $t("use_iframe_settings_subtitle") }}
        </template>
      </Switch>
    </div>
  </SettingsCard>
</template>

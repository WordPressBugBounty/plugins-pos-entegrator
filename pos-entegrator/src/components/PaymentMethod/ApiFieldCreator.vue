<script setup>
import Warning from "@/components/Alerts/Warning.vue";
import { useMainStore } from "@/stores/MainStore";
import { storeToRefs } from "pinia";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import { ref } from "vue";
const { isTestMode } = storeToRefs(useMainStore());
const { gatewayAccount } = storeToRefs(useGatewayAccount());
const emit = defineEmits(['validation-errors']);
const fieldErrors = ref({});

const validateFields = () => {
  const errors = {};
  gatewayAccount.value.gateway_property.fields.forEach(field => {
    const fieldValue = gatewayAccount.value.gateway_settings[
      isTestMode.value ? `test_${field.model}` : field.model
    ];
    if (!fieldValue && fieldValue.length === 0) {
      errors[isTestMode.value ? `test_${field.model}` : field.model] = `${field.label} alanı zorunludur.`;
    }
  });
  if (Object.keys(errors).length >= 0) {
    emit('validation-errors', errors);
  }
  fieldErrors.value = errors;
};


</script>
<template>
  <div class="w-full flex flex-wrap">
    <Warning
      v-if="isTestMode"
      class="m-2 p-2 w-full"
    >
      {{ $t("test_mode_title") }}
      <template #content>
        {{ $t("test_mode_content") }}
      </template>
    </Warning>
    <div
      v-for="(field, index) in gatewayAccount.gateway_property.fields"
      :key="index"
      class="w-1/2 p-2"
    >
      <div class="flex gap-1 items-center mb-2">
        <label class="block text-sm font-medium text-gray-900">
          {{ isTestMode ? 'Test' : '' }} {{ field.label }}
        </label>
      </div>
      
      <input
        v-if="field.type === 'text'"
        :id="`${gatewayAccount.gateway_property.id}-${field.model}`"
        v-model="gatewayAccount.gateway_settings[isTestMode ? `test_${field.model}`: field.model]"
        type="text"
        :class="`!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3 ${
          isTestMode ? 'placeholder:text-gray-300' : 'placeholder:text-gray-600'
        } ${
          fieldErrors[isTestMode ? `test_${field.model}` : field.model]
            ? '!border-red-500 focus:ring-red-500 focus:border-red-500'
            : '!border-gray-300'
        }`"
        :placeholder="field.label"
        required
        @input="validateFields"
      >

      <select
        v-if="field.type === 'select'"
        :id="`${gatewayAccount.gateway_property.id}-${field.model}`"
        v-model="gatewayAccount.gateway_settings[isTestMode ? `test_${field.model}` : field.model]"
        :multiple="field.multiple"
        class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
        @change="validateFields"
      >
        <option
          v-for="(name, value) in field.options"
          :key="value"
          :value="value"
        >
          {{ name }}
        </option>
      </select>

      <p
        v-if="field.desc"
        class="mt-1 text-xs text-gray-500"
      >
        {{ field.desc }}
      </p>

      <!-- Validation Error -->
      <span
        v-if="fieldErrors[isTestMode ? `test_${field.model}` : field.model]"
        class="text-red-500 text-sm"
      >
        {{ fieldErrors[isTestMode ? `test_${field.model}` : field.model] }}
      </span>
    </div>
  </div>
</template>


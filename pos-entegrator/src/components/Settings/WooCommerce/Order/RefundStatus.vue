<script setup>
import { computed } from "vue";
import Switch from "@/components/Inputs/Switch.vue";

const props = defineProps({ modelValue: { type: Object, required: true } });
const emit = defineEmits(["update:modelValue"]);
const orderStatus = window.gpos.wc_all_order_statuses;
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
  <div class="flex flex-col gap-2">
    <Switch v-model="componentValue.update_refund_status">
      <div class="!font-normal">
        {{ $t("update_refund_status_title") }}
      </div>
      <template #subtitle>
        {{ $t("update_refund_status_desc") }}
      </template>
    </Switch>
    <label v-if="componentValue.update_refund_status">
      {{ $t("refund_status") }}
      <select
        id="countries"
        v-model="componentValue.refund_status"
        class="!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !max-w-none !w-full !p-2.5"
      >
        <option
          v-for="(status, index) in orderStatus"
          :key="index"
          :value="status.value"
          :selected="status.value === componentValue.refund_status"
          class="w-full"
        >
          {{ status.text }}
        </option>
      </select>
    </label>
  </div>
</template>

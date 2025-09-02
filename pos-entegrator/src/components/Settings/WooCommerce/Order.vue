<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import SuccessStatus from "@/components/Settings/WooCommerce/Order/SuccessStatus.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const { wooCommerceSettings } = storeToRefs(useSettingsStore());
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t("order") }}
    </template>
    <div class="flex flex-col gap-6">
      <SuccessStatus
        v-model="wooCommerceSettings.success_status"
        class="w-1/3"
      />
      <Switch v-model="wooCommerceSettings.set_fee">
        <div class="!font-normal">
          {{ $t("set_fee_title") }}
        </div>
        <template #subtitle>
          {{ $t("set_fee_desc") }}
        </template>
      </Switch>
    </div>
  </SettingsCard>
</template>

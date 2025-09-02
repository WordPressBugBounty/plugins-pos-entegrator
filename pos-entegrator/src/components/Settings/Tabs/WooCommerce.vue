<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Form from "@/components/Settings/WooCommerce/Form.vue";
import Order from "@/components/Settings/WooCommerce/Order.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import InstallmentRules from "@/components/Settings/WooCommerce/InstallmentRules.vue";
import InstallmentTabs from "@/components/Settings/WooCommerce/InstallmentTabs.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
const store = useSettingsStore();
</script>
<template>
  <SettingsTab> 
    <Form />
    <Order />
    <InstallmentRules />
    <InstallmentTabs />
    <template #action>
      <SaveButton @click="store.updateWooCommerceSettings()" />
    </template>
  </SettingsTab>
</template>

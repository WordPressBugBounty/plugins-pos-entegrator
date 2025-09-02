<script setup>
import OutlineButton from "@/components/Inputs/OutlineButton.vue";
import { PlusIcon } from "@heroicons/vue/24/solid";
import { useSettingsStore } from "@/stores/SettingsStore";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
import { storeToRefs } from "pinia";
const { virtualPOSAccounts } = useGatewayAccounts();
const { gateSettings } = storeToRefs(useSettingsStore());

const addNew = () => {
  gateSettings.value.push({
    enabled: true,
    rule: "card_bank_in_list",
    condition: "",
    account_id: virtualPOSAccounts.find((account) => account.is_default).id,
  });
};
</script>
<template>
  <OutlineButton
    class="w-max"
    @click="addNew()"
  >
    <PlusIcon class="w-5 h-5 mr-3" />{{ $t("add_new_rule") }}
  </OutlineButton>
</template>

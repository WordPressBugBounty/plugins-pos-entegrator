<script setup>
import OutlineButton from "@/components/Inputs/OutlineButton.vue";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
const { getInstallments , gatewayAccount } = useGatewayAccount();
</script>
<template>
  <OutlineButton
    v-if="gatewayAccount.gateway_property.supports.includes('installment_api')"
    @click="getInstallments()"
  >
    {{ $t("get_installment_rates") }}
  </OutlineButton>
</template>

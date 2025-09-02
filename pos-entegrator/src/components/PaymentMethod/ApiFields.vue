<script setup>
import {
  AdjustmentsVerticalIcon,
  CheckIcon,
  ArrowTopRightOnSquareIcon,
} from "@heroicons/vue/24/solid";
import OutlineButton from "@/components/Inputs/OutlineButton.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import ApiFieldCreator from "@/components/PaymentMethod/ApiFieldCreator.vue";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import HexCode from "@/components/PaymentMethod/HexCode.vue";
import { ref } from 'vue';
const { testConnection, updateAccountSettings } = useGatewayAccount();
const { gatewayAccount } = useGatewayAccount();

const errorMessages = ref({});
const onInit=ref(true);
function handleValidationErrors(errors) {
  errorMessages.value = errors;
  onInit.value = false;
}

const isDisabled = () => {
  if('dummy_payment' !== gatewayAccount.gateway_property.id){
    return false;
  }
    return !onInit.value && Object.keys(errorMessages.value).length === 0 ? false : true
}
</script>

<template>
  <div class="w-full flex gap-10 bg-white p-6 rounded-lg shadow-md">
    <div
      v-if="'dummy_payment' !== gatewayAccount.gateway_property.id"
      class="w-3/5 flex flex-col gap-6"
    >
      <ApiFieldCreator @validation-errors="handleValidationErrors" />
      <div class="flex w-full justify-start gap-2 p-2">
        <OutlineButton
          v-if="gatewayAccount.gateway_property.check_connection_is_available"
          @click="testConnection(gatewayAccount.gateway_property.id)"
        >
          <AdjustmentsVerticalIcon class="w-4 h-4 mr-2" />{{
            $t("connect_test")
          }}
        </OutlineButton>
        <PrimaryButton
          id="gpos-save-settings"
          :disabled="isDisabled()"
          @click="updateAccountSettings()"
        >
          <CheckIcon class="w-4 h-4 mr-2" />{{ $t("save_settings") }}
        </PrimaryButton>
      </div>
    </div>
    <div class="w-2/5">
      <div class="w-full flex flex-col gap-2">
        <div class="flex justify-between items-start">
          <img
            class="w-1/4"
            :src="gatewayAccount.gateway_property.logo"
          >
        </div>
        <!-- eslint-disable -->
        <p
          class="text-lg text-gray-500"
          v-html="$t(`${gatewayAccount.gateway_id}.description`)"
        />
        <!-- eslint-enable -->
        <div class="flex flex-row space-x-5">
          <a
            :href="gatewayAccount.gateway_property.merchant_panel"
            target="_blank"
            class="mt-2 text-blue-700 text-sm flex gap-1 items-center"
          >{{ $t("merchant_panel")
          }}<ArrowTopRightOnSquareIcon class="w-3 h-3 text-blue-700" /></a>

          <a
            v-if="gatewayAccount.gateway_property.help_document"
            :href="gatewayAccount.gateway_property.help_document"
            target="_blank"
            class="mt-2 text-blue-700 text-sm flex gap-1 items-center"
          >{{ $t("help_document")
          }}<ArrowTopRightOnSquareIcon class="w-3 h-3 text-blue-700" /></a>
        </div>
      </div>
      <HexCode />
    </div>
  </div>
</template>
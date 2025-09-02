<script setup>
import { ExclamationCircleIcon } from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import CardName from "@/components/Checkout/CreditDebitCard/CardFormWithSavedCards/CardForm/SaveCard/CardName.vue";
const { userId, cardSaveSettings, wcSubsSettings } = useCheckout();
const { saveCurrentCard, virtualPOS } = storeToRefs(useCheckout());
const isCheckout = window.wc_checkout_params || false;
</script>
<template>
  <div
    v-if="virtualPOS.supports.includes('save_card') && cardSaveSettings.active"
    class="flex flex-col my-2"
  >
    <div
      v-if="
        cardSaveSettings.force_save && wcSubsSettings.save_info && isCheckout
      "
      class="w-full flex items-center justify-start p-2 gap-2 bg-blue-50 border-blue-600 text-blue-800 border rounded"
    >
      <ExclamationCircleIcon
        class="!w-6 !h-6 mt-1"
        aria-hidden="true"
      />
      {{ wcSubsSettings.save_info }}
    </div>
    <label
      v-if="userId && !cardSaveSettings.force_save"
      class="text-sm font-medium text-gray-900 flex items-center gap-1 cursor-pointer"
    >
      <input
        id="gpos-save-card"
        v-model="saveCurrentCard"
        type="checkbox"
        value="on"
        class="border-gray-300 rounded !block !m-0"
      >
      {{ $t("save_card_checkout") }}
    </label>
    <CardName
      v-if="saveCurrentCard && 'show_field' === cardSaveSettings.name_field"
    />
  </div>
</template>

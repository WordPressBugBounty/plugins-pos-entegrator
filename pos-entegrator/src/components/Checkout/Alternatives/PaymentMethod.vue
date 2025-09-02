<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { onMounted, shallowRef } from "vue";
import IsBankGiroGateForm from "@/components/Checkout/Alternatives/Forms/IsBankGiroGateForm.vue";
import WorldPAYInfo from "@/components/Checkout/Alternatives/Forms/WorldPAYInfo.vue";
const { accountId } = storeToRefs(useCheckout());
const props = defineProps({
  paymentMethod: {
    required: true,
    type: Object,
  },
});
const component = shallowRef(false);

onMounted(() => {
  switch (props.paymentMethod.payment_form_type) {
    case "isbank_girogate_form":
      component.value = IsBankGiroGateForm;
      break;
    case "worldpay":
      component.value = WorldPAYInfo;
      break;
  }
});
</script>
<template>
  <div class="flex flex-col">
    <div
      :class="`
    ${
        accountId === paymentMethod.account_id
          ? 'border-l-green-400 rounded-t'
          : 'border-l-gray-50 rounded' 
      }
     border-l-4 bg-[#fbfbfb] w-full px-3 py-4 cursor-pointer flex items-center font-semibold max-h-[70px] min-h-[70px]`"
      @click="accountId = paymentMethod.account_id"
    >
      <div class="w-3/5">
        {{ paymentMethod.title }}
      </div>
      <div class="w-2/5 flex justify-end">
        <img
          :src="paymentMethod.logo"
          class="w-full max-h-[40px] object-contain"
        >
      </div>
    </div>

    <div
      v-if="accountId === paymentMethod.account_id"
      :class="`
    ${
        accountId === paymentMethod.account_id
          ? 'border-l-green-400'
          : 'border-l-gray-50'
      }
    rounded-b border-l-4 bg-[#fbfbfb] w-full cursor-pointer flex items-center font-semibold`"
    >
      <component
        :is="component"
        v-if="component"
        :payment-method="paymentMethod"
      />
    </div>
  </div>
</template>

<script setup>
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { inject, onMounted, shallowRef } from "vue";
import IsBankGiroGateForm from "@/components/Checkout/Alternatives/Forms/IsBankGiroGateForm.vue";
import WorldPAYInfo from "@/components/Checkout/Alternatives/Forms/WorldPAYInfo.vue";
import PaymentStepsDescription from "@/components/Checkout/CreditDebitCard/MethodSelect/PaymentStepsDescription.vue";
import inputsChanged from "@/plugins/inputs-changed.js";

const { accountId } = storeToRefs(useCheckout());
const props = defineProps({
  paymentMethod: {
    required: true,
    type: Object,
  },
  single: {
    required: false,
    type: Boolean,
    default: false,
  },
});
const component = shallowRef(false);
// Sekmeli görünümde yöntemin logosu zaten sekmede gösterildiği için tekrar edilmez.
const inTabbedForm = inject("inTabbedForm", false);

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

const methodChanged = () => {
  accountId.value = props.paymentMethod.account_id;
  setTimeout(() => {
    inputsChanged()
  }, 100)
};

</script>
<template>
  <div
    v-if="single"
    class="flex flex-col gap-4 bg-white rounded w-full px-4 py-3"
  >
    <img
      v-if="!inTabbedForm"
      :src="paymentMethod.logo"
      :alt="paymentMethod.title"
      class="max-h-[40px] max-w-[160px] object-contain"
    >
    <component
      :is="component"
      v-if="component"
      :payment-method="paymentMethod"
    />
    <PaymentStepsDescription
      v-else-if="paymentMethod.payment_steps_description?.length"
      :descriptions="paymentMethod.payment_steps_description"
    />
  </div>
  <div
    v-else
    class="flex flex-col"
  >
    <div
      :class="`
    ${
        accountId === paymentMethod.account_id
          ? 'border-l-green-400 rounded-t'
          : 'border-l-gray-50 rounded' 
      }
     border-l-4 bg-[#fbfbfb] w-full px-3 py-4 cursor-pointer flex items-center font-semibold max-h-[70px] min-h-[70px]`"
      @click="methodChanged()"
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
      <div
        v-else-if="paymentMethod.payment_steps_description?.length"
        class="w-full px-4 pb-3"
      >
        <PaymentStepsDescription
          :descriptions="paymentMethod.payment_steps_description"
        />
      </div>
    </div>
  </div>
</template>

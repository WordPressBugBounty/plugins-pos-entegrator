<script setup>
import GateSelect from "@/components/Checkout/Alternatives/Forms/IsBankGiroGateForm/GateSelect.vue";
import CountrySelect from "@/components/Checkout/Alternatives/Forms/IsBankGiroGateForm/CountrySelect.vue";
import { ref, watch } from "vue";
defineProps({
  paymentMethod: {
    required: true,
    type: Object,
  },
});
const gate = ref(false);
const country = ref("");
watch(gate, () => {
  country.value = "";
});
</script>

<template>
  <div class="w-full flex flex-col p-4">
    <GateSelect
      v-model="gate"
      :gates="paymentMethod.gates"
    />
    <CountrySelect
      v-if="gate"
      v-model="country"
      :countries="gate.countries"
    />
  </div>
</template>

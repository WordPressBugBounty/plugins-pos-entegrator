<script setup>
import CheckoutForm from "@/pages/checkout/App.vue";
import Loading from "@/components/Loading.vue";
import { useCollectionCheckoutStore } from "@/stores/CollectionCheckoutStore.js";
import Amount from "@/components/CollectionCheckout/Amount.vue";
import BillingFields from "@/components/CollectionCheckout/BillingFields.vue";
import { onBeforeMount } from "vue";
const store = useCollectionCheckoutStore();
const { processPayment, collectionForm, initialize } = store;

onBeforeMount(() => {
  initialize();
});
</script>
<template>
  <form
    class="flex rounded-lg !border shadow-md !border-gray-100 !border-solid w-full flex-col"
    @submit.prevent="processPayment"
  >
    <Loading />

    <div v-if="collectionForm.form_settings.title" class="text-center p-4">
      <div class="text-2xl text-gray-900 font-bold">
        {{ collectionForm.form_settings.title }}
      </div>
    </div>
    <div
      class="flex flex-col w-full md:flex-row !border !border-gray-100 !border-solid"
    >
      <div class="flex flex-col md:w-1/2 p-8 gap-4">
        <h2 class="text-xl font-bold">Faturalandırma Bilgileri</h2>
        <BillingFields />
      </div>
      <div class="flex flex-col w-full md:w-1/2 p-8 gap-4 bg-gray-100">
        <h2 class="text-xl font-bold">Ödeme Bilgileri</h2>
        <Amount />
        <CheckoutForm />
        <button
          type="submit"
          class="!text-white bg-blue-700 border-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 flex !text-center !justify-center !items-center mr-2 !w-full mt-4"
        >
          {{ collectionForm.form_settings.button_text }}
        </button>
      </div>
    </div>
    <div
      v-if="collectionForm.form_settings.description"
      class="text-center p-4"
    >
      <p class="text-sm text-gray-500">
        {{ collectionForm.form_settings.description }}
      </p>
    </div>
  </form>
</template>

<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import { onBeforeMount, ref } from "vue";
import { useCollectionCheckoutStore } from "@/stores/CollectionCheckoutStore.js";
import { storeToRefs } from "pinia";
const currencies = window.gpos.currencies;
const store = useCollectionCheckoutStore();

const { checkout_data } = storeToRefs(store);
const { collectionForm } = store;
const { amount_settings, currency_settings, tax_settings } =
  collectionForm.payment_settings;
const custom = ref(false);

onBeforeMount(() => {
  if (amount_settings.type === "fixed") {
    checkout_data.value.sub_total = amount_settings.amount;
  }

  if (
    amount_settings.type === "predefined" ||
    amount_settings.type === "predefined_and_custom"
  ) {
    checkout_data.value.sub_total = amount_settings.predefined_amounts[0];
  }

  if (currency_settings.type === "fixed") {
    checkout_data.value.currency = currency_settings.currency;
  }

  if (currency_settings.type === "selectable") {
    checkout_data.value.currency = currencies[0];
  }

  if (tax_settings.tax_enabled && tax_settings.tax_rate) {
    checkout_data.value.tax_rate = tax_settings.tax_rate;
  }
});

const calculate = () => {
  if (tax_settings.tax_enabled && tax_settings.tax_rate) {
  checkout_data.value.tax_total =
      checkout_data.value.sub_total * (tax_settings.tax_rate / 100);
    checkout_data.value.total =
      checkout_data.value.sub_total + checkout_data.value.tax_total;
  } else {
    checkout_data.value.total = checkout_data.value.sub_total;
  }
  return checkout_data.value.total;
};
</script>
<template>
  <div>
    <label
      v-if="currency_settings.type === 'selectable'"
      for="currency"
    >{{ $t("currency") }}
      <select
        v-model="checkout_data.currency"
        class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
      >
        <option
          v-for="currency in currencies"
          :key="currency"
          :value="currency"
        >
          {{ currency }}
        </option>
      </select>
    </label>
    <div
      v-if="
        amount_settings.type === 'predefined_and_custom' ||
          amount_settings.type === 'predefined'
      "
      class="grid grid-cols-3 gap-2 mb-4"
    >
      <div
        v-for="amount in amount_settings.predefined_amounts"
        :key="amount"
        :class="`flex justify-center items-center rounded-lg bg-white p-2 cursor-pointer border-2 border-solid ${checkout_data.sub_total == amount && !custom ? 'border-blue-500' : 'border-white'}`"
        @click="((checkout_data.sub_total = amount), (custom = false))"
      >
        <MoneyFormat
          :number="amount"
          :currency="checkout_data.currency"
        />
      </div>

      <div
        :class="`flex justify-center items-center rounded-lg bg-white p-2 cursor-pointer border-2 border-solid ${custom ? 'border-blue-500' : 'border-white'}`"
        @click="((custom = true), (checkout_data.sub_total = 0))"
      >
        {{ $t("custom_amount") }}
      </div>
    </div>
    <TextField
      v-if="custom || amount_settings.type === 'custom'"
      v-model="checkout_data.sub_total"
      required
      :label="$t('enter_payment_amount')"
      class="col-span-3"
      type="number"
    />

    <div
      class="flex flex-col gap-2 p-4 border border-solid border-gray-200 rounded-lg bg-white"
    >
      <template v-if="tax_settings.tax_enabled && tax_settings.tax_rate">
        <div class="flex justify-between items-end border-gray-200">
          <span> Ara Toplam Tutar: </span>
          <MoneyFormat :number="checkout_data.sub_total" />
        </div>
        <hr class="!m-0 !p-0">
        <div class="flex justify-between items-end border-gray-200">
          <span> Vergi ({{ tax_settings.tax_rate }}%): </span>
          <MoneyFormat :number="checkout_data.tax_total" />
        </div>
        <hr class="!m-0 !p-0">
      </template>
      <div class="flex justify-between items-end">
        <span> Toplam Tutar: </span>
        <MoneyFormat :number="calculate()" />
      </div>
    </div>
  </div>
</template>

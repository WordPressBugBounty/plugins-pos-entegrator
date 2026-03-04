<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { useCollectionFormStore } from "@/stores/CollectionFormStore.js";
import { storeToRefs } from "pinia";
const store = useCollectionFormStore();
const { form } = storeToRefs(store);
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";
const {
  virtualPOSAccounts,
  alternativeAccounts,
  commonFormAccounts,
  iFrameAccounts,
} = useGatewayAccounts();
const currencies = window.gpos.currencies;

const accounts = [
  { id: null, post_title: "Varsayılan ve Gate Kullan" },
  ...virtualPOSAccounts,
  ...alternativeAccounts,
  ...commonFormAccounts,
  ...iFrameAccounts,
];
</script>
<template>
  <div class="flex flex-col gap-4 space-y-4 divide-y">
    <div>
      <TextField
        v-model="form.payment_settings.payment_amount_name"
        type="text"
        :label="$t('payment_amount_name')"
        :placeholder="$t('payment_amount_holder')"
      />
    </div>
    <div class="pt-4">
      <label>{{ $t("payment_gateway") }}
        <select
          v-model="form.payment_settings.gateway_account_id"
          class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
        >
          <option
            v-for="account in accounts"
            :key="account.id"
            :value="account.id"
          >
            {{ account.post_title }}
          </option>
        </select>
      </label>
    </div>
    <div class="flex gap-8 pt-4">
      <label>{{ $t("currency_settings") }}
        <select
          v-model="form.payment_settings.currency_settings.type"
          class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
        >
          <option
            v-for="type in ['fixed', 'selectable']"
            :key="type"
            :value="type"
          >
            {{ $t(type) }}
          </option>
        </select>
      </label>
      <label v-if="form.payment_settings.currency_settings.type === 'fixed'">{{ $t("currency") }}
        <select
          v-model="form.payment_settings.currency_settings.currency"
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
    </div>
    <div class="flex flex-col gap-4 pt-4">
      <div class="flex gap-4">
        <label>{{ $t("amount_settings") }}
          <select
            v-model="form.payment_settings.amount_settings.type"
            class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"
          >
            <option
              v-for="type in [
                'fixed',
                'custom',
                'predefined',
                'predefined_and_custom',
              ]"
              :key="type"
              :value="type"
            >
              {{ $t(type) }}
            </option>
          </select>
        </label>
        <TextField
          v-if="form.payment_settings.amount_settings.type === 'fixed'"
          v-model="form.payment_settings.amount_settings.amount"
          type="number"
          :label="$t('amount')"
        />
      </div>
      <div
        v-if="
          form.payment_settings.amount_settings.type === 'predefined' ||
            form.payment_settings.amount_settings.type === 'predefined_and_custom'
        "
        class="flex gap-2 items-center"
      >
        <TextField
          v-for="i in [0, 1, 2, 3, 4]"
          :key="i"
          v-model="form.payment_settings.amount_settings.predefined_amounts[i]"
          type="number"
          :label="`${$t('amount')} ${i + 1}`"
        />
      </div>
    </div>
    <div class="flex flex-col gap-2 pt-4">
      <Switch v-model="form.payment_settings.tax_settings.tax_enabled">
        {{ $t("enable_tax") }}
      </Switch>
      <TextField
        v-model="form.payment_settings.tax_settings.tax_rate"
        type="number"
        class="w-2/12"
        :label="$t('tax_rate')"
      />
    </div>
  </div>
</template>

<script setup>
import { useCollectionCheckoutStore } from "@/stores/CollectionCheckoutStore.js";
import TextField from "@/components/Inputs/TextField.vue";
import { UserIcon , BuildingOfficeIcon} from "@heroicons/vue/24/solid";
import { storeToRefs } from "pinia";
import { computed, onBeforeMount } from "vue";
const store = useCollectionCheckoutStore();
const { checkout_data } = storeToRefs(store);
const { form_settings } = store.collectionForm;

onBeforeMount(() => {
  if (form_settings.tax_field.enabled) {
    checkout_data.value.tax_type = "company";
  }
});

const billingFields = computed(() => {
  const fields = [
    {
      label: "Adınız",
      key: "customer_first_name",
      type: "text",
      model: "customer_first_name",
    },
    {
      label: "Soyadınız",
      key: "customer_last_name",
      type: "text",
      model: "customer_last_name",
    },
    {
      label: "Email",
      key: "customer_email",
      type: "email",
      model: "customer_email",
    },
    {
      label: "Telefon",
      key: "customer_phone",
      type: "text",
      model: "customer_phone",
    },
    {
      label: "Adres",
      key: "customer_address",
      type: "text",
      model: "customer_address",
      colspan: 2,
    },
    {
      label: "İlçe",
      key: "customer_city",
      type: "text",
      model: "customer_city",
    },
    {
      label: "İl",
      key: "customer_state",
      type: "text",
      model: "customer_state",
    },
  ];

  if (checkout_data.value.tax_type === "company") {
    const company = [
      {
        label: "Vergi No",
        key: "customer_tax_number",
        type: "text",
        model: "customer_tax_number",
      },
      {
        label: "Vergi Dairesi",
        key: "customer_tax_office",
        type: "text",
        model: "customer_tax_office",
      },
      {
        label: "Şirket Adı",
        key: "customer_company_name",
        type: "text",
        model: "customer_company_name",
        colspan: 2,
      },
    ];
    return [
      ...company.map((field) => ({
        ...field,
        required: form_settings.tax_field.required,
      })),
      ...fields,
    ];
  }

  if (checkout_data.value.tax_type === "person") {
    return [
      {
        label: "TC Kimlik No",
        key: "customer_tax_number",
        type: "text",
        model: "customer_tax_number",
        colspan: 2,
        required: form_settings.tax_field.required,
      },
      ...fields,
    ];
  }

  return fields;
});
</script>
<template>
  <div class="grid grid-cols-2 gap-2">
    <template v-if="form_settings.tax_field.enabled">
      <div
        class="flex flex-col cursor-pointer border rounded p-2 !border-solid"
        :class="
          checkout_data.tax_type === 'company'
            ? 'border-blue-500'
            : 'border-gray-100'
        "
        @click="checkout_data.tax_type = 'company'"
      >
        <div class="flex items-center gap-2">
          <BuildingOfficeIcon class="w-3 h-3 text-gray-500" />
          <span class="text-sm font-semibold">Tüzel Kişi</span>
        </div>
        <span class="text-xs text-gray-500">LTD, ŞTİ, AŞ, vb. tüm şirketler</span>
      </div>
      <div
        class="flex flex-col cursor-pointer border rounded p-2 !border-solid"
        :class="
          checkout_data.tax_type === 'person'
            ? 'border-blue-500'
            : 'border-gray-100'
        "
        @click="checkout_data.tax_type = 'person'"
      >
        <div class="flex items-center gap-2">
          <UserIcon class="w-3 h-3 text-gray-500" />
          <span class="text-sm font-semibold">Gerçek Kişi</span>
        </div>
        <span class="text-xs text-gray-500">Şahıslar ve şahıs şirketleri</span>
      </div>
    </template>
    <div
      v-for="field in billingFields"
      :key="field.key"
      :class="`w-full ${field.colspan ? `col-span-${field.colspan}` : ''}`"
    >
      <TextField
        v-model="checkout_data[field.model]"
        :label="field.label"
        :type="field.type"
        :placeholder="field.placeholder"
        :required="field.required ?? true"
      />
    </div>
  </div>
</template>

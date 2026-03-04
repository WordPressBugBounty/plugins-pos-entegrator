<script setup>
const props = defineProps(["collection"]);
</script>
<template>
  <div class="p-5 bg-white rounded flex flex-col  shadow-md">
    <div
      class="text-blue-600 font-bold text-lg"
      v-text="$t('customer')"
    />
    <div class="border border-[#F7F7F7] my-4" />
    <div class="flex flex-col gap-4">
      <div
        v-for="key in [
          'customer_first_name',
          'customer_last_name',
          'customer_email',
          'customer_phone',
          'customer_address',
          'customer_state',
          'customer_city',
          'customer_company_name',
          'customer_tax_type',
          'customer_tax_number',
          'customer_tax_office',
        ]"
        :key="key"
        class="flex flex-col w-full gap-1"
      >
        <span class="text-md font-semibold text-gray-900">{{ $t(key) }}</span>
        <span class="text-sm">{{ props.collection[key] }}</span>
      </div>
    </div>
  </div>
</template>

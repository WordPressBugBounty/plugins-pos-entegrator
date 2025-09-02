<script setup>
const props = defineProps(["transaction"]);
</script>
<template>
  <div class="p-5 bg-white rounded flex flex-col  shadow-md">
    <div
      class="text-blue-600 font-bold text-lg"
      v-text="$t('customer')"
    />
    <div class="border border-[#F7F7F7] my-4" />
    <div class="flex flex-wrap gap-y-4">
      <div
        v-for="key in [
          'customer_id',
          'customer_first_name',
          'customer_last_name',
          'customer_email',
          'customer_phone',
          'customer_address',
          'customer_state',
          'customer_city',
          'customer_country',
          'customer_ip_address',
        ]"
        :key="key"
        class="flex flex-col w-1/5 gap-2"
      >
        <span class="text-base font-semibold text-gray-900">{{ $t(key) }}</span>
        <span class="text-md">{{ props.transaction[key] }}</span>
      </div>
    </div>
  </div>
</template>

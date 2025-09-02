<script setup>
import RateTable from "@/components/Settings/CurrencyConverter/ConvertSettings/RateTable.vue";
import PaymentCurrency from "@/components/Settings/CurrencyConverter/ConvertSettings/PaymentCurrency.vue";
import AddToList from "@/components/Settings/CurrencyConverter/ConvertSettings/AddToList.vue";

</script>
<template>
  <div class="w-full grid grid-cols-3 gap-5">
    <div class="w-full flex flex-col gap-4">
      <PaymentCurrency />
    </div>
    <div class="col-span-2 flex flex-col gap-4">
      <AddToList />
      <RateTable />
    </div>
  </div>
</template>

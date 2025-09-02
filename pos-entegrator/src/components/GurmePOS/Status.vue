<script setup>
import { ref } from "vue";
import DashboardCard from "@/components/GurmePOS/DashboardCard.vue";
import Text from "@/components/GurmePOS/Status/Text.vue";
import { useMainStore } from "@/stores/MainStore";
const { dashboard } = useMainStore();
const total = ref(0);
Object.keys(dashboard.transaction_counter).forEach((x) => (total.value = total.value + parseInt(dashboard.transaction_counter[x])));
</script>
<template>
  <DashboardCard class="bg-white rounded">
    <template #header>
      {{ $t("transaction_statuses") }}
    </template>
    <table class="w-full">
      <tr>
        <td class="py-2 px-4 border-r w-1/2">
          <Text
            :count="total"
            status="total"
          />
        </td>
        <td class="py-2 px-4">
          <Text
            :count="dashboard.transaction_counter.gpos_completed"
            status="gpos_completed"
          />
        </td>
      </tr>
      <tr class="border-y">
        <td class="py-2 px-4 border-r w-1/2">
          <Text
            :count="dashboard.transaction_counter.gpos_started"
            status="gpos_started"
          />
        </td>
        <td class="py-2 px-4">
          <Text
            :count="dashboard.transaction_counter.gpos_failed"
            status="gpos_failed"
          />
        </td>
      </tr>
      <tr>
        <td class="py-2 px-4 border-r w-1/2">
          <Text
            :count="dashboard.transaction_counter.gpos_redirected"
            status="gpos_redirected"
          />
        </td>
        <td class="py-2 px-4" />
      </tr>
    </table>
  </DashboardCard>
</template>

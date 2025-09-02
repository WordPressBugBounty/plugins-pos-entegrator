<script setup>
import DashboardCard from "@/components/GurmePOS/DashboardCard.vue";
import { useMainStore } from "@/stores/MainStore";
import {
  PlayIcon,
  ArrowPathIcon,
  ExclamationCircleIcon,
  CheckIcon,
  EllipsisHorizontalCircleIcon,
  ArrowTopRightOnSquareIcon,
} from "@heroicons/vue/24/outline";
const { dashboard } = useMainStore();
const assetsUrl = window.gpos.assets_url;

function getColorByStatus(status) {
  let color = "bg-gray-100 bg-gray-800";
  switch (status) {
    case "gpos_started":
      color = "bg-yellow-100 text-yellow-800";
      break;
    case "gpos_redirected":
      color = "bg-blue-100 text-blue-800";
      break;
    case "gpos_failed":
      color = "bg-red-300 text-red-800 ";
      break;
    case "gpos_completed":
      color = "bg-green-200 text-green-800";
      break;
  }
  return color;
}

function getIconByStatus(status) {
  let icon = "";
  switch (status) {
    case "gpos_started":
      icon = PlayIcon;
      break;
    case "gpos_redirected":
      icon = ArrowPathIcon;
      break;
    case "gpos_common_form":
      icon = ArrowPathIcon;
      break;
    case "gpos_completed":
      icon = CheckIcon;
      break;
    case "gpos_failed":
      icon = ExclamationCircleIcon;
      break;
  }
  return icon;
}
</script>
<template>
  <DashboardCard class="bg-white rounded">
    <template #header>
      <div class="w-full flex justify-between items-center">
        <span>{{ $t("last_transactions") }}</span>
        <a
          class="flex items-center gap-1 text-[12px] underline"
          href="/wp-admin/edit.php?post_type=gpos_transaction"
        >{{ $t("all_transactions") }}
          <ArrowTopRightOnSquareIcon class="w-3 h-3" />
        </a>
      </div>
    </template>
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 bg-gray-50">
        <tr>
          <th class="p-2 w-1/8">
            <EllipsisHorizontalCircleIcon class="rounded-full w-6 h-6" />
          </th>
          <th
            v-for="title in ['id', 'payment_gateway', 'type', 'total', 'date']"
            :key="title"
            scope="col"
            class="px-6 py-3 text-center"
          >
            {{ $t(title) }}
          </th>
        </tr>
      </thead>
      <tbody v-if="dashboard.last_transactions.length > 0">
        <tr
          v-for="(transaction, key) in dashboard.last_transactions"
          :key="key"
          :class="`${key % 2 === 0 ? 'bg-white' : 'bg-gray-50'} border-b`"
        >
          <th
            scope="row"
            class="p-2 w-1/8"
          >
            <component
              :is="getIconByStatus(transaction.status)"
              :class="`${getColorByStatus(
                transaction.status
              )} rounded-full p-1 w-6 h-6`"
            />
          </th>
          <td class="p-2 w-1/8 text-center">
            <a
              :href="transaction.edit_link"
              class="text-blue-700 underline"
            >#{{ transaction.id }}</a>
          </td>
          <td class="w-1/8">
            <div class="w-full flex justify-center">
              <img
                class="object-contain w-16"
                :src="`${assetsUrl}/images/logo/${transaction.payment_gateway_id}.svg`"
              >
            </div>
          </td>
          <td class="p-2 w-1/8 text-center">
            {{ $t(transaction.type) }}
          </td>
          <td class="p-2 w-1/8 text-right">
            <MoneyFormat
              :number="transaction.total"
              :currency="transaction.currency"
            />
          </td>
          <td class="p-2 w-3/8 text-right">
            {{ transaction.human_date_diff }}
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr class="bg-white border-b">
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
            {{ $t("no_records") }}
          </th>
        </tr>
      </tbody>
    </table>
  </DashboardCard>
</template>

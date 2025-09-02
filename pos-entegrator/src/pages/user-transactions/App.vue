<script setup>
import { PrinterIcon } from "@heroicons/vue/24/solid";
import { useUserTransactions } from "@/stores/UserTransactionsStore";
const { transactions } = useUserTransactions();
const printable = window.gpos.printable;
const homeUrl = window.gpos.home_url;

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

function getColorByRefundStatus(status) {
  let color = "bg-gray-100 text-gray-800";
  switch (status) {
    case "gpos_refund_status_cancelled":
      color = "bg-red-100 text-red-600";
      break;
    case "gpos_refund_status_n_refunded":
      color = "bg-gray-100 text-gray-800";
      break;
    case "gpos_refund_status_refunded":
      color = "bg-blue-300 text-blue-800 ";
      break;
    case "gpos_refund_status_p_refunded":
      color = "bg-yellow-200 text-yellow-600";
      break;
  }
  return color;
}
</script>
<template>
  <div class="w-full text-center p-8 text-2xl font-bold">
    {{ $t("transactions") }}
  </div>
  <div class="flex w-full flex-col overflow-x-auto">
    <div class="min-w-[768px]">
      <div class="flex w-full p-3 text-xl items-center font-bold">
        <div class="w-1/12 text-left">
          {{ $t("transaction") }}
        </div>
        <div class="w-2/12 text-center">
          {{ $t("date") }}
        </div>
        <div class="w-3/12 text-center">
          {{ $t("status") }}
        </div>
        <div class="w-3/12 text-center">
          {{ $t("cancel_refund_status") }}
        </div>
        <div class="w-3/12 text-right">
          {{ $t("total") }}
        </div>
      </div>
      <template v-if="transactions.length">
        <div
          v-for="(transaction, index) in transactions"
          :key="transaction.id"
          :class="`flex w-full p-3 rounded items-center ${
            index % 2 == 0 ? 'bg-slate-200' : 'bg-white'
          }`"
        >
          <div class="font-bold w-1/12">
            #{{ transaction.id }}
          </div>
          <span class="w-2/12">{{ transaction.date }}</span>
          <span class="w-3/12 flex justify-center">
            <span
              :class="`${getColorByStatus(
                transaction.status
              )} text-xs rounded-2xl px-4 py-2`"
            >{{ $t(transaction.status) }}</span>
          </span>
          <span class="text-right w-3/12 flex justify-center">
            <span
              :class="`${getColorByRefundStatus(
                transaction.refund_status
              )} text-xs rounded-2xl px-4 py-2`"
            >{{ $t(transaction.refund_status) }}
            </span>
          </span>
          <span class="flex justify-end gap-5 w-3/12 font-bold items-center">
            <MoneyFormat
              :number="transaction.total"
              :currency="transaction.currency"
            />
            <a
              :href="`${homeUrl}/gpos-collection-receipt/?transaction_id=${transaction.id}`"
              target="_blank"
            >
              <PrinterIcon
                v-if="printable"
                class="text-blue-700 w-6 h-6 cursor-pointer"
              />
            </a>
          </span>
        </div>
      </template>
      <template v-else>
        <div class="font-bold bg-slate-200 p-4 rounded text-slate-700">
          İşlem bulunamadı...
        </div>
      </template>
    </div>
  </div>
</template>

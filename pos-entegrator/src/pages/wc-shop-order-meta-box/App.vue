<script setup>
import { ArrowTopRightOnSquareIcon } from "@heroicons/vue/24/outline";
const transactions = window.gpos.transactions;
const bgColor = (transaction) => {
  if (transaction.type === "cancel" || transaction.type === "refund") {
    return transaction.status === "gpos_completed"
      ? "bg-[#f0f9ff] text-[#0369a1]"
      : "bg-gray-200 text-gray-700";
  } else if (transaction.type === "payment") {
    return transaction.status === "gpos_completed"
      ? "bg-green-200 text-green-700"
      : "bg-red-200 text-red-700";
  }
};
</script>
<template>
  <div
    v-if="transactions && transactions.length > 0"
    class="w-full"
  >
    <ul
      v-for="transaction in transactions"
      :key="transaction.id"
      role="list"
    >
      <li class="flex flex-col relative">
        <div
          v-if="transaction.test"
          class="absolute z-20 -top-2 -right-1 bg-yellow-100 text-yellow-600 text-[10px] rounded px-2 py-1 w-max mr-1"
        >
          Test
        </div>
        <div
          :class="`${bgColor(
            transaction
          )} p-2 flex items-center justify-between gap-1 rounded`"
        >
          <div class="text-[12px] break-all">
            {{ transaction.notes[0]?.note }}
          </div>

          <a
            class="text-blue-700 flex items-center gap-1"
            target="_blank"
            :href="transaction.edit_link"
          >#{{ transaction.id }}
            <ArrowTopRightOnSquareIcon class="w-4 h-4 text-blue-700" /></a>
        </div>
        <span class="text-[10px] text-gray-500">{{ transaction.date }}</span>
      </li>
    </ul>
    <div class="flex w-full flex-col mt-3">
      <div
        v-for="(status, key) in [
          { color: 'bg-green-200', desc: 'completed_payment' },
          { color: 'bg-[#f0f9ff]', desc: 'completed_refund' },
          { color: 'bg-red-200', desc: 'failed_payment' },
          { color: 'bg-gray-200', desc: 'failed_refund' },
        ]"
        :key="key"
        class="w-full p-1 flex gap-3 items-center"
      >
        <div :class="`p-2 rounded ${status.color}`" />
        <span class="text-[10px]">{{ $t(status.desc) }}</span>
      </div>
    </div>
  </div>
  <div v-else>
    {{ $t("transaction_not_found") }}
  </div>
</template>

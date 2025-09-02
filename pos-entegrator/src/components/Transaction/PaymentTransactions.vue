<script setup>
import RefundCol from "@/components/Transaction/PaymentTransactions/RefundCol.vue";
const props = defineProps({
  transaction: {
    type: Object,
    required: true,
  },
});

const getClassForStatus = (status) => {
  let statusClass = "rounded px-4 py-2 w-max text-xs font-medium";
  switch (status) {
    case "gpos_line_n_refunded":
      statusClass += " bg-gray-200 text-gray-800";
      break;
    case "gpos_line_refunded":
      statusClass += " bg-blue-200 text-blue-800";
      break;
    case "gpos_line_p_refunded":
      statusClass += " bg-yellow-200 text-yellow-800";
      break;
  }

  return statusClass;
};
</script>
<template>
  <div class="bg-white rounded flex flex-col shadow-md p-5">
    <div
      class="text-blue-600 font-bold text-lg"
      v-text="$t('payment_transactions')"
    />
    <div
      v-if="transaction.refunded_from_payment_plugin"
      class="text-md"
      v-text="$t('refunded_from_payment_plugin')"
    />
    <div class="border border-[#F7F7F7] my-2" />
    <div class="flex">
      <table class="w-full text-sm text-left text-gray-500 relative">
        <thead class="text-xs text-gray-700 bg-gray-50">
          <tr>
            <th
              scope="col"
              class="px-6 py-3 w-4/12"
            />
            <th
              scope="col"
              class="px-6 py-3 w-2/12"
            >
              {{ $t("total") }}
            </th>
            <template v-if="!transaction.refunded_from_payment_plugin">
              <th
                scope="col"
                class="px-6 py-3 w-2/12"
              >
                {{ $t("refundable") }}
              </th>
              <th
                scope="col"
                class="px-6 py-3 w-2/12"
              >
                {{ $t("status") }}
              </th>
              <th
                scope="col"
                class="px-6 py-3 w-2/12"
              >
                {{ $t("action") }}
              </th>
            </template>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(line, index) in props.transaction.lines_array"
            :key="line.id"
            :class="
              index % 2 === 0 ? 'bg-white border-b' : 'bg-gray-50 border-b'
            "
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 break-all"
            >
              {{ line.name }}
            </th>
            <td class="px-6 py-4">
              <MoneyFormat
                :number="line.total"
                :currency="transaction.currency"
              />
            </td>
            <template v-if="!transaction.refunded_from_payment_plugin">
              <td class="px-6 py-4">
                <MoneyFormat
                  :number="line.refundable_total"
                  :currency="transaction.currency"
                />
              </td>
              <td class="px-6 py-4">
                <div :class="getClassForStatus(line.status)">
                  {{ $t(line.status) }}
                </div>
              </td>
              <td class="px-6 py-4">
                <RefundCol :line="line" />
              </td>
            </template>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { XMarkIcon } from "@heroicons/vue/24/solid";
import { useTransactionStore } from "@/stores/TransactionStore";
import { useMainStore } from "@/stores/MainStore";
const { gatewayCanRefund } = useMainStore();
import { ref } from "vue";
const props = defineProps({
  line: {
    type: Object,
    required: true,
  },
});
const { transaction, lineBasedRefund } = useTransactionStore();
const total = ref(0);

const refundTotalChanged = (event) => {
  const inputVal = parseFloat(event.target.value);
  total.value =
    inputVal > props.line.refundable_total
      ? props.line.refundable_total
      : total.value;
};
const show = ref(false);
</script>
<template>
  <div>
    <button
      v-if="
        gatewayCanRefund(transaction) &&
          transaction.status === 'gpos_completed' &&
          transaction.type === 'payment' &&
          line.status !== 'gpos_line_refunded'
      "
      class="rounded-full bg-red-200 text-red-600 px-6 py-3 text-xs font-medium"
      @click="show = !show"
    >
      {{ $t("refund_it") }}
    </button>
    <div
      v-if="show"
      class="fixed top-0 left-0 z-50 flex align-center items-center h-screen justify-center w-full"
      style="background-color: rgba(0, 0, 0, 0.5)"
    >
      <div class="p-4 overflow-x-hidden overflow-y-auto">
        <div class="relative w-full max-w-2xl max-h-full">
          <div class="relative bg-white rounded-lg shadow">
            <div
              class="flex items-start justify-between p-4 border-b rounded-t"
            >
              <h3 class="text-xl font-semibold text-gray-900">
                {{ $t("refund_it") }}
              </h3>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                @click="show = !show"
              >
                <XMarkIcon class="w-5 h-5" />
              </button>
            </div>
            <div class="p-6 space-y-6 text-center">
              <!-- eslint-disable -->
              <p
                class="text-base leading-relaxed"
                v-html="
                  $t('line_refund_description', [
                    line.total,
                    transaction.currency,
                  ])
                "
              />
              <!-- eslint-enable -->
              <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3 w-4/12"
                    >
                      {{ $t("total") }}
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 w-4/12"
                    >
                      {{ $t("refundable") }}
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 w-4/12"
                    />
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-6 py-4">
                      <MoneyFormat
                        :number="line.total"
                        :currency="transaction.currency"
                      />
                    </td>
                    <td class="px-6 py-4">
                      <MoneyFormat
                        :number="line.refundable_total"
                        :currency="transaction.currency"
                      />
                    </td>
                    <td class="px-6 py-4 flex items-center gap-1">
                      <input
                        v-model="total"
                        type="number"
                        class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-gray-500 focus:border-gray-500 !block !w-full !p-2"
                        pattern="[0-9]"
                        required
                        @input="refundTotalChanged"
                      >
                      {{ transaction.currency }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div
              class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b"
            >
              <button
                type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                @click="lineBasedRefund(line.id, total), (show = !show)"
              >
                {{ $t("refund_it") }}
              </button>
              <button
                type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                @click="show = !show"
              >
                {{ $t("cancel") }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

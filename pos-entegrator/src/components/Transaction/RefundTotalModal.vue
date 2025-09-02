<script setup>
import { XMarkIcon } from "@heroicons/vue/24/solid";
import { useTransactionStore } from "@/stores/TransactionStore";
import { useMainStore } from "@/stores/MainStore";
import { ref } from "vue";
const { gatewayCanRefund } = useMainStore();
const { transaction, cancel, totallyRefund } = useTransactionStore();
const processCheck = async () => {
  (await transaction.cancelable) ? cancel() : totallyRefund();
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
          transaction.refund_status === 'gpos_refund_status_n_refunded'
      "
      class="rounded bg-red-200 text-red-600 px-6 py-3 font-semibold"
      @click="show = !show"
    >
      {{ $t("full_refund") }}
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
                {{ $t("full_refund") }}
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
                  $t('refund_description', [
                    transaction.total,
                    transaction.currency,
                  ])
                "
              />
              <!-- eslint-enable -->
              <p class="leading-relaxed text-gray-500 text-sm">
                {{ $t("refund_note") }}
              </p>
            </div>
            <div
              class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b"
            >
              <button
                type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                @click="processCheck(), (show = !show)"
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

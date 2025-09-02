<script setup>
import ErrorNotify from "@/components/Transaction/ErrorNotify.vue";
import {
  ArrowTopRightOnSquareIcon,
  ClipboardDocumentIcon,
} from "@heroicons/vue/24/solid";
import { ref } from "vue";
defineProps({
  transaction: {
    type: Object,
    required: true,
  },
});
const nonce = window.gpos.nonce;
const assetsUrl = window.gpos.assets_url;

function  getColorByStatus(status) {
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

let copied = ref(true);
const copy = async (text) => {
  await navigator.clipboard.writeText(text);
  copied.value = false;
  setTimeout(() => {
    copied.value = true;
  }, 1000);
};
</script>
<template>
  <div class="p-5 bg-white rounded flex flex-col shadow-md relative">
    <div class="flex items-start justify-between text-gray-400 text-xs">
      <div class="flex items-center">
        <span class="text-2xl text-gray-900 font-semibold">
          <MoneyFormat
            :number="transaction.total"
            :currency="transaction.currency"
          />
          <MoneyFormat
            v-if="transaction.before_convert_total && transaction.before_convert_currency"
            class="text-sm text-gray-400 ml-2"
            :number="transaction.before_convert_total"
            :currency="transaction.before_convert_currency"
          />
        </span>
        <span
          :class="`${getColorByStatus(
            transaction.status
          )} text-xs rounded-2xl px-4 py-2 ml-6`"
        >{{ $t(transaction.status) }}</span>
        <span
          v-if="transaction.test"
          class="bg-yellow-100 text-yellow-600 text-xs rounded-2xl px-4 py-2 ml-2"
        >TEST</span>
      </div>
      <div
        v-if="transaction.payment_id"
        class="flex gap-2 items-center cursor-pointer"
        @click="copy(transaction.payment_id)"
      >
        <span class="font-semibold">{{ $t("payment_id") }}: </span>
        {{ transaction.payment_id }}
        <ClipboardDocumentIcon
          v-if="copied"
          class="w-4 h-4"
        />
        <span
          v-else
          v-text="'copied !'"
        />
      </div>
      <ErrorNotify v-else />
    </div>
    <div v-if="transaction.type === 'payment'">
      <div class="flex gap-2 text-gray-400 text-xs">
        <span>{{ $t("installment") }} : {{ transaction.installment }}</span>
      </div>
    </div>
    <div class="border border-[#F7F7F7] my-4" />
    <div class="flex justify-between items-center">
      <div class="flex gap-12">
        <div class="flex flex-col gap-2 items-start justify-start">
          <span class="text-base font-semibold text-gray-900">{{
            $t("process")
          }}</span>
          <span>{{ $t(transaction.type) }}</span>
        </div>
        <div
          v-if="transaction.threed_type"
          class="flex flex-col gap-2 items-start justify-start"
        >
          <span class="text-base font-semibold text-gray-900">{{
            $t("threed_type")
          }}</span>
          <span>{{ transaction.threed_type }}</span>
        </div>
        <div class="flex flex-col gap-2 items-start justify-start">
          <span class="text-base font-semibold text-gray-900">{{
            $t("payment_gateway")
          }}</span>
          <img
            class="w-[50px] object-contain"
            :src="`${assetsUrl}/images/logo/${transaction.payment_gateway_id}.svg`"
          >
        </div>
        <div class="flex flex-col gap-2 items-start justify-start">
          <span class="text-base font-semibold text-gray-900">{{
            $t("plugin")
          }}</span>
          <img
            class="w-[50px] object-contain"
            :src="`${assetsUrl}/images/plugin-logo/${transaction.plugin}.svg`"
          >
        </div>
        <div class="flex flex-col gap-2 items-start justify-start">
          <span class="text-base font-semibold text-gray-900">{{
            $t("plugin_transaction_id")
          }}</span>
          <a
            class="text-blue-700 text-lg flex items-center gap-1"
            :href="`/wp-admin/post.php?post=${transaction.plugin_transaction_id}&action=edit`"
          >#{{ transaction.plugin_transaction_id }}
            <ArrowTopRightOnSquareIcon class="w-4 h-4 text-blue-700" /></a>
        </div>
        <div
          v-if="transaction.payment_transaction_id"
          class="flex flex-col gap-2 items-start justify-start"
        >
          <span class="text-base font-semibold text-gray-900">{{
            $t("payment_transaction_id")
          }}</span>

          <a
            class="text-blue-700 text-lg flex items-center gap-1"
            target="_blank"
            :href="`/wp-admin/admin.php?page=gpos-transaction&transaction=${transaction.payment_transaction_id}&_wpnonce=${nonce}`"
          >#{{ transaction.payment_transaction_id }}
            <ArrowTopRightOnSquareIcon class="w-4 h-4 text-blue-700" /></a>
        </div>
        <div class="flex flex-col gap-2 items-start justify-start">
          <span class="text-base font-semibold text-gray-900">{{
            $t("date")
          }}</span>
          <span>{{ transaction.date }}</span>
        </div>
      </div>
      <div
        v-if="transaction.type === 'payment'"
        class="flex flex-col gap-2 items-start justify-start"
      >
        <span class="text-base font-semibold text-gray-900">{{
          $t("cancel_refund_status")
        }}</span>
        <span
          :class="`${getColorByRefundStatus(
            transaction.refund_status
          )} text-xs rounded-2xl px-4 py-2`"
        >{{ $t(transaction.refund_status) }}
        </span>
      </div>
    </div>
  </div>
</template>

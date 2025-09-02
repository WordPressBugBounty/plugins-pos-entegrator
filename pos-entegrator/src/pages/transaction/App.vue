<script setup>
import Page from "@/layouts/Page.vue";
import Detail from "@/components/Transaction/Detail.vue";
import Timeline from "@/components/Transaction/Timeline.vue";
import Logs from "@/components/Transaction/Logs.vue";
import ActionLogs from "@/components/Transaction/ActionLogs.vue";
import Gate from "@/components/Transaction/Gate.vue";
import Customer from "@/components/Transaction/Customer.vue";
import CreditCard from "@/components/Transaction/CreditCard.vue";
import PaymentTransactions from "@/components/Transaction/PaymentTransactions.vue";
import RefundTotalModal from "@/components/Transaction/RefundTotalModal.vue";
import PrintPdf from "@/components/Transaction/PrintPdf.vue";
import { onMounted } from "vue";
import { ArrowLeftCircleIcon, TruckIcon, ArrowDownTrayIcon } from "@heroicons/vue/24/solid";
import { useTransactionStore } from "@/stores/TransactionStore";

const { transaction } = useTransactionStore();

const adminUrl = window.gpos.admin_url;
const homeUrl = window.gpos.home_url;

onMounted(() => {
  // İşlemler menüsünü seçili yap.
  const menu = jQuery("#toplevel_page_gurmepos");
  const href = jQuery(".toplevel_page_gurmepos");
  menu.addClass("wp-has-current-submenu");
  href.addClass("wp-has-current-submenu");
  href.siblings("ul").children("li").eq(2).addClass("current");
});
</script>

<template>
  <page
    :text="$t('transaction')"
    href="https://yardim.gurmehub.com/docs/pos-entegrator/ozellikler/islemler/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"
    video="https://www.youtube.com/watch?v=mE8Omd1S0Fo"
  >
    <div class="w-full flex justify-between items-center">
      <a :href="`${adminUrl}edit.php?post_type=gpos_transaction`">
        <span class="w-max flex gap-1 items-center my-4 cursor-pointer">
          <ArrowLeftCircleIcon class="text-blue-600 w-6 h-6" />
          <span class="text-blue-600 font-bold text-xl">{{
            $t("transaction_with_no", [transaction.id])
          }}</span>
        </span>
      </a>
      <div class="flex gap-2">
        <PrintPdf />
        <RefundTotalModal />
      </div>
    </div>

    <div class="flex w-full gap-8 mt-4">
      <div class="flex flex-col gap-8 w-3/4">
        <Detail :transaction="transaction" />
        <Customer
          :transaction="transaction"
          class="ph-no-capture"
        />
        <PaymentTransactions
          v-if="transaction.type === 'payment'"
          :transaction="transaction"
        />
        <CreditCard
          v-if="transaction?.payment_form_type === 'card_form'"
          :transaction="transaction"
        />
      </div>

      <div class="flex flex-col w-1/4 gap-8">
        <Timeline
          v-if="transaction.notes.length > 0"
          :transaction="transaction"
        />

        <Logs
          v-if="transaction.logs.length > 0"
          :transaction="transaction"
        />
        <ActionLogs
          v-if="transaction.action_logs.length > 0"
          :transaction="transaction"
        />
        <Gate
          v-if="transaction.gate_affected"
          :transaction="transaction"
        />
      </div>
    </div>
  </page>
</template>

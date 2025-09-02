import { defineStore } from "pinia";
import ajax from "@/plugins/ajax.js";
import Swal from "sweetalert2";

export const useTransactionStore = defineStore("TransactionStore", {
  state: () => ({
    transaction: window.gpos.transaction || [],
  }),
  actions: {
    async cancel() {
      const data = await ajax.post("process_cancel", {
        transaction_id: this.transaction.id,
      });
      data.total=this.transaction.total;
      this.refundEnd(data);
    },
    async totallyRefund() {
      if (this.transaction.line_based) {
        const response = [];
        for (const line of this.transaction.lines_array) {
          response.push(await this.lineBasedRefund(line.id, line.total, true));
        }
        const errors = response.filter((res) => !res.success);
        Swal.fire({
          html:
            errors.length === 0
              ? window.gpos.alert_texts.process_success
              : window.gpos.alert_texts.bulk_refund_error,
          icon: errors.length === 0 ? "success" : "error",
          confirmButtonText: window.gpos.alert_texts.ok,
          confirmButtonColor: "#1A56DB",
        }).then(function () {
          window.location.reload();
        });
      } else {
        this.refund();
      }
    },

    // Satır bazlı ödeme kuruluşları için geri ödeme.
    async lineBasedRefund(line_id, total, bulk = false) {
      const data = await ajax.post("process_line_based_refund", {
        transaction_id: this.transaction.id,
        line_id,
        total,
      });
      data.total=total;
      if (false === bulk) {
        this.refundEnd(data);
      }
      
      return data;
    },

    // İşlem bazlı ödeme kuruluşları için geri ödeme.
    async refund() {
      
      const data = await ajax.post("process_refund", {
        transaction_id: this.transaction.id,
        payment_id: this.transaction.payment_id,
        total:this.transaction.total
      });
      data.total=this.transaction.total;
      this.refundEnd(data);
    },

    async refundEnd(data, callback) {
      if(typeof(window.dataLayer) === 'object'){
        window.dataLayer.push({
          'event':window.gpos.tag_manager_settings.event_refund ? window.gpos.tag_manager_settings.event_refund : 'refund',
          "currency":this.transaction.currency,
          'transaction_id':this.transaction.plugin_transaction_id,
          'value':data.total,
        });
      }
      
      Swal.fire({
        html: data.success
          ? window.gpos.alert_texts.process_success
          : data.error_message,
        icon: data.success ? "success" : "error",
        confirmButtonText: window.gpos.alert_texts.ok,
        confirmButtonColor: "#1A56DB",
      }).then(
        callback
          ? callback
          : function () {
              window.location.reload();
            }
      );
    },
  },
});

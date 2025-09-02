import { defineStore } from "pinia";

export const useTransactionsStore = defineStore("TransactionsStore", {
  state: () => ({
    transactions: window.gpos.transactions || [],
  }),
});

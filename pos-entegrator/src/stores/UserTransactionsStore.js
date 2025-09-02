import { defineStore } from "pinia";

export const useUserTransactions = defineStore("UserTransactionsStore", {
  state: () => ({
    transactions: window.gpos.transactions || [],
  }),
});

import { defineStore } from "pinia";

export const useLogsStore = defineStore("LogsStore", {
  state: () => ({
    logs: window.gpos.log || [],
  }),
});

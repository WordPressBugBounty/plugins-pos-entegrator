<script setup>
import ActionLogsDetailsModal from "@/components/Transaction/ActionLogsDetailsModal.vue";
import StatusBadge from "@/components/Badges/StatusBadge.vue";
defineProps({
  transaction: {
    type: Object,
    required: true,
  },
});
</script>
<template>
  <div class="flex flex-col p-3 bg-white rounded h-fit shadow-md">
    <div
      class="text-blue-600 font-bold text-lg"
      v-text="$t('action_logs')"
    />
    <div class="border border-[#F7F7F7] my-4" />
    <ol class="relative border-l border-gray-200 space-y-10">
      <li
        v-for="(log, index) in transaction.action_logs"
        :key="index"
        class="ml-6"
      >
        <span
          :class="`absolute flex items-center  justify-center w-8 h-8 bg-white rounded-full -left-4 ring-8 ring-white`"
        ><ActionLogsDetailsModal :log="log" />
        </span>
        <h3 class="mb-1 text-sm font-medium flex gap-1 text-gray-900">
          {{ $t(log.process) }}
          <StatusBadge :status="log.status" />
        </h3>
        
        <time
          class="block mb-2 text-xs font-normal leading-none text-gray-400"
        >{{ log.date }}</time>
      </li>
    </ol>
  </div>
</template>

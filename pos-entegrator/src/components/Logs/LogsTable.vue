<script setup>
import LogsDetailsModel from "@/components/Logs/LogsDetailsModal.vue";
import { useLogsStore } from "@/stores/LogsStore";
const { logs } = useLogsStore();
</script>

<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th
            scope="col"
            class="px-6 py-3"
          >
            No
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            {{ $t("date") }}
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            {{ $t("payment_gateway") }}
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            {{ $t("platform") }}
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            {{ $t("process_type") }}
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            {{ $t("details") }}
          </th>
        </tr>
      </thead>
      <tbody>
        <template v-if="logs.length === 0">
          <tr class="bg-white">
            <td
              colspan="6"
              class="px-6 py-4 text-sm text-gray-400"
            >
              {{ $t("no_records") }}
            </td>
          </tr>
        </template>
        <template v-else>
          <tr
            v-for="(log, index) in logs"
            :key="index"
            class="bg-white border-b !hover:bg-white"
          >
            <td class="px-6 py-4">
              #{{ log.platform_id }}
            </td>
            <td class="px-6 py-4">
              {{ log.date }}
            </td>
            <td class="px-6 py-4">
              {{ log.gateway }}
            </td>
            <td class="px-6 py-4">
              {{ log.platform }}
            </td>
            <td class="px-6 py-4">
              {{ log.process }}
            </td>
            <td class="px-6 py-4">
              <LogsDetailsModel
                :id="log.id"
                :title="log.platform_id"
                :date=" log.date"
                :request="log.request"
                :response="log.response"
              />
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>
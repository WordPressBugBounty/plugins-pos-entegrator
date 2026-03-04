<script setup>
import { EnvelopeIcon } from "@heroicons/vue/24/solid";
const props = defineProps({
  collection: {
    type: Object,
    required: true,
  },
});

const getColorByStatus = (status) => {
  let color = "bg-gray-100 bg-gray-800";
  switch (status) {
    case "gpos_c_pending":
      color = "bg-yellow-100 text-yellow-800";
      break;
    case "gpos_c_failed":
      color = "bg-red-300 text-red-800 ";
      break;
    case "gpos_c_completed":
      color = "bg-green-200 text-green-800";
      break;
  }
  return color;
};
</script>
<template>
  <div class="p-5 bg-white rounded flex flex-col shadow-md relative">
    <div class="flex items-center justify-between text-gray-400 text-xs">
      <div class="flex items-center gap-6">
        <div class="flex flex-col">
          <time class="text-gray-900" datetime="collection.created">{{
            collection.human_date_diff
          }}</time>
          <span class="text-gray-400 text-[8px]">{{ collection.date }}</span>
        </div>

        <div class="flex items-end gap-2">
          <EnvelopeIcon
            :class="[
              'w-5 h-5',
              collection.complated_maild_sent
                ? 'text-green-500'
                : 'text-red-500',
            ]"
          />
          <span class="text-gray-400 text-[8px]">{{
            collection.complated_maild_sent
              ? $t("email_sent")
              : $t("email_not_sent")
          }}</span>
        </div>
      </div>
      <span
        :class="`${getColorByStatus(
          collection.status,
        )} text-xs rounded-2xl px-4 py-2`"
        >{{ $t(collection.status) }}</span
      >
    </div>
    <div class="border border-[#F7F7F7] my-4" />
    <table class="w-full text-sm text-left text-gray-500 relative">
      <thead class="text-xs text-gray-700 bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 w-4/12" />
          <th scope="col" class="px-6 py-3 w-2/12">
            {{ $t("sub_total") }}
          </th>
          <th scope="col" class="px-6 py-3 w-2/12">
            {{ $t("tax_rate") }}
          </th>
          <th scope="col" class="px-6 py-3 w-2/12">
            {{ $t("tax_total") }}
          </th>
          <th scope="col" class="px-6 py-3 w-2/12">
            {{ $t("total") }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="row" class="px-6 py-4 font-medium text-gray-900 break-all">
            {{ collection.amount_name }}
          </td>
          <td class="px-6 py-4">
            <MoneyFormat
              :number="collection.sub_total"
              :currency="collection.currency"
            />
          </td>
          <td class="px-6 py-4">{{ collection.tax_rate }}%</td>
          <td class="px-6 py-4">
            <MoneyFormat
              :number="collection.tax_total"
              :currency="collection.currency"
            />
          </td>
          <td class="px-6 py-4">
            <MoneyFormat
              :number="collection.total"
              :currency="collection.currency"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

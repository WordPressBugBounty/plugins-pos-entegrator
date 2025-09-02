<script setup>
import { TrashIcon } from "@heroicons/vue/24/solid";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const { wooCommerceSettings } = storeToRefs(useSettingsStore());
const categories = window.gpos.wc_categories || {};
const getText = (id) => {
  if (Object.keys(categories).length > 0) {
    return categories.find((cat) => parseInt(id) === cat.value)?.text;
  }
};
</script>
<template>
  <table class="w-full text-sm text-left text-gray-500 ">
    <thead
      class="text-xs text-gray-700 uppercase bg-gray-50 "
    >
      <tr>
        <th
          v-for="title in ['category', 'installment', 'remove']"
          :key="title"
          scope="col"
          class="px-6 py-3"
        >
          {{ $t(title) }}
        </th>
      </tr>
    </thead>
    <tbody v-if="Object.keys(wooCommerceSettings.installment_rules).length > 0">
      <tr
        v-for="(max, catId) in wooCommerceSettings.installment_rules"
        :key="catId"
        class="bg-white border-b "
      >
        <th
          scope="row"
          class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
        >
          {{ getText(catId) }}
        </th>
        <td class="px-6 py-4">
          {{ max === 1 ? $t("disable_inst") : max }}
        </td>
        <td class="px-6 py-4">
          <TrashIcon
            class="h-6 w-6 cursor-pointer text-red-600"
            @click="delete wooCommerceSettings.installment_rules[catId]"
          />
        </td>
      </tr>
    </tbody>
    <tbody v-else>
      <tr class="bg-white border-b">
        <th
          class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
        >
          {{ $t("no_rules") }}
        </th>
      </tr>
    </tbody>
  </table>
</template>

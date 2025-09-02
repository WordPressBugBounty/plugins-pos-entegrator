<script setup>
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
import TextField from "@/components/Inputs/TextField.vue";
const store = useSettingsStore();
const { currencyConverterSettings } = storeToRefs(store);
const deleteRate = (rate) => {
  const index = currencyConverterSettings.value.convert_list.indexOf(rate);
  currencyConverterSettings.value.convert_list.splice(index, 1);
};
</script>
<template>
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 bg-gray-50">
      <tr>
        <th
          scope="col"
          class="px-6 py-3 w-2/12"
        >
          {{ $t("currency") }}
        </th>
        <th
          scope="col"
          class="px-6 py-3 w-5/12"
        >
          {{ $t("convert_type") }}
        </th>
        <th
          scope="col"
          class="px-6 py-3 w-3/12"
        >
          {{ $t("convert_rate") }}
        </th>
        <th
          scope="col"
          class="px-6 py-3 w-2/12"
        >
          {{ $t("delete") }}
        </th>
      </tr>
    </thead>
    <tbody>
      <template v-if="currencyConverterSettings.convert_list.length > 0">
        <tr
          v-for="line in currencyConverterSettings.convert_list"
          :key="line.currency"
          class="border-b"
        >
          <td class="px-4 py-4">
            {{ line.currency }}
          </td>
          <td class="px-4 py-4">
            <select
              v-model="line.type"
              class="font-medium px-5 !py-3 items-center !bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg w-full"
            >
              <option value="manual_convert">
                {{ $t("manual_convert") }}
              </option>
              <option
                value="automatic_convert"
                disabled
              >
                {{ $t("automatic_convert") }} ({{ $t('soon') }})
              </option>
            </select>
          </td>
          <td class="px-4 py-4">
            <TextField
              v-model="line.rate"
              type="number"
            />
          </td>
          <td class="px-4 py-4">
            <button
              class="px-2 py-1 rounded bg-white border-red-600 text-red-600 border hover:bg-red-600 hover:text-white"
              @click="deleteRate(line)"
            >
              &#x2715;
            </button>
          </td>
        </tr>
      </template>
      <template v-else>
        <tr class="border-b">
          <td
            colspan="4"
            class="px-4 py-4"
          >
            {{ $t("no_rates") }}
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>

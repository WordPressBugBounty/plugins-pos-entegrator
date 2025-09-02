<script setup>
import { useSettingsStore } from "@/stores/SettingsStore";
import { Bars3Icon } from "@heroicons/vue/24/solid";
import { storeToRefs } from "pinia";
import RuleSelect from "@/components/Settings/Gate/RulesTable/RuleSelect.vue";
import GatewaySelect from "@/components/Settings/Gate/RulesTable/GatewaySelect.vue";
import ConditionList from "@/components/Settings/Gate/RulesTable/Conditions/ConditionList.vue";
import BankSelect from "@/components/Settings/Gate/RulesTable/Conditions/BankSelect.vue";
import FamilySelect from "@/components/Settings/Gate/RulesTable/Conditions/FamilySelect.vue";
import TextField from "@/components/Inputs/TextField.vue";
import Switch from "@/components/Inputs/Switch.vue";
import draggable from "vuedraggable";

const { gateSettings } = storeToRefs(useSettingsStore());

const rules = {
  card_bank_in_list: {
    group: 'gate_card',
    component: BankSelect,
  },
  total_bigger_than: {
    group: 'gate_price',
    component: TextField,
  },
  total_smaller_than: {
    group: 'gate_price',
    component: TextField,
  },
  installment_bigger_than: {
    group: 'gate_installment',
    component: TextField,
  },
  installment_smaller_than: {
    group: 'gate_installment',
    component: TextField,
  },
  card_country_in_list: {
    group: 'gate_card',
    component: ConditionList,
  },
  card_country_not_in_list: {
    group: 'gate_card',
    component: ConditionList,
  },
  product_category_in_list:{
    group: 'gate_woocommerce',
      component: ConditionList,
  },
  card_family_in_list:{
    group: 'gate_card',
    component: FamilySelect,
  }
};

const deleteRule = (rule) => {
  const index = gateSettings.value.indexOf(rule);
  gateSettings.value.splice(index, 1);
};
</script>
<template>
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 bg-gray-50">
      <tr>
        <th
          v-for="title in [
            'activate',
            'rule',
            'condition',
            'payment_gateway',
            'delete',
            'move',
          ]"
          :key="title"
          scope="col"
          class="px-6 py-3"
        >
          {{ $t(title) }}
        </th>
      </tr>
    </thead>
    <draggable
      v-if="Object.keys(gateSettings).length > 0"
      v-model="gateSettings"
      ghost-class="ghost"
      tag="tbody"
      item-key="priority"
    >
      <template #item="{ element }">
        <tr
          :class="`${
            gateSettings.indexOf(element) % 2 !== 0 ? 'bg-white' : 'bg-gray-50'
          } border-b`"
        >
          <th
            scope="row"
            class="px-6 py-4 w-1/12"
          >
            <Switch v-model="element.enabled" />
          </th>
          <td class="px-6 py-4 w-4/12">
            <RuleSelect
              v-model="element.rule"
              :options="rules"
              :disabled="!element.enabled"
            />
          </td>
          <td class="px-4 py-4 w-4/12">
            <component
              :is="rules[element.rule]?.component"
              v-model="element.condition"
              :disabled="!element.enabled"
            />
          </td>
          <td class="px-6 py-4 w-2/12">
            <GatewaySelect
              v-model="element.account_id"
              :disabled="!element.enabled"
            />
          </td>
          <td class="px-6 py-4 w-1/12">
            <button
              class="px-2 py-1 rounded bg-white border-red-600 text-red-600 border hover:bg-red-600 hover:text-white"
              @click="deleteRule(element)"
            >
              &#x2715;
            </button>
          </td>
          <td class="px-6 py-4 w-1/12">
            <Bars3Icon class="w-6 h-6 cursor-move" />
          </td>
        </tr>
      </template>
    </draggable>
    <tbody v-else>
      <tr class="bg-white border-b">
        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
          {{ $t("no_rules") }}
        </th>
      </tr>
    </tbody>
  </table>
</template>

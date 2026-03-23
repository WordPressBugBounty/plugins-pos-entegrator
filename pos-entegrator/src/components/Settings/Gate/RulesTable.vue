<script setup>
import { PlusIcon } from "@heroicons/vue/24/solid";
import { useSettingsStore } from "@/stores/SettingsStore";
import { Bars3Icon } from "@heroicons/vue/24/solid";
import { storeToRefs } from "pinia";
import RuleSelect from "@/components/Settings/Gate/RulesTable/RuleSelect.vue";
import GatewaySelect from "@/components/Settings/Gate/RulesTable/GatewaySelect.vue";
import ConditionList from "@/components/Settings/Gate/RulesTable/Conditions/ConditionList.vue";
import BankSelect from "@/components/Settings/Gate/RulesTable/Conditions/BankSelect.vue";
import FamilySelect from "@/components/Settings/Gate/RulesTable/Conditions/FamilySelect.vue";
import UserRoleSelect from "@/components/Settings/Gate/RulesTable/Conditions/UserRoleSelect.vue";
import TextField from "@/components/Inputs/TextField.vue";
import Switch from "@/components/Inputs/Switch.vue";
import draggable from "vuedraggable";

const { gateSettings } = storeToRefs(useSettingsStore());

const gateRules = [
  {
    group: "gate_price",
    rules: [
      { rule: "total_bigger_than", component: TextField },
      { rule: "total_smaller_than", component: TextField },
    ],
  },
  {
    group: "gate_installment",
    rules: [
      { rule: "installment_bigger_than", component: TextField },
      { rule: "installment_smaller_than", component: TextField },
    ],
  },
  {
    group: "gate_card",
    rules: [
      { rule: "card_bank_in_list", component: BankSelect },
      { rule: "card_country_in_list", component: ConditionList },
      { rule: "card_country_not_in_list", component: ConditionList },
      { rule: "card_family_in_list", component: FamilySelect },
    ],
  },

  {
    group: "gate_woocommerce",
    rules: [{ rule: "product_category_in_list", component: ConditionList }],
  },

  {
    group: "gate_wordpress",
    rules: [{ rule: "user_role_in_list", component: UserRoleSelect }],
  },
];

const addAndRule = (index) => {
  if (typeof gateSettings.value[index].rule === "string") {
    gateSettings.value[index].rule = [
      gateSettings.value[index].rule,
      "card_bank_in_list",
    ];
    gateSettings.value[index].condition = [
      gateSettings.value[index].condition,
      "",
    ];
  } else {
    gateSettings.value[index].rule.push("card_bank_in_list");
    gateSettings.value[index].condition.push("");
  }
};

const deleteRule = (index) => {
  gateSettings.value.splice(index, 1);
};

const deleteAndRule = (index, andIndex) => {
  gateSettings.value[index].rule.splice(andIndex, 1);
  gateSettings.value[index].condition.splice(andIndex, 1);
  if (gateSettings.value[index].rule.length === 0) {
    deleteRule(index);
  }
};

const getRuleComponent = (rule) => {
  const rules = gateRules.flatMap((ruleObject) => ruleObject.rules);
  return rules.find((r) => r.rule === rule)?.component;
};
</script>
<template>
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 bg-gray-50">
      <tr>
        <th
          v-for="title in ['activate', 'rule', '', 'payment_gateway', 'move']"
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
      <template #item="{ element, index }">
        <tr
          :class="`${
            gateSettings.indexOf(element) % 2 !== 0 ? 'bg-white' : 'bg-gray-50'
          } border-b`"
        >
          <td class="px-6 py-4 w-1/12">
            <Switch v-model="element.enabled" />
          </td>
          <td class="px-6 py-4 w-6/12">
            <template v-if="typeof element.rule === 'string'">
              <div
                class="grid grid-cols-[1fr_1fr_auto] gap-2 place-items-center"
              >
                <RuleSelect
                  v-model="element.rule"
                  :options="gateRules"
                  :disabled="!element.enabled"
                />
                <component
                  :is="getRuleComponent(element.rule)"
                  v-model="element.condition"
                  :disabled="!element.enabled"
                  class="w-full"
                />
                <button
                  class="px-2 py-1 rounded-lg bg-white border-red-600 text-red-600 border hover:bg-red-600 hover:text-white"
                  @click="deleteRule(index)"
                >
                  &#x2715;
                </button>
              </div>
            </template>
            <template v-else>
              <div
                class="grid grid-cols-[1fr_1fr_auto] gap-2 place-items-start"
              >
                <!-- eslint-disable -->
                <template
                  v-for="(rule, andIndex) in element.rule"
                  :key="andIndex"
                >
                  <!-- eslint-enable -->
                  <RuleSelect
                    v-model="element.rule[andIndex]"
                    :options="gateRules"
                    :disabled="!element.enabled"
                    class="mb-2"
                  />
                  <component
                    :is="getRuleComponent(rule)"
                    v-model="element.condition[andIndex]"
                    :disabled="!element.enabled"
                    class="mb-2 w-full"
                  />
                  <button
                    class="px-2 py-1 rounded-lg bg-white border-red-600 text-red-600 border hover:bg-red-600 hover:text-white"
                    @click="deleteAndRule(index, andIndex)"
                  >
                    &#x2715;
                  </button>
                </template>
              </div>
            </template>
          </td>
          <td class="px-6 py-4 w-1/12">
            <button
              class="px-2 py-1 rounded-lg bg-white border-blue-600 text-blue-600 border hover:bg-blue-600 hover:text-white"
              @click="addAndRule(index)"
            >
              {{ $t("and") }}
            </button>
          </td>
          <td class="px-6 py-4 w-2/12">
            <GatewaySelect
              v-model="element.account_id"
              :disabled="!element.enabled"
            />
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

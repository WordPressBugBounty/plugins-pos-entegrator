<script setup>
import CardBankList from "./CardBankList.vue";
import CardFamilyList from "./CardFamilyList.vue";
import CardCountryList from "./CardCountryList.vue";
import RoleList from "./RoleList.vue";
import ProductCat from "./ProductCat.vue";
defineProps({
  rule: {
    type: String,
    required: true,
  },
  condition: {
    type: [String, Array],
    required: true,
  },
});
</script>
<template>
  <div class="mt-3 flex flex-col w-full">
    <div class="flex">
      <div class="font-semibold w-1/6">{{ $t("rule") }} :</div>
      <div class="w-5/6">
        {{ $t(rule) }}
      </div>
    </div>
    <div class="flex">
      <div class="font-semibold w-1/6">{{ $t("condition") }} :</div>
      <div class="w-5/6">
        <CardBankList
          :condition="condition"
          v-if="rule.includes('card_bank_in_list')"
        />
        <CardFamilyList
          :condition="condition"
          v-else-if="rule.includes('card_family_in_list')"
        />
        <CardCountryList
          :condition="condition"
          v-else-if="
            rule.includes('card_country_in_list', 'card_country_not_in_list')
          "
        />
        <RoleList
          :condition="condition"
          v-else-if="rule.includes('user_role_in_list')"
        />
        <ProductCat
          :condition="condition"
          v-else-if="rule.includes('product_category_in_list')"
        />
        <template v-else>
          {{ condition }}
        </template>
      </div>
    </div>
  </div>
</template>

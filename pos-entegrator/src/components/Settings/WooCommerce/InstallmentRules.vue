<script setup>
import { ref } from "vue";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import NeedBadge from "@/components/Badges/NeedBadge.vue";
import CatSelector from "@/components/Settings/WooCommerce/InstallmentRules/CatSelector.vue";
import MaxSelect from "@/components/Settings/WooCommerce/InstallmentRules/MaxSelect.vue";
import DisabledTable from "@/components/Settings/WooCommerce/InstallmentRules/DisabledTable.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";
const { wooCommerceSettings } = storeToRefs(useSettingsStore());
const isProActive = window.gpos.is_pro_active;
const cats = ref([]);
const max = ref(1);

const apply = async () => {
  await cats.value.forEach((e) => wooCommerceSettings.value.installment_rules[e] = max.value);
  cats.value = [];
  max.value = 1;
};
</script>
<template>
  <SettingsCard>
    <template #header>
      <div class="flex items-center gap-2">
        {{ $t("installment_rules") }} <NeedBadge />
      </div>
    </template>
    <div class="w-full flex gap-7 relative">
      <div class="w-2/5 flex flex-col gap-4">
        <CatSelector v-model="cats" />
        <div class="w-full flex gap-2">
          <MaxSelect v-model="max" />
          <PrimaryButton
            :disabled="!isProActive" 
            @click="apply()"
          >
            {{ $t("apply") }}
          </PrimaryButton>
        </div>
      </div>
      <div class="w-3/5">
        <DisabledTable />
      </div>
    </div>
  </SettingsCard>
</template>

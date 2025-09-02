<script setup>
import SettingsTab from "@/layouts/SettingsTab.vue";
import Active from "@/components/Settings/CardSave/Active.vue";
import SaveStep from "@/components/Settings/CardSave/SaveStep.vue";
import ShortCode from "@/components/Settings/CardSave/ShortCode.vue";
import CardName from "@/components/Settings/CardSave/CardName.vue";
import SaveButton from "@/components/Inputs/SaveButton.vue";
import { useSettingsStore } from "@/stores/SettingsStore";
import { storeToRefs } from "pinia";

const store = useSettingsStore();
const { cardSave } = storeToRefs(store);
</script>

<template>
  <SettingsTab>
    <div class="w-full">
      <Active
        v-model="cardSave.active"
      />
    </div>

    <template v-if="cardSave.active">
      <div class="w-1/2">
        <SaveStep v-model="cardSave.save_step" />
      </div>
      <div class="w-1/2">
        <CardName v-model="cardSave.name_field" />
      </div>
      <div class="w-1/2">
        <ShortCode />
      </div>
    </template>

    <template
      #action
    >
      <SaveButton @click="store.updateCardSaveSettings()" />
    </template>
  </SettingsTab>
</template>

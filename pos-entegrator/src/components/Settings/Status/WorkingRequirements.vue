<script setup>
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import {
  CheckIcon, ExclamationTriangleIcon, ArrowTopRightOnSquareIcon
} from "@heroicons/vue/24/solid";
const workingRequirements = window.gpos.status.working_requirements;
import { useSettingsStore } from "@/stores/SettingsStore";
const store = useSettingsStore();
</script>
<template>
  <SettingsCard>
    <template #header>
      {{ $t('working_requirements') }}
    </template>
    <div
      v-for="(stat, index) in workingRequirements"
      :key="index"
      :class="`flex flex-row items-center justify-between p-2 ${
        index % 2 === 0 ? 'bg-gray-100' : ''
      }`"
    >
      <div class="flex flex-row">
        <span v-text="stat.label" />
        <a
          :href="stat.link"
          target="_blank"
        ><ArrowTopRightOnSquareIcon
          class="w-3 h-3 text-blue-700 mt-1"
        /></a>
      </div>
      <span class="flex flex-row">
        <span
          v-if="stat.type==='text'"
          v-text="stat.value"
        />
        <div v-else>
          <span v-if="stat.value === 'OK'" />
          <textarea
            v-text="stat.value"
          />
        </div>
        <strong class="ml-1 mr-2">
          /
          {{ stat.default_value }}
        </strong>
        <CheckIcon
          v-if="stat.status"
          class="w-4 h-4 mr-2"
        />
        <ExclamationTriangleIcon
          v-else
          class="w-4 h-4 text-red-500 mr-2"
        />
      </span>
    </div>
    <div class="w-full flex justify-end">
      <PrimaryButton
        class="mt-5"
        @click="store.reCheckStatus()"
      >
        {{ $t("recheck_status") }}
      </PrimaryButton>
    </div>
  </SettingsCard>
</template>

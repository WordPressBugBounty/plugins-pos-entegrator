<script setup>

import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import download from "downloadjs"

const exportData = () => {
  download(JSON.stringify(window.gpos.status), "status.json", "text/json");
};
</script>
<template>
  <div class="flex items-center justify-between gap-4">
    <p
      class="w-1/2 text-sm font-normal text-gray-400"
    >
      {{ $t("export_desc") }}
    </p>
    <PrimaryButton @click="exportData()">
      {{ $t("export") }}
    </PrimaryButton>
  </div>
</template>
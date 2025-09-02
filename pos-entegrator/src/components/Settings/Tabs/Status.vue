<script setup>
import WordPress from "@/components/Settings/Status/WordPress.vue";
import Server from "@/components/Settings/Status/Server.vue";
import Tools from "@/components/Settings/Status/Tools.vue";
import IyziPOS from "@/components/Settings/Status/IyziPOS.vue";
import SettingsTab from "@/layouts/SettingsTab.vue";
import WorkingRequirements from "@/components/Settings/Status/WorkingRequirements.vue";
</script>
<template>
  <SettingsTab>
    <div class="w-full">
      <WorkingRequirements />
    </div>
    <div class="w-full">
      <WordPress />
    </div>
    <div class="w-full">
      <Server />
    </div>

    
    <div class="w-full">
      <Tools />
    </div>

    <IyziPOS />
  </SettingsTab>
</template>

<script setup>
import DashboardCard from "@/components/GurmePOS/DashboardCard.vue";
import { PhoneIcon } from "@heroicons/vue/24/outline";
const assetsUrl = window.gpos.assets_url;
const supports = [
  {
    head: "gurmehub_forum",
    desc: "gurmehub_forum_desc",
    link: "https://forum.gurmehub.com/c/gurmehub/pos-entegrator/31/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",
  },
  {
    head: "give_feedback",
    desc: "gurmehub_feedback_desc",
    link: "https://posentegrator.com/pos-entegrator-yol-haritasi/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",
  },
  {
    head: "support_ticket",
    desc: "support_ticket_desc",
    link: "https://gurmehub.com/destek-talebi/?wpsc-section=ticket-list&utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",
  },
  {
    head: "docs",
    desc: "pos_entegrator_help",
    link: "https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",
  },
];

const socials = [
  {
    link: "https://www.youtube.com/channel/UCrZrRKMQoYBndiTMhzzNrzQ",
    icon: "youtube",
  },
  { link: "https://www.linkedin.com/company/gurmehub", icon: "linkedin" },
  { link: "https://www.instagram.com/gurmehubcom/", icon: "instagram" },
  { link: "https://www.tiktok.com/@gurmehubcom", icon: "tiktok" },
];
</script>
<template>
  <DashboardCard class="bg-white rounded">
    <template #header>
      {{ $t("support") }}
    </template>

    <div class="flex flex-col gap-2 divide-y">
      <div
        v-for="support in supports"
        :key="support.head"
        class="flex flex-col"
      >
        <a
          target="_blank"
          :href="support.link"
          class="font-medium text-blue-700 pt-2 underline"
        >
          {{ $t(support.head) }}</a>
        <span>{{ $t(support.desc) }}</span>
      </div>
      <div class="flex w-full">
        <div class="w-1/2 py-2">
          <span class="font-medium text-blue-700">
            {{ $t("contact_us") }}
          </span>
          <span class="flex gap-2 mt-2 text-lg">
            <a
              href="tel: +902243340356"
              class="flex gap-2 items-center"
            >
              <PhoneIcon class="w-4 h-4" /> +90 (224) 334 0 356
            </a>
          </span>
        </div>
        <div class="w-1/2 p-2">
          <span class="font-medium text-blue-700">
            {{ $t("follow_us") }}
          </span>
          <div class="flex gap-6 mt-2 items-center">
            <a
              v-for="social in socials"
              :key="social.icon"
              target="_blank"
              :href="social.link"
            >
              <img
                :src="`${assetsUrl}/images/dashboard/${social.icon}.svg`"
                class="w-4 h-4"
              >
            </a>
          </div>
        </div>
      </div>
    </div>
  </DashboardCard>
</template>

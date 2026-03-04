<script setup>
import Page from "@/layouts/Page.vue";
import Customer from "@/components/Collection/Customer.vue";
import CreditCard from "@/components/Transaction/CreditCard.vue";
import Detail from "@/components/Collection/Detail.vue";
import { ArrowLeftCircleIcon } from "@heroicons/vue/24/solid";

const collection = window.gpos.collection;
const transaction = window.gpos.transaction;
const adminUrl = window.gpos.admin_url;
</script>
<template>
  <Page
    :text="$t('collection_form')"
    href="https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"
  >
    <div class="w-full flex justify-between items-center">
      <a :href="`${adminUrl}edit.php?post_type=gpos_collection`">
        <span class="w-max flex gap-1 items-center my-4 cursor-pointer">
          <ArrowLeftCircleIcon class="text-blue-600 w-6 h-6" />
          <span class="text-blue-600 font-bold text-xl"
            >#{{ collection.id }}</span
          >
        </span>
      </a>
      <div class="flex gap-2"></div>
    </div>

    <div class="grid grid-cols-3 gap-4">
      <div class="col-span-2 flex flex-col gap-2">
        <Detail :collection="collection" />
        <CreditCard :transaction="transaction" />
      </div>
      <div class="col-span-1">
        <Customer :collection="collection" />
      </div>
    </div>
  </Page>
</template>

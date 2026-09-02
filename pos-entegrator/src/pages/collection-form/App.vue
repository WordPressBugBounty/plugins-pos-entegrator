<script setup>
import Page from "@/layouts/Page.vue";
import NavElement from "@/components/Settings/NavElement.vue";
import NavSectionTitle from "@/components/Settings/NavSectionTitle.vue";
import TextField from "@/components/Inputs/TextField.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import PaymentSettings from "@/components/CollectionForm/PaymentSettings.vue";
import FormSettings from "@/components/CollectionForm/FormSettings.vue";
import EmailSettings from "@/components/CollectionForm/EmailSettings.vue";
import SuccessPageSettings from "@/components/CollectionForm/SuccessPageSettings.vue";
import FieldSettings from "@/components/CollectionForm/FieldSettings.vue";
import { ClipboardDocumentIcon } from "@heroicons/vue/24/solid";
import { ref } from "vue";
import { useCollectionFormStore } from "@/stores/CollectionFormStore.js";
import { storeToRefs } from "pinia";
import Loading from "@/components/Loading.vue";

const store = useCollectionFormStore();
const { form } = storeToRefs(store);

const copy = async () => {
  await navigator.clipboard.writeText(
    `[gpos_collection_form id="${form.value.id}"]`,
  );
  alert("Shortcode copied to clipboard");
};

const tabs = ref([
  {
    title: "general",
    active: true,
  },
  {
    title: "fields",
    active: false,
  },
  {
    title: "payment",
    active: false,
  },
  {
    title: "success_page",
    active: false,
  },
  ...(window.gpos.collection_form_email
    ? [
      {
        title: "email",
        active: false,
      },
    ]
    : []),
]);

const tabToActive = (title) => {
  tabs.value.forEach((t) => {
    t.active = t.title === title;
  });
};

const isActiveTab = (title) => {
  return tabs.value.find((t) => t.active)?.title === title;
};
</script>
<template>
  <Page
    :text="$t('collection_form')"
    href="https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"
  >
    <Loading />
    <div class="flex gap-2">
      <div class="w-4/5 flex flex-col gap-2">
        <TextField
          v-model="form.post_title"
          :placeholder="$t('enter_form_name')"
        />
        <div class="w-full flex">
          <div
            class="w-1/5 flex flex-col bg-[#FAFAFA] py-4 rounded-l-lg space-y-4"
          >
            <NavSectionTitle>
              {{ $t("form_settings") }}
            </NavSectionTitle>
            <div>
              <NavElement
                v-for="(tab, index) in tabs"
                :id="tab.title"
                :key="index"
                :icon="`collection-form/${tab.title}`"
                :active="tab.active"
                @click="tabToActive(tab.title)"
              >
                {{ $t(tab.title) }}
              </NavElement>
            </div>
          </div>
          <div class="w-4/5 flex flex-col bg-white rounded-r-lg p-8 relative">
            <FormSettings v-if="isActiveTab('general')" />
            <FieldSettings v-if="isActiveTab('fields')" />
            <PaymentSettings v-if="isActiveTab('payment')" />
            <SuccessPageSettings v-if="isActiveTab('success_page')" />
            <EmailSettings v-if="isActiveTab('email')" />
          </div>
        </div>
      </div>
      <div class="w-1/5">
        <div
          class="w-full flex flex-col bg-[#FAFAFA] gap-4 p-4 rounded-lg divide-y"
        >
          <div class="text-lg font-medium">
            {{ form.id ? $t("update") : $t("create") }}
          </div>
          <code
            v-if="form.id"
            class="flex items-center justify-between p-1 rounded cursor-pointer gap-2 text-xs"
            @click="copy()"
          >
            [gpos_collection_form id="{{ form.id }}"]
            <ClipboardDocumentIcon class="w-3 h-3 text-gray-600" />
          </code>
          <div class="flex justify-end pt-2">
            <PrimaryButton @click="store.updateOrSaveForm()">
              {{ form.id ? $t("update") : $t("create") }}
            </PrimaryButton>
          </div>
        </div>
      </div>
    </div>
  </Page>
</template>

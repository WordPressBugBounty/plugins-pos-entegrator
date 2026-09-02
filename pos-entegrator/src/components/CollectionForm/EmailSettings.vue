<script setup>
import { ArrowTopRightOnSquareIcon } from "@heroicons/vue/24/solid";
import TextField from "@/components/Inputs/TextField.vue";
import { useCollectionFormStore } from "@/stores/CollectionFormStore.js";
import { storeToRefs } from "pinia";

const store = useCollectionFormStore();
const { form } = storeToRefs(store);
const email = window.gpos.collection_form_email;
</script>
<template>
  <div class="flex flex-col gap-4">
    <div
      v-if="email"
      class="flex flex-col gap-2"
    >
      <div class="text-blue-600 font-bold text-md">
        {{ $t("collection_form_email") }}
      </div>
      <p class="text-sm text-gray-600">
        {{ email.description }}
      </p>
      <div>
        <a
          :href="email.document_link"
          target="_blank"
          rel="noopener"
          class="inline-flex items-center gap-1 text-sm text-blue-600 underline"
        >
          {{ email.document_text }}
          <ArrowTopRightOnSquareIcon class="w-4 h-4" />
        </a>
      </div>
    </div>
    <div class="w-1/2">
      <TextField
        v-model="form.form_settings.email_subject"
        :placeholder="$t('enter_email_subject')"
        :label="$t('email_subject')"
      >
        <template #subtitle>
          {{ $t('email_subject_desc') }}
        </template>
      </TextField>
    </div>
    <div class="w-1/2">
      <label>{{ $t("email_description") }}
        <textarea
          v-model="form.form_settings.email_description"
          rows="5"
          class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
          :placeholder="$t('enter_email_description')"
        />
      </label>
      <div class="text-sm text-gray-500 mt-1">
        {{ $t("email_description_desc") }}
      </div>
    </div>
  </div>
</template>

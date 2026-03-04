<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import { useCollectionFormStore } from "@/stores/CollectionFormStore.js";
import Switch from "@/components/Inputs/Switch.vue";
import { storeToRefs } from "pinia";
const store = useCollectionFormStore();
const { form } = storeToRefs(store);
</script>
<template>
  <div class="flex flex-col space-y-4 divide-y">
    <div class="flex gap-4">
      <div class="w-1/2 flex flex-col gap-4">
        <TextField
          v-model="form.form_settings.title"
          :label="$t('form_title')"
          :placeholder="$t('enter_form_title')"
        />
        <TextField
          v-model="form.form_settings.button_text"
          :label="$t('button_text')"
          :placeholder="$t('enter_button_text')"
        />
      </div>
      <div class="w-1/2 f gap-4">
        <label>{{ $t("form_description") }}
          <textarea
            v-model="form.form_settings.description"
            rows="5"
            class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 condition-list"
            :placeholder="$t('enter_form_description')"
          />
        </label>
      </div>
    </div>
    <div class="pt-4">
      <div class="flex gap-2 items-center">
        <Switch v-model="form.form_settings.tax_field.enabled">
          {{ $t("enable_tax_fields") }}
        </Switch>
        <Switch
          v-model="form.form_settings.tax_field.required"
          :disabled="!form.form_settings.tax_field.enabled"
        >
          {{ $t("required_tax_fields") }}
        </Switch>
      </div>
    </div>
  </div>
</template>

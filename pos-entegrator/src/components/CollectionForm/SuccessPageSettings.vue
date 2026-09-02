<script setup>
import TextField from "@/components/Inputs/TextField.vue";
import Switch from "@/components/Inputs/Switch.vue";
import { useCollectionFormStore } from "@/stores/CollectionFormStore.js";
import { storeToRefs } from "pinia";

const store = useCollectionFormStore();
const { form } = storeToRefs(store);

// Ayar grubu sunucudan hiç gelmezse (eski kayıt, filtrelenmiş veri) form ekranının
// tamamının çökmemesi için varsayılanlarla dolduruyoruz.
if (!form.value.form_settings.success_page) {
  form.value.form_settings.success_page = {
    print_button: true,
    print_button_text: "",
    custom_script: "",
  };
}
</script>
<template>
  <div class="flex flex-col space-y-4 divide-y">
    <div class="flex flex-col gap-2">
      <div class="text-blue-600 font-bold text-md">
        {{ $t("success_page") }}
      </div>
      <p class="text-sm text-gray-600">
        {{ $t("success_page_desc") }}
      </p>
    </div>
    <div class="pt-4">
      <Switch v-model="form.form_settings.success_page.print_button">
        {{ $t("success_page_print_button") }}
        <template #subtitle>
          {{ $t("success_page_print_button_desc") }}
        </template>
      </Switch>
      <div
        v-if="form.form_settings.success_page.print_button"
        class="mt-5"
      >
        <TextField
          v-model="form.form_settings.success_page.print_button_text"
          :placeholder="$t('success_page_print_button_text_placeholder')"
          :label="$t('success_page_print_button_text')"
          class="w-1/2"
        >
          <template #subtitle>
            {{ $t('success_page_print_button_text_desc') }}
          </template>
        </TextField>
      </div>
    </div>
    <div class="pt-4">
      <label class="w-full flex flex-col">
        {{ $t("success_page_custom_script") }}
        <textarea
          v-model="form.form_settings.success_page.custom_script"
          rows="8"
          spellcheck="false"
          :placeholder="$t('success_page_custom_script_placeholder')"
          class="block mt-1 p-2.5 w-full font-mono text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
        />
      </label>
      <div class="text-sm text-gray-500 mt-1">
        {{ $t("success_page_custom_script_desc") }}
      </div>
    </div>
  </div>
</template>

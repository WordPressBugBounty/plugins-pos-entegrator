<script setup>
import Switch from "@/components/Inputs/Switch.vue";
import { useCollectionFormStore } from "@/stores/CollectionFormStore.js";
import { storeToRefs } from "pinia";

const store = useCollectionFormStore();
const { form } = storeToRefs(store);

// Ayar grupları sunucudan hiç gelmezse (eski kayıt) sekmenin çökmemesi için
// varsayılanlarla dolduruyoruz.
if (!form.value.form_settings.address_field) {
  form.value.form_settings.address_field = { enabled: true };
}

if (!form.value.form_settings.order_number_field) {
  form.value.form_settings.order_number_field = { enabled: false };
}
</script>
<template>
  <div class="flex flex-col space-y-4 divide-y">
    <div class="flex flex-col gap-2">
      <div class="text-blue-600 font-bold text-md">
        {{ $t("fields") }}
      </div>
      <p class="text-sm text-gray-600">
        {{ $t("fields_desc") }}
      </p>
    </div>
    <div class="pt-4">
      <Switch v-model="form.form_settings.address_field.enabled">
        {{ $t("enable_address_fields") }}
        <template #subtitle>
          {{ $t("enable_address_fields_desc") }}
        </template>
      </Switch>
    </div>
    <div class="pt-4">
      <Switch v-model="form.form_settings.order_number_field.enabled">
        {{ $t("enable_order_number_field") }}
        <template #subtitle>
          {{ $t("enable_order_number_field_desc") }}
        </template>
      </Switch>
    </div>
  </div>
</template>

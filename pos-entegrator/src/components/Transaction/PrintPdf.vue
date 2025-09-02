<script setup>
const show = window.gpos.is_form_active;
const homeUrl = window.gpos.home_url;
const transaction = window.gpos.transaction;
</script>
<template>
  <a
    v-if="show"
    :href="`${homeUrl}/gpos-collection-receipt/?transaction_id=${transaction.id}`"
    target="_blank"
    class="bg-blue-200 text-blue-900 font-medium rounded text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"
  >
    {{ $t("print") }}
  </a>
</template>

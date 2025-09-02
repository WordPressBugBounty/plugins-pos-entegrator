<script setup>
import { CalendarDaysIcon } from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";
const store = useCheckout();
const { card } = storeToRefs(store);
const focus = ref(false);

const currentYear = new Date().getFullYear();
const years = Array.from({ length: 17 }, (_, i) => (currentYear + i).toString());

</script>
<template>
  <div
    :class="`flex w-full !border !rounded ${
      focus ? '!border-blue-700' : '!border-gray-300'
    }`"
  >
    <span
      class="inline-flex relative !rounded-l items-center justify-center text-sm !bg-white !w-12 !min-w-max"
    >
      <CalendarDaysIcon
        class="!w-6 !h-6 !mx-3"
        aria-hidden="true"
      />
    </span>
    <div class="flex w-full">
      <select
        id="gpos-card-expiry-month"
        v-model="card.expiry_month"
        autocomplete="cc-exp-month"
        class="!border-0 !rounded-r !bg-white !m-0 !p-3 !focus:ring-0 !outline-0 !focus:ring-offset-0 !w-1/2"
        @focus="focus = !focus"
        @focusout="focus = !focus"
      >
        <option value="">
          {{ $t("mm") }}
        </option>
        <option
          v-for="month in [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
          ]"
          :key="month"
          :value="month"
          v-text="month"
        />
      </select>
      <select
        id="gpos-card-expiry-year"
        v-model="card.expiry_year"
        autocomplete="cc-exp-year"
        class="!border-0 !rounded-r !bg-white !m-0 !p-3 !focus:ring-0 !outline-0 !focus:ring-offset-0 !w-1/2"
        @focus="focus = !focus"
        @focusout="focus = !focus"
      >
        <option value="">
          {{ $t("yy") }}
        </option>
        <option
          v-for="year in years"
          :key="year"
          :value="year"
          v-text="year"
        />
      </select>
    </div>
  </div>
</template>

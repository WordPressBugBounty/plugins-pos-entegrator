<script setup>
import { ref } from "vue";
import {
  PlusCircleIcon,
  XMarkIcon,
  PlusIcon,
  MagnifyingGlassIcon,
} from "@heroicons/vue/24/solid";
import IconButton from "@/components/Inputs/IconButton.vue";
import NeedBadge from "@/components/Badges/NeedBadge.vue";
import PaymentTypeBadge from "@/components/Badges/PaymentTypeBadge.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import { useMainStore } from "@/stores/MainStore";
import { useGatewayAccounts } from "@/stores/GatewayAccountsStore";


const { paymentGateways } = useMainStore();
const { addGatewayAccount } = useGatewayAccounts();


const hover = ref(false);
const search = ref("");
const show = ref(false);

const gateways = () =>
  paymentGateways.filter(
    (gateway) =>
      gateway.title.toLowerCase().includes(search.value.toLowerCase())
  );
const add = async (gateway) => {
  show.value = false;
  const settingsUrl = await addGatewayAccount(gateway);

  window.location.href = settingsUrl;
};

</script>
<template>
  <div>
    <PrimaryButton
      id="gpos-add-payment-method"
      @click="show = !show"
    >
      {{ $t("add_payment_method") }}
      <PlusCircleIcon class="w-4 h-4 ml-2" />
    </PrimaryButton>
    <div
      v-if="show"
      class="fixed top-0 left-0 z-50 flex align-center items-center h-screen justify-center w-full"
      style="background-color: rgba(0, 0, 0, 0.5)"
    >
      <div class="p-4 overflow-x-hidden overflow-y-auto">
        <div class="relative w-full h-full">
          <div class="relative bg-white rounded-lg shadow w-[600px]">
            <div class="flex items-start justify-between p-1">
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                @click="show = !show"
              >
                <XMarkIcon class="w-5 h-5" />
              </button>
            </div>
            <div class="py-6 pl-6 pr-3 space-y-3">
              <p class="text-xl font-semibold flex items-center">
                {{ $t("add_payment_method") }}
                <span
                  class="ml-2 bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded border border-purple-400"
                >{{ paymentGateways.length }} {{ $t("establishment") }}</span>
              </p>
              <div class="relative w-full">
                <div
                  class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                >
                  <MagnifyingGlassIcon class="w-4 h-4 text-blue-600" />
                </div>
                <div class="pr-4">
                  <input
                    id="gpos-search-payment-method"
                    v-model="search"
                    type="text"
                    class="!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !w-full !pl-10 !p-3 mb-6"
                    :placeholder="$t('search_payment_gateway')"
                    required
                    autofocus
                  >
                </div>
              </div>
              <div
                class="payment-gateway-modal mt-2 space-y-5 overflow-y-auto h-72 max-h-min shadow-inner p-2"
              >
                <div
                  v-for="(gateway, index) in gateways()"
                  :id="gateway.id"
                  :key="index"
                  :class="`border rounded-lg flex justify-between items-center ${
                    gateway.is_need_pro ? 'bg-gray-100 p-4' : 'p-3'
                  }`"
                  @mouseleave="hover = false"
                  @mouseover="hover = index"
                >
                  <div class="flex gap-2 items-center py-2">
                    <img
                      class="w-[60px] max-h-[30px] object-contain"
                      :src="gateway.logo"
                    >
                    <div class="flex flex-col gap-2">
                      <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-600 font-semibold">{{
                          gateway.title
                        }}</span>
                        <PaymentTypeBadge :type="gateway.payment_method_type" />
                      </div>
                      <div v-if="gateway.description">
                        <div class="text-[10px] break-words w-96">
                          {{ gateway.description }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <NeedBadge v-if="gateway.is_need_pro" />
                  <div
                    v-else
                    class="gpos-add-method"
                    @click="add(gateway.id)"
                  >
                    <IconButton v-if="hover === index">
                      <PlusIcon class="w-5 h-5 font-bold" />
                    </IconButton>
                  </div>
                </div>
              </div>
            </div>
            <p class="px-6 pt-3 pb-6 text-sm font-medium text-gray-500">
              {{ $t("find_comp") }}
              <a
                href="https://posentegrator.com/bize-ulasin/"
                target="_blank"
                class="text-blue-600"
              >{{ $t("contact_us") }}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

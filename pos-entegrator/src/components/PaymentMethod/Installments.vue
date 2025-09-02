<script setup>
import { CheckIcon } from "@heroicons/vue/24/solid";
import Switch from "@/components/Inputs/Switch.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import AutoFill from "@/components/PaymentMethod/Installments/AutoFill.vue";
import RateTable from "@/components/PaymentMethod/Installments/RateTable.vue";
import VideoTutorialBadge from "@/components/Badges/VideoTutorialBadge.vue";
import { storeToRefs } from "pinia";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import { ref } from "vue";
const { gatewayAccount } = storeToRefs(useGatewayAccount());
const { updateInstallmentStatus, updateInstallments, resetInstallments } =
  useGatewayAccount();

const zoom = ref(false);

const zoomIn = () => {
  zoom.value = true;
  setTimeout(() => {
    zoom.value = false;
  }, 2000);
};
</script>
<template>
  <div class="w-full flex flex-col gap-6 bg-white p-6 rounded-lg shadow-md">
    <div class="text-2xl w-full flex justify-between font-bold text-[#111928]">
      {{ $t("installment_options") }}
      <VideoTutorialBadge video="https://www.youtube.com/watch?v=hhMeZ6rx78Y" />
    </div>
    <div class="w-full flex items-center justify-between">
      <Switch
        v-model="gatewayAccount.is_installments_active"
        @change="updateInstallmentStatus()"
      >
        {{ $t("activate_installment") }}
      </Switch>
      <div
        v-if="gatewayAccount.is_installments_active"
        class="flex gap-4"
      >
        <AutoFill />
        <PrimaryButton
          class="w-max"
          @click="updateInstallments()"
        >
          <CheckIcon class="w-4 h-4 mr-2" /> {{ $t("save_installment_rates") }}
        </PrimaryButton>
      </div>
    </div>
    <template v-if="gatewayAccount.is_installments_active">
      <div>
        {{ $t("installments_desc") }} <br> <span class="text-red-600 font-semibold">{{ $t('note') }} :</span> {{ $t("extra_installment_desc") }}
      </div>
      <RateTable />
      <div class="flex gap-2 justify-between items-end">
        <div class="flex items-center gap-4">
          <div
            class="cursor-pointer"
            @click="zoomIn()"
          >
            {{ $t("reset_installments") }}
          </div>
          <span
            :class="`${
              zoom ? 'animate-ping ' : ''
            }text-red-600 underline cursor-pointer mr-4`"
            @click="resetInstallments()"
          >
            {{ $t("reset_settings") }}
          </span>
        </div>
      </div>
    </template>
  </div>
</template>

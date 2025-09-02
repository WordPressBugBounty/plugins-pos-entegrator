<script setup>
import { TrashIcon } from "@heroicons/vue/24/solid";
import TestMode from "@/components/PaymentMethods/TestMode.vue";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import Swal from "sweetalert2";
const { deleteAccount } = useGatewayAccount();

const maybeDeleteAccount = () => {
  Swal.fire({
    html: window.gpos.alert_texts.remove_gateway,
    icon: "info",
    confirmButtonText: window.gpos.alert_texts.yes,
    cancelButtonText: window.gpos.alert_texts.cancel,
    confirmButtonColor: "#1A56DB",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      deleteAccount();
    }
  });
};
</script>
<template>
  <div
    class="w-full flex justify-between items-center border border-gray-100 rounded-lg p-5 bg-white shadow-md"
  >
    <TestMode />
    <button
      id="gpos-delete-account"
      class="text-xs text-red-600 flex gap-1 items-center font-medium"
      @click="maybeDeleteAccount()"
    >
      <TrashIcon class="w-5 h-5" />{{ $t("delete_gateway") }}
    </button>
  </div>
</template>

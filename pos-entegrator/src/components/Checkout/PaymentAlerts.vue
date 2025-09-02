<script setup>
import {
  ExclamationCircleIcon,
  CheckCircleIcon,
} from "@heroicons/vue/24/outline";
import { useCheckout } from "@/stores/CheckoutStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";
import forge from "node-forge";
import Swal from "sweetalert2";

const { formSettings } = storeToRefs(useCheckout());
const plugin = window.gpos.plugin;
const queryString =
  plugin === "givewp_v3"
    ? window.parent.location.search
    : window.location.search;
const urlParams = new URLSearchParams(queryString);
const successMessage = ref(false);
const errorMessage = ref(false);
const force =
  [
    "elementor",
    "elementor_pro",
    "wpforms",
    "ninja_forms",
    "givewp_v3",
  ].includes(plugin) && !formSettings.value.show_alerts;

const afterSubmit = (result) => {
  if (result.isConfirmed && plugin !== "givewp_v3") {
    window.location.href = window.gpos.checkout_link;
  }
};

if (urlParams.has("gpos-success")) {
  successMessage.value = forge.util.createBuffer(
    forge.util.hexToBytes(urlParams.get("gpos-success"), "utf-8")
  );
}

if (urlParams.has("gpos-error")) {
  errorMessage.value = forge.util.createBuffer(
    forge.util.hexToBytes(urlParams.get("gpos-error"), "utf-8")
  );
}
if (formSettings.value.show_alerts === "with_alert" || force) {
  if (successMessage.value) {
    Swal.fire({
      html: successMessage.value,
      icon: "success",
      confirmButtonText: window.gpos.alert_texts.ok,
      confirmButtonColor: "#A5DC86",
    }).then(afterSubmit);
  }

  if (errorMessage.value) {
    Swal.fire({
      html: errorMessage.value,
      icon: "error",
      confirmButtonText: window.gpos.alert_texts.ok,
      confirmButtonColor: "#C81E1E",
    }).then(afterSubmit);
  }
}
</script>
<template>
  <div v-if="formSettings.show_alerts === 'with_message'">
    <div
      v-if="errorMessage"
      class="w-full bg-red-200 text-red-700 p-3 rounded font-semibold flex gap-2 items-center"
    >
      <ExclamationCircleIcon class="w-10" /> {{ errorMessage }}
    </div>
    <div
      v-else-if="successMessage"
      class="w-full bg-green-200 text-green-700 p-3 rounded font-semibold flex gap-2 items-center"
    >
      <CheckCircleIcon class="w-10" /> {{ successMessage }}
    </div>
  </div>
</template>

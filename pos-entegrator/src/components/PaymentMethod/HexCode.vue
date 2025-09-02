<script setup>
import {
  ArrowPathIcon,
} from "@heroicons/vue/24/solid";
import { useGatewayAccount } from "@/stores/GatewayAccountStore";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import forge from "node-forge";
import { ref, onMounted } from "vue";
import { ClipboardDocumentIcon } from "@heroicons/vue/24/solid";

const { gatewayAccount } = useGatewayAccount();
const text = ref("");
const hexText = ref("");

const generateRandomString = () => {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  let result = '';
  for (let i = 0; i < 24; i++) {
    result += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return result;
};

onMounted(() => {
  text.value = generateRandomString();
});

const toHex = () => {
  const binaryString = forge.util.encodeUtf8(text.value);
  hexText.value = forge.util.bytesToHex(binaryString);
};

let copied = ref(true);
const copy = async (hexText) => {
  await navigator.clipboard.writeText(hexText);
  copied.value = false;
  setTimeout(() => {
    copied.value = true;
  }, 1000);
};
</script>

<template>
  <div v-if="'garanti' === gatewayAccount.gateway_property.id">
    <label class="block text-base font-medium text-gray-900 mt-5">
      {{ $t("hex_code_description") }}
    </label>

    <input
      v-model="text"
      type="text"
      maxlength="24"
      minlength="24"
      :placeholder="$t('hex_code_placeholder')"
      class="!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-base !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3 placeholder:text-gray-600 mt-4"
    >

    <PrimaryButton
      class="mt-5"
      :disabled="text.length !== 24"
      @click="toHex"
    >
      <ArrowPathIcon class="w-4 h-4 mr-2" />
      {{ $t("hex_code_converter") }}
    </PrimaryButton>

    <div class="mt-5 p-3 bg-gray-100 border border-gray-300 rounded-lg pt-3">
      <label class="block text-sm font-medium text-gray-900">{{ $t("hex_code") }}</label>
      <span class="block text-base font-semibold text-blue-600">{{ hexText }}</span>
      <span
        v-if="hexText.length != 0"
        class="cursor-pointer"
        @click="copy(hexText)"
      >
        <ClipboardDocumentIcon
          v-if="copied"
          class="w-4 h-4 text-blue-600"
        />
        <span
          v-else
          class="text-blue-600"
          v-text="'copied !'"
        />
      </span>
    </div>
  </div>
</template>

<script setup>
import { EyeIcon, XMarkIcon } from "@heroicons/vue/24/solid";
import { ref } from "vue";
const { log } = defineProps(["log"]); // eslint-disable-line
const request = JSON.parse(log.request);
const response = JSON.parse(log.response);
const show = ref(false);
</script>

<template>
  <div>
    <button
      class="flex justify-center items-center"
      @click="show = !show"
    >
      <EyeIcon class="w-4 h-4 text-blue-600" />
    </button>
    <div
      v-if="show"
      class="fixed top-0 left-0 z-50 flex pt-16 h-screen justify-center !w-full"
      style="background-color: rgba(0, 0, 0, 0.5)"
    >
      <div class="relative p-4 w-1/2">
        <div class="relative bg-white rounded-lg shadow">
          <div class="flex items-start justify-between p-4 border-b rounded-t">
            <div class="flex flex-col">
              <h3 class="text-xl font-semibold text-gray-900">
                {{ $t(log.process) }} #{{ log.transaction_id }}
                <span class="text-xs">{{ log.date }}</span>
              </h3>
            </div>
            <button
              type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
              @click="show = !show"
            >
              <XMarkIcon class="w-5 h-5" />
            </button>
          </div>

          <div class="p-6 space-y-6 bg-[#EBF0FA]">
            <div class="w-full flex flex-col gap-3">
              <div class="w-full">
                <span class="text-xl font-bold text-black">{{
                  $t("request")
                }}</span>
                <json-viewer
                  class="rounded mt-2 max-h-[30vh] overflow-auto log-modal"
                  copyable
                  sort
                  :value="request"
                />
              </div>

              <div class="w-full">
                <span class="text-xl font-bold text-black">{{
                  $t("response")
                }}</span>
                <json-viewer
                  class="rounded mt-2  max-h-[30vh] overflow-auto log-modal"
                  copyable
                  sort
                  :value="response"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

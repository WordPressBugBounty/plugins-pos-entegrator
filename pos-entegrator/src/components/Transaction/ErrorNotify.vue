<script setup>
import Warning from "@/components/Alerts/Warning.vue";
import Danger from "@/components/Alerts/Danger.vue";
import { SparklesIcon, LockClosedIcon } from "@heroicons/vue/24/outline";
import { ref, computed, watch } from "vue";
import { useTransactionStore } from "@/stores/TransactionStore";

const { transaction, consultAIAssistant } = useTransactionStore();

const consultAI = async () => {
  response.value = await consultAIAssistant(log.value);
};

const show = ref(false);
const aiModalShow = ref(false);

const log = computed(() => {
  const lastLog = transaction.logs.length
    ? transaction.logs[transaction.logs.length - 1]
    : null;
  return lastLog ? JSON.parse(lastLog.response) : null;
});

const isValid = computed(() => {
  return window.gpos.is_form_active || window.gpos.is_pro_active;
});

const response = ref(transaction.ai_consult_response);
</script>

<template>
  <div
    class="flex justify-end items-center gap-2"
    v-if="transaction.status === 'gpos_failed'"
  >
    <div class="relative">
      <div
        class="cursor-pointer text-red-700 bg-red-200 rounded-full px-4 py-2"
        @click="((show = true), (aiModalShow = false))"
      >
        {{ $t("error_notify") }}
      </div>

      <div v-if="show" class="absolute right-0 mt-2 z-10 w-[400px]">
        <Danger>
          <div class="flex items-center justify-between w-full">
            <span>{{ $t("error_notify") }}</span>
            <span class="cursor-pointer" @click="show = false"> &#x2715; </span>
          </div>

          <template #content>
            <div class="flex flex-col gap-4">
              <div>
                {{ $t("error_notify_desc_one") }}
              </div>
              <div>
                {{ $t("error_notify_desc_two") }}
                <a
                  target="_blank"
                  href="https://yardim.gurmehub.com/docs/pos-entegrator/neden-hata-aliyorum/"
                  class="text-blue-600"
                >
                  {{ $t("error_notify_link") }}
                </a>
              </div>
            </div>
          </template>
        </Danger>
      </div>
    </div>

    <div class="relative">
      <div
        @click="((aiModalShow = true), (show = false))"
        class="cursor-pointer flex items-center gap-2 text-orange-700 bg-orange-200 rounded-full px-4 py-2"
      >
        {{ $t("consult_ai_assistant") }}
        <SparklesIcon class="w-4 h-4" />
      </div>

      <div v-if="aiModalShow" class="absolute right-0 mt-2 z-10 w-[400px]">
        <Warning>
          <div class="flex items-center justify-between w-full">
            <span>{{ $t("consult_ai_assistant") }}</span>
            <span class="cursor-pointer" @click="aiModalShow = false">
              &#x2715;
            </span>
          </div>

          <template #content v-if="!response">
            <div class="flex flex-col gap-4">
              <json-viewer
                class="rounded mt-2 max-h-[30vh] overflow-auto log-modal"
                copyable
                sort
                :value="log"
              />
              <div>
                {{ $t("consult_ai_assistant_desc") }}
              </div>

              <div class="flex justify-end">
                <button
                  v-if="isValid"
                  type="button"
                  class="bg-orange-600 text-white px-4 py-2 rounded-md"
                  @click="consultAI()"
                >
                  {{ $t("consult") }}
                </button>
                <button
                  v-else
                  type="button"
                  class="bg-gray-600 text-white px-4 py-2 rounded-md cursor-not-allowed flex items-center justify-center"
                  disabled
                >
                  <LockClosedIcon class="w-4 h-4 text-white mr-2" />
                  {{ $t("need_pro_or_business") }}
                </button>
              </div>
            </div>
          </template>
          <template #content v-else>
            <div class="flex flex-col gap-2">
              <div class="text-sm text-gray-500 font-semibold">
                {{ $t("consult_ai_assistant_error_desc") }} (TR)
              </div>
              <div class="bg-white p-2 shadow-inner">
                {{ response.user_message_tr }}
              </div>

              <div class="text-sm text-gray-500 font-semibold mt-2">
                AI Assistant Error Description (EN)
              </div>
              <div class="bg-white p-2 shadow-inner">
                {{ response.user_message_en }}
              </div>

              <div class="text-sm text-gray-500 font-semibold mt-2">
                {{ $t("consult_ai_assistant_resolve_desc") }}
              </div>
              <div class="bg-white p-2">
                {{ response.merchant_note }}
              </div>
              <div class="text-sm text-gray-500 font-semibold mt-2">
                {{ $t("important_note") }}
              </div>
              <div class="text-gray-500">
                {{ $t("important_note_desc") }}
              </div>
            </div>
          </template>
        </Warning>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useIyziPOS } from "@/stores/IyziPOSStore";
import SettingsCard from "@/components/Settings/SettingsCard.vue";
import PrimaryButton from "@/components/Inputs/PrimaryButton.vue";
import Swal from "sweetalert2";


const { getSavedCards, saveCard, updateGateway } = useIyziPOS();
const accounts = window.gpos.virtual_pos_accounts.filter(
  (a) => a.gateway_id === "iyzico"
);
const accountId = ref(accounts[0].id);
const iyzipos = window.gpos.iyzipos;
const changeGateway = ref(true);
const show = ref(false);
const cards = ref([]);
const current = ref(0);
const info = async () => {
  cards.value = await getSavedCards();
  show.value = true;
};

const recover = async () => {
  current.value = 1;
  for (let i = 0; i < cards.value.length; i++) {
    current.value += i;
    await saveCard({ card: cards.value[i], account_id: accountId.value });
  }

  if (changeGateway.value) {
    await updateGateway();
  }

  Swal.fire({
    html: "Aktarım tamamlandı",
    icon: "success",
    confirmButtonText: window.gpos.alert_texts.ok,
    confirmButtonColor: "#1A56DB",
  });
};
</script>
<template>
  <div
    v-if="iyzipos.active"
    class="w-full"
  >
    <SettingsCard>
      <template #header>
        <div class="flex items-center justify-between">
          IyziPOS Tespit Edildi
          <div
            v-if="iyzipos.saved_card_count"
            class="flex items-center font-normal text-black"
          >
            {{ iyzipos.saved_card_count }} adet kayıtlı kart tespit edildi. POS
            Entegratör'e aktarmak için
            <div
              class="ml-1 text-blue-600 underline cursor-pointer"
              @click="info"
            >
              tıklayınız
            </div>
            .
          </div>
          <div v-else>
            Kayıtlı Kart Bulunamadı.
          </div>
        </div>
      </template>

      <div
        v-if="show"
        class="w-full mt-2 flex flex-col gap-2 p-2 shadow-inner rounded-md"
      >
        <div class="text-red-600 font-semibold">
          Bu işlemden önce sitenizin yedeğini almanız tavsiye edilir. Aktarım
          işlemi esnasında tarayıcınız açık kalmalıdır.
        </div>
        <div class="flex items-center">
          Kartların aktarılacağı iyzico hesabını seçiniz:

          <select
            v-model="accountId"
            class="ml-2"
          >
            <option
              v-for="account in accounts"
              :key="account.id"
              :value="account.id"
            >
              #{{ account.id }}
            </option>
          </select>
        </div>
        <div class="flex items-center">
          <input
            v-model="changeGateway"
            type="checkbox"
          >
          Aktrarım işlemi bittiğinde ödeme geçidi iyzipos olan WC
          aboneliklerimin ödeme geçidini POS Entegratör olarak güncelle.
        </div>
        <div>
          <PrimaryButton
            class="mt-2"
            @click="recover"
          >
            Aktarımı Başlat
          </PrimaryButton>
        </div>
        <div>Aktarılan: {{ current }}/{{ cards.length }}</div>
      </div>
    </SettingsCard>
  </div>
</template>

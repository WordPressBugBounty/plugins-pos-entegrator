<script setup>
const descriptions = [
  "World Mobil veya Yapı Kredi Mobil uygulamalarında yer alan World PAY menüsünden QR Kod ile Öde’yi seçin",
  "Açılan QR Kod okuyucu ile ödeme sayfasında bulunan TR Karekod’u okutun",
  "Ödeme yapacağınız kartınızı veya hesabınızı seçerek alışverişinizi hızla ve kolayca tamamlayın",
  " Ödemeyi tamamladıktan sonra sitemiz üzreinde sipariş onayı ve detayını görüntüleyebilirsiniz",
];
</script>
<template>
  <div class="p-5 flex flex-col gap-2">
    <div class="font-semibold">
      World Pay’i nasıl kullanırım?
    </div>
    <div
      class="border-l py-3 border-slate-600 border-dashed w-full flex flex-col gap-3 z-10 font-semibold"
    >
      <div
        v-for="(desc, index) in descriptions"
        :key="index"
        class="w-full z-20 flex gap-3 items-center"
      >
        <div class="-ml-1 font-semibold rounded-full bg-slate-600 h-1 w-1 p-1" />
        <div class="text-sm break-words px-2">
          {{ desc }}
        </div>
      </div>
    </div>
  </div>
</template>

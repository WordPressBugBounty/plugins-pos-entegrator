<script setup>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
import Loading from "@/components/Loading.vue";
import StoreRating from "@/components/StoreRating.vue";
defineProps({
  footer: {
    type: Boolean,
    default: true,
  },
  text: {
    type: String,
    default: "POS Entegratör",
  },
  href: {
    type: String,
    default: "https://yardim.gurmehub.com/docs/pos-entegrator/",
  },
  video: {
    type: String,
    default: "",
  },
});
</script>
<template>
  <div>
    <Loading />
    <Navbar />
    <div class="container mx-auto px-9 my-8">
      <StoreRating />
      <slot />
    </div>
    <Footer
      v-if="footer"
      :text="text"
      :href="href"
      :video="video"
    />
  </div>
</template>

<script setup>
defineProps({
  condition: {
    type: Array,
    required: true,
  },
});

const familyCodes = {
  advantage: "Advantage",
  axess: "Axess",
  bankkartcombo: "Bankartcombo",
  bonus: "Bonus",
  cardfinans: "Cardfinans",
  qnbfinansbankcc: "QNB Finansbank",
  denizbankcc: "Denizbank",
  ingbankcc: "ING Bank",
  maximum: "Maximum",
  paraf: "Paraf",
  saglamkart: "SağlamKart",
  world: "World",
};
</script>
<template>
  <div>
    {{ condition.map((e) => familyCodes[e] ?? e).join(", ") }}
  </div>
</template>

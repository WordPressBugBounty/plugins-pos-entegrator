const wpforms = window.wpforms || false;

if (wpforms) {
  jQuery(document).ready(($) => {
    platformDataChanged();
    $(".wpforms-payment-price").on("change", function () {
      platformDataChanged();
    });
    $(".wpforms-payment-price").on("input", function () {
      platformDataChanged();
    });
  });
}

function platformDataChanged() {
  window.gposDispatchAmount({
    amount: wpforms.amountTotalCalc(),
    currency: "TRY",
  });
}

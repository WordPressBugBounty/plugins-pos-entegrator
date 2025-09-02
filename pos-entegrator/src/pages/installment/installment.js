import "@/assets/installment.css";

(function ($, window) {
  let globalPrice = window.gpos_installment.price;
  let globalCurrency = window.gpos_installment.currency;
  let req;

  /**
   * Qty Change Support
   */
  $('input.qty[name="quantity"]').on("change", () => {
    getInstallmentTab(globalPrice,globalCurrency);
  });

  /**
   * Composite Product Support
   */
  $(".composite_data").on("wc-composite-initializing", (event, composite) => {
    var obj = composite.api;
    composite.actions.add_action(
      "composite_totals_changed",
      function () {
        getInstallmentTab(obj.get_composite_totals().price,globalCurrency);
      },
      100,
      obj
    );
  });

  /**
   * Variable Product Support
   */
  $(".variations_form").on("woocommerce_variation_has_changed", function () {
    const variations = $(this).data("product_variations");
    const selectedVariant = $("input.variation_id").val();
    const data = variations.find(
      (variation) => variation.variation_id == selectedVariant
    );
    if (data) {
      getInstallmentTab(data.display_price,globalCurrency);
    }
  });

  /**
   * Grouped Product Support
   */
  $(".grouped_form .qty").on("change", function () {
    const request = [];
    $(".qty").each(function (index, element) {
      request.push({
        product_id: $(element).attr("name").replace(/\D/g, ""),
        qty: parseInt($(element).val() ? $(element).val() : 0),
      });
    });

    if (typeof req !== "undefined") {
      req.abort();
    }
    req = $.ajax({
      type: "POST",
      url: `${window.gpos_installment.ajax_url}?action=gpos_calculate_group_product_price&_wpnonce=${window.gpos_installment.nonce}`,
      dataType: "json",
      contentType: "application/json",
      accept: "application/json",
      data: JSON.stringify( request ),
      success: function (response) {
        getInstallmentTab(response.total, response.currency); 
      },
    });
  });

  document.addEventListener("gpos-platform-data-changed", async (event) => {
    getInstallmentTab(event.detail.amount, event.detail.currency);
  });

  function getInstallmentTab(price, currency) {
    globalPrice = price;
    if ($('input.qty[name="quantity"]').val()) {
      price =
        parseFloat(price) * parseFloat($('input.qty[name="quantity"]').val());
    }

    if (price !== 0) {
      if (typeof req !== "undefined") {
        req.abort();
      }
      req = $.ajax({
        type: "POST",
        url: `${window.gpos_installment.ajax_url}?action=gpos_get_installment_html&_wpnonce=${window.gpos_installment.nonce}`,
        dataType: "json",
        contentType: "application/json",
        accept: "application/json",
        data: JSON.stringify({ price, currency }),
        beforeSend: function () {
          $("#gpos-installment-container").block({
            message: "Lütfen bekleyiniz",
          });
        },
        success: function (response) {
          $("#gpos-installment-div").html(response.html);
        },
        complete: function () {
          $("#gpos-installment-container").unblock();
        },
      });
    }
  }
})(jQuery, window, document);

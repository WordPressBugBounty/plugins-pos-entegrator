import Swal from "sweetalert2";
const $ = window.jQuery;
const payment_settings = window.gpos.elementor_settings;

const wpnonce = $("#_gpos_elementor_form_wpnonce").val();

$("#gpos-elementor-form").submit(function (e) {
  e.preventDefault();
  const data = JSON.stringify({
    form_data: convertFormToJSON(this),
    elementor_settings: payment_settings,
  });

  $.ajax({
    type: "POST",
    url: `${window.gpos.ajaxurl}?action=gpos_elementor_process_form&_wpnonce=${wpnonce}`,
    dataType: "json",
    contentType: "application/json",
    accept: "application/json",
    data,
    beforeSend: function () {
      $("#gpos-elementor-form").block({
        message: window.gpos.alert_texts.please_wait,
      });
    },
    success: function (response) {
      if (response.status === "success") {
        $("#gpos-elementor-form").block({ message: response.message });
        window.location.href = response.redirect;
      } else {
        Swal.fire({
          html: response.message,
          icon: "error",
          confirmButtonText: window.gpos.alert_texts.ok,
          confirmButtonColor: "#C81E1E",
        });
      }
    },
    complete: function () {
      $("#gpos-elementor-form").unblock();
    },
  });
});

$(document).ready(() => {
  window.gposDispatchAmount({
    amount: payment_settings.price,
    currency: payment_settings.currency,
  });

  $("#gpos-elementor-form #price").on("keyup", function () {
    $("#gpos-elementor-form #button-price").html(
      `${this.value} ${payment_settings.currency}`
    );
    
    window.gposDispatchAmount({
      amount: this.value,
      currency: payment_settings.currency,
    });
  });


});

function convertFormToJSON(form) {
  return window
    .jQuery(form)
    .serializeArray()
    .reduce(function (json, { name, value }) {
      json[name] = value;
      return json;
    }, {});
}

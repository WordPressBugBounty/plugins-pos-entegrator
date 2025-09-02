const inputsChanged = () => {
  const $ = window.jQuery;
  let data = {};
  $(".gpos-checkout-class :input").each((key, input) => {
    let field = $(input);

    if (field.attr("type") === "checkbox" && !field.is(":checked")) {
      return;
    }

    if (field.data("name") === "gpos-installment") {
      
      if (field.is(":checked")) {
        data["gpos-installment-rate"] = field.data("rate");
        data[field.data("name")] = field.val();
      }

      if ("SELECT" === field.prop("tagName")) {
        data["gpos-installment-rate"] = field.find(":selected").data("rate");
        data[field.data("name")] = field.find(":selected").val();
      }

      return;
    }

    if (field.attr("id")) {
      data[field.attr("id")] = field.val();
    }
  });

  document.dispatchEvent(
    new CustomEvent("gpos-inputs-changed", { detail: data })
  );
};

export default inputsChanged;

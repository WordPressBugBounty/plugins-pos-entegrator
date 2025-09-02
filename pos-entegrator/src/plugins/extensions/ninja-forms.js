if (typeof Marionette !== "undefined") {
  var gposSubmitController = window.Marionette.Object.extend({
    initialize: function () {
      var formsChannel = window.Backbone.Radio.channel("forms");
      this.listenTo(formsChannel, "before:submit", this.beforeSubmit);

      this.listenTo(
        window.Backbone.Radio.channel("calc"),
        "change:field",
        this.changeCalcField
      );

      this.listenTo(
        window.Backbone.Radio.channel("fields"),
        "blur:field",
        this.blurField
      );
    },
    beforeSubmit(model) {
      model.removeError("gpos");
      model.addExtra("extra", {
        _wp_refreshed_fragments: window.gpos.fragment._wp_refreshed_fragments,
        _wp_fragment: window.gpos.fragment._wp_fragment,
        _gpos_nonce: jQuery("input[name='_gpos_nonce']").val(),
        post_id: window.gpos.post_id,
      });
      return model;
    },
    changeCalcField(calcModel) {
      const calcName = window.gpos.platform_data?.nf_forms_total_calc || false;
      if (calcName && calcModel.attributes.name === calcName) {
        window.gposDispatchAmount({
          amount: calcModel.attributes.value,
          currency: window.gpos.platform_data.currency,
        });
      }
    },
    blurField(_, model) {
      const paymentField =
        window.gpos.platform_data?.nf_forms_total_field || false;
      if (paymentField && model.attributes.key === paymentField) {
        window.gposDispatchAmount({
          amount: model.attributes.value,
          currency: window.gpos.platform_data.currency,
        });
      }
    },
  });

  new gposSubmitController();
}

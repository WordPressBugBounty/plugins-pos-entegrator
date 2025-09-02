import pinia from "@/plugins/store.js";
import Swal from "sweetalert2";
import { storeToRefs } from "pinia";
import { useUiStore } from "@/stores/UiStore";


const request = (method, action, data) => {
  const prefix = window.gpos.prefix;
  const nonce = window.gpos.nonce;
  const ajaxurl = window.gpos.ajaxurl;
  const url = `${ajaxurl}?action=${prefix}_${action}&_wpnonce=${nonce}`;
  const { loading } = storeToRefs(useUiStore(pinia));

  return window.jQuery.ajax({
    url: url,
    type: method,
    dataType: "json",
    contentType: "application/json",
    accept: "application/json",
    data: data ? JSON.stringify(data) : false,
    beforeSend: () => {
      loading.value = true;
    },
    success: () => {
      loading.value = false;
    },
    error: (e) => {
      loading.value = false;
      if (e.statusText !== "abort") {
        Swal.fire({
          html: e.responseJSON.error_message,
          icon: "error",
          confirmButtonText: window.gpos.alert_texts.ok,
          confirmButtonColor: "#C81E1E",
        });
      }
    },
  });
};

export default {
  get(action, data) {
    return request("GET", action, data);
  },
  post(action, data) {
    return request("POST", action, data);
  },
  delete(action, data) {
    return request("DELETE", action, data);
  },
  put(action, data) {
    return request("PUT", action, data);
  },
  patch(action, data) {
    return request("PATCH", action, data);
  },
};

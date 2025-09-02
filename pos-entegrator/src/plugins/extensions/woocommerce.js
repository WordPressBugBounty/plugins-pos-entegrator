
import ajax from "@/plugins/ajax.js";
jQuery( document.body ).on( 'updated_checkout',async function(){
    window.gposDispatchAmount(await ajax.post("wc_get_cart_total"));
} );



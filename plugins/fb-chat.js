import Vue from 'vue'
import VueFbCustomerChat from 'vue-fb-customer-chat'
 
Vue.use(VueFbCustomerChat, {
  page_id: '107178937322342', //  change 'null' to your Facebook Page ID,
  theme_color: '#ffb701', // theme color in HEX
  locale: 'en_US', // default 'en_US'
})
var a = document.querySelector('.fb_customer_chat_bounce_in_v2');
if(a != null) {
  a.classList.remove('fb_customer_chat_bounce_in_v2');
  a.classList.add('fb_customer_chat_bounce_out_v2');
}
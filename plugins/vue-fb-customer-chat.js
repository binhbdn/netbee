import Vue from 'vue'
import VueFbCustomerChat from 'vue-fb-customer-chat'
 
Vue.use(VueFbCustomerChat, {
  page_id: '107178937322342', //  change 'null' to your Facebook Page ID,
  theme_color: '#ffb701', // theme color in HEX
  locale: 'vi_VN', // default 'en_US'
})
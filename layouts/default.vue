<template>
  <div>
    <HeaderClient />
    <div class="" style="width: 100%;" >
      <Banner/>
      <nuxt />
    </div>
    <Follow/>
    <FooterClient/>
  </div>
</template>
<script>
import HeaderClient from '../components/HeaderClient';
import Follow from '../components/Follow';
import FooterClient from '../components/FooterClient';
import Banner from '../components/Banner'
export default {
  components: {
    Banner,
    HeaderClient,
    Follow,
    FooterClient
  },
}
</script>

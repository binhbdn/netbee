<template>
  <div>
    <HeaderClient />
    <div style="width: 100%;" >
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
export default {
  components: {
    HeaderClient,
    Follow,
    FooterClient
  },
}
</script>

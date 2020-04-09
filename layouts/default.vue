<template>
  <div>
    <HeaderClient />
    <nuxt />
    <Follow/>
    <FooterClient/>
  </div>
</template>

<script>
import HeaderClient from "../components/HeaderClient";
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

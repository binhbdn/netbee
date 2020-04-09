<template>
  <div>
    <Header></Header>
    <nuxt />
  </div>
</template>

<script>
import Header from "../components/Header";

export default {
  data() {
    return {};
  },
  components: {
    Header
  },
  mounted() {}
};
</script>

<style>
html {
  font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;
}
</style>

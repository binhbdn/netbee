<template>
  <section class="section is-medium">
    <div class="container has-text-centered">
      <h1 class="title">Contact Me</h1>
      <p>
        You can follow me on Twitter: <a href="https://twitter.com/ammezie" target="_blank">@ammezie</a>
      </p>
    </div>
  </section>
</template>
<script>
export default {
  head: {
    title: 'Home page 🚀',
    meta: [
      { hid: 'description', name: 'description', content: 'Home page description' }
    ],
    noscript: [
      { innerHTML: 'Body No Scripts', body: true }
    ],
    script: [
      { src: '/head.js' },
      // Supported since 1.0
      { src: '/body.js', body: true },
      { src: '/defer.js', defer: '' }
    ]
  }
}
</script>

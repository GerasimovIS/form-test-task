<template>
  <div id="app">
    <div class="container">
      <Form />
    </div>
  </div>
</template>

<script>
import Form from './components/Form'

export default {
  name: 'App',
  components: {
    Form
  }
}
</script>

<style lang="scss">
body {
  margin: 0;
}

#app {
  height: 100vh;
  padding-top: 50px;
  font-family: sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.container {
  max-width: 996px;
  margin: 0 auto;
  padding: 0 15px;
}
</style>

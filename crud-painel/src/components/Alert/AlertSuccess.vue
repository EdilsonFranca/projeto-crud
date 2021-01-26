<template>
  <b-alert v-show="mensagem" class="position-absolute w-50"
           style="z-index: 3000; left: 50%; top: 20%;transform: translateX(-50%) translateY(-50%);"
           :show="dismissCountDown"
           dismissible
           fade
           variant="success"
           @dismiss-count-down="countDownChanged">
    {{ mensagem }}
  </b-alert>
</template>
<script>
export default {
  name: 'AlertSuccess',
  props: {
    countDownChanged: {},
    dismissCountDown: {},
    mensagem: {}
  }
}
</script>

<template>
  <b-alert v-show="mensagensvalidacao"  class="position-absolute"
           style="z-index: 3000; left: 50%; top: 20%;transform: translateX(-50%) translateY(-50%);"
           :show="dismissCountDown"
           dismissible
           fade
           variant="danger"
           @dismiss-count-down="countDownChanged"
  >
    <li v-for="item in mensagensvalidacao">
      {{ item[0] }}
    </li>
  </b-alert>
</template>
<script>
export default {
  name: 'AlertDanger',
  props: {
    countDownChanged: {},
    dismissCountDown: {},
    mensagensvalidacao: {}
  }
}
</script>
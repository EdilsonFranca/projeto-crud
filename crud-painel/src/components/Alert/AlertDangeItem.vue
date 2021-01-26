<template>
  <b-alert v-if="msn" class="position-absolute"
           style="z-index: 3000; left: 50%; top: 20%;transform: translateX(-50%) translateY(-50%);"
           :show="dismissCountDown"
           dismissible
           fade
           variant="danger"
           @dismiss-count-down="countDownChanged"
  >
    <p>
      {{ msn }}
    </p>
  </b-alert>
</template>

<script>
export default {
name: "AlertDangeItem",
  props: {
    countDownChanged: {},
    dismissCountDown: {},
    mensagensvalidacao: {}
  }

}
</script>

<style scoped>

</style>
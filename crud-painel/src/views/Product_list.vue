<template>
  <b-container fluid class="vh-100">
    <AlertSuccess :count-down-changed="countDownChanged"
                  :dismiss-count-down="dismissCountDown"
                  :mensagem="message"/>
    <AlertDanger :count-down-changed="countDownChanged"
                 :dismiss-count-down="dismissCountDown"
                 :mensagensvalidacao="message_validation"/>
    <b-row class="h-md-100">
      <b-col class="mt-4" md="7" style="height: 100vh;">
      <h3 class="text-center text-muted">Product list</h3>
      <div class="content">
        <ul class="list-group">
          <li class="row list-group-item border d-flex m-1 px-0" v-for="(item, i) in list_product " :key="i">
            <router-link :to="{ name: 'create', params: { id : item.id }}"
                          class="col-md-11 d-flex justify-content-between align-items-center">
              <span class="text-dark w-100 h-100">
                <svg width="16" height="16" fill="currentColor" class="bi bi-record"
                     viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 1A5 5 0 1 0 8 3a5 5 0 0 0 0 10z"/>
                </svg>
                <strong class="mr-3">Name
                  <small class="text-muted">{{ item.name }}</small>
                </strong>
              </span>
            </router-link>
            <div class="col p-0 d-flex">
                <button @click="remove(item)" class="p-0" style="border-radius: 20px;border: 2px solid red ">
                  <svg width="25" height="25" fill="red" class="btn-close" viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                </button>
            </div>
          </li>
        </ul>
      </div>
      </b-col>
    <b-col md="5">
      <div class="mt-5">
        <a href="/create"
           class="btn text-white"
           style="border: 3px solid darkorange;
           background: rgb(255, 181, 0); margin: 0px 10px;">
          <svg viewBox="0 0 16 16" width="21px" height="21px"
               fill="currentColor"
               class="bi-plus-circle mr-2 b-icon bi">
            <g data-v-7925e972="">
              <path fill-rule="evenodd"
                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
              <path fill-rule="evenodd"
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
            </g>
          </svg>
          Add new Product</a>
      </div>
    </b-col>
    </b-row>
  </b-container>
</template>

<script>
import http from "@/http";
import AlertSuccess from "@/components/Alert/AlertSuccess";
import AlertDanger from "@/components/Alert/AlertDanger";

export default {
  name: "product_list",
  components: {
    AlertSuccess,
    AlertDanger,
  },
  data() {
    return {
      list_product: {},
      message: '',
      message_validation: '',
      dismissSecs: 5,
      dismissCountDown: 0,
    }
  },
  created() {
    this.list()
  },
  methods: {
    list() {
      http.get(process.env.VUE_APP_URL + '/api/webapp/product')
          .then(({data}) => {
            if (data.success !== true) {
                 console.log(data.errors)
            }
            this.list_product = data.data
          })
          .catch(erro => console.log(erro))
    },
    remove(item) {
      var r = confirm("Are you sure you want to remove ?");
      if (r == true) {
        http.delete(process.env.VUE_APP_URL + '/api/webapp/product/' + item.id)
            .then(
                ({data}) => {
                  if (data.success == true) {
                      let indice = this.list_product.indexOf(item);
                       this.list_product.splice(indice, 1);
                       this.message = data.message;
                       this.showAlertS()
                  } else {
                       this.message = data.message;
                       this.showAlertD()
                  }
                },
                err => {
                  console.log(err);
                })
      }
    },
    showAlertD() {
      this.dismissCountDown = this.dismissSecs
    },
    showAlertS() {
      this.dismissCountDown = this.dismissSecs
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
  }
}
</script>

<style scoped>

</style>
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
        <h3 class="text-center text-muted">Product registration</h3>
        <b-form class="border p-4 m-4 " style="border-radius: 10px">
          <b-form-group
              label="Name:"
              label-for="input-name"
          >
            <b-form-input
                id="input-name"
                v-model="product.name"
                type="email"
                required
            ></b-form-input>
          </b-form-group>
          <b-form-group label="Price :"
                        label-for="input-price">
            <b-form-input
                id="input-price"
                v-model="product.price"
                required
            ></b-form-input>
          </b-form-group>
          <b-form-group
              label="Description:"
              label-for="input-description">
            <b-form-input
                id="input-description"
                v-model="product.description"
                required
            ></b-form-input>
          </b-form-group>
          <b-button v-if="isEdit" @click="alterar" class="">Editar</b-button>
          <b-button v-else class="" @click="creater">creat</b-button>
        </b-form>
      </b-col>
      <b-col md="5">
        <div class="mt-5">
          <a href="/list"
             class="btn text-white mt-4"
             style="border: 3px solid darkorange;
           background: rgb(255, 181, 0); margin: 0px 10px;">
            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
          </a>
        </div>


      </b-col>
      <footer>
        <p></p>
      </footer>
    </b-row>
  </b-container>
</template>

<script>
import http from "@/http";
import AlertSuccess from "@/components/Alert/AlertSuccess";
import AlertDanger from "@/components/Alert/AlertDanger";

export default {
  name: "Product_create",
  components: {
    AlertSuccess,
    AlertDanger,
  },
  data() {
    return {
      isEdit: false,
      product: {
        name: '',
        price: '',
        description: ''
      },
      message: '',
      message_validation: '',
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: true,
      id: this.$route.params.id
    }
  },
   created() {
    if (this.id) {
      this.isEdit = true
      http.get(process.env.VUE_APP_URL + '/api/webapp/product/' + this.id)
          .then(({data}) => {
            if (data.success !== true) {
              console.log(data.message)
            }
            this.product = data.data
          })
          .catch(erro => console.log(erro))
    }
  },
  methods: {
    creater() {
      this.message = '';
      this.message_validation = '';
      http.post(process.env.VUE_APP_URL + '/api/webapp/product', this.product)
          .then(({data}) => {
            if (data.success !== true) {
              this.message_validation = data.message
              this.showAlertD()
            } else {
              this.message = data.message;
              this.showAlertS()
              this.product.name = '';
              this.product.price = '';
              this.product.description = '';
            }
          })
          .catch(erro => console.log(erro))
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    alterar() {
      this.message = '';
      this.message_validation = '';
      http.put(process.env.VUE_APP_URL + '/api/webapp/product/'+this.id, this.product)
          .then(({data}) => {
            if (data.success !== true) {
              this.message_validation = data.message
              this.showAlertD()
            } else {
              this.message = data.message;
              this.showAlertS()
            }
          })
          .catch(erro => console.log(erro))
    },
    showAlertD() {
      this.dismissCountDown = this.dismissSecs
    },
    showAlertS() {
      this.dismissCountDown = this.dismissSecs
    },
  }
}
</script>

<style scoped>

</style>
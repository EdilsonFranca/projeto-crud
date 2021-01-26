import Vue from 'vue'
import VueRouter from 'vue-router'
import Product_list from '../views/Product_list.vue'
import Product_create from '../views/Product_create.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'list',
    component: Product_list
  },
  {
    path: '/list',
    name: 'list',
    component: Product_list
  },
  {
    path: '/create',
    name: 'create',
    component: Product_create
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
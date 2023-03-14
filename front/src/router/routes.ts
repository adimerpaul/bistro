import { RouteRecordRaw } from 'vue-router'
import MainLayout from 'layouts/MainLayout.vue'
import IndexPage from 'pages/IndexPage.vue'
import Categories from 'pages/Categories.vue'
import Products from 'pages/Products.vue'
import Sales from 'pages/Sales.vue'
import Listado from 'pages/ListadoVenta.vue'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: MainLayout,
    children: [
      { path: '', component: IndexPage },
      { path: 'categories/:id', component: Categories },
      { path: 'products/:id', component: Products },
      { path: 'sales/:id', component: Sales },
      { path: 'listado/:id', component: Listado }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes

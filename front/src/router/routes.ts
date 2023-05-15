import { RouteRecordRaw } from 'vue-router'
import MainLayout from 'layouts/MainLayout.vue'
import IndexPage from 'pages/IndexPage.vue'
import Categories from 'pages/Categories.vue'
import Products from 'pages/Products.vue'
import Sales from 'pages/Sales.vue'
import Listado from 'pages/ListadoVenta.vue'
import Cufd from 'pages/Cufd.vue'
import Cuis from 'pages/Cuis.vue'
import EventoSignificativo from 'pages/EventoSignificativo.vue'
import Sincronizacion from 'pages/Sincronizacion.vue'
import Caja from 'pages/Caja.vue'
import User from 'pages/User.vue'
import Login from 'pages/Login.vue'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: MainLayout,
    children: [
      { path: '', component: IndexPage, meta: { requiresAuth: true } },
      { path: 'categories/:id', component: Categories, meta: { requiresAuth: true } },
      { path: 'products/:id', component: Products, meta: { requiresAuth: true } },
      { path: 'sales/:id', component: Sales, meta: { requiresAuth: true } },
      { path: 'listado/:id', component: Listado, meta: { requiresAuth: true } },
      { path: 'cufd', component: Cufd, meta: { requiresAuth: true } },
      { path: 'cuis', component: Cuis, meta: { requiresAuth: true } },
      { path: 'eventoSignificativo', component: EventoSignificativo, meta: { requiresAuth: true } },
      { path: 'sincronizacion', component: Sincronizacion, meta: { requiresAuth: true } },
      { path: 'caja/:id', component: Caja, meta: { requiresAuth: true } },
      { path: 'usuarios', component: User, meta: { requiresAuth: true } }
    ]
  },
  {
    path: '/login',
    component: Login
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes

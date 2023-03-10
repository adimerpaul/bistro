<template>
  <q-layout view="lHh Lpr lFf">
    <q-header>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen=!leftDrawerOpen"
        />
        <q-toolbar-title>
          Bilstro
          <span class="text-grey text-subtitle2">Usuario</span>
          {{title}}
        </q-toolbar-title>
        <div>
          <q-btn
            flat
            dense
            round
            icon="logout"
            aria-label="Logout"
            @click="logout"
          />
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-list>
        <q-item-label header class="text-center text-bold">
          Opciones
        </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'
import { setCssVar } from 'quasar'

const linksList = [
  {
    title: 'Principal',
    caption: 'Página principal',
    icon: 'o_home',
    to: '/'
  },
  {
    title: 'Categorías sabor peru',
    caption: 'Categorías de productos',
    icon: 'o_category',
    to: '/categories/1'
  },
  {
    title: 'Categorías cafe italia',
    caption: 'Categorías de productos',
    icon: 'o_category',
    to: '/categories/2'
  },
  {
    title: 'Categorías vaca fria',
    caption: 'Categorías de productos',
    icon: 'o_category',
    to: '/categories/3'
  },
  {
    title: 'Productos sabor peru',
    caption: 'productos',
    icon: 'storefront',
    to: '/products/1'
  },
  {
    title: 'Productos cafe italia',
    caption: 'productos',
    icon: 'storefront',
    to: '/products/2'
  },
  {
    title: 'Productos vaca fria',
    caption: 'productos',
    icon: 'storefront',
    to: '/products/3'
  }
]

export default defineComponent({
  name: 'MainLayout',
  components: {
    EssentialLink
  },
  data () {
    return {
      essentialLinks: linksList,
      leftDrawerOpen: ref(false)
    }
  },
  mounted () {
    console.log(this.$route.path)
  },
  methods: {
    logout () {
      console.log('logout')
      setCssVar('primary', '#1976d2')
    }
  },
  computed: {
    title () {
      if (this.$route.path === '/') {
        setCssVar('primary', '#1976d2')
        return ''
      } else if (this.$route.path === '/categories/1') {
        setCssVar('primary', '#8C131A')
        return 'Sabor peru'
      } else if (this.$route.path === '/categories/2') {
        setCssVar('primary', '#009203')
        return 'Cafe italia'
      } else if (this.$route.path === '/categories/3') {
        setCssVar('primary', '#00538F')
        return 'Vaca fria'
      } else {
        return ''
      }
    }
  }
})
</script>

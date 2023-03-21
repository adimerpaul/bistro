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
      :width="250"
    >
      <q-list bordered class="rounded-borders">
        <q-item-label header class="text-center text-bold">
          Opciones
        </q-item-label>

        <q-item clickable dense to="/" exact active-class="bg-primary text-white">
          <q-item-section avatar><q-icon name="o_home" /></q-item-section>
          <q-item-section><q-item-label>Principal</q-item-label><q-item-label caption class="text-grey">Pagina principal</q-item-label></q-item-section>
        </q-item>
        <q-expansion-item dense expand-separator icon="o_engineering" label="Siat" >
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="o_psychology" label="Cuis" default-opened to="/cuis" hide-expand-icon/>
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="o_countertops" label="sincronizacion" default-opened to="/sincronizacion" hide-expand-icon/>
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="link" label="Cufd" default-opened to="/cufd" hide-expand-icon/>
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="list" label="Evento significativo" default-opened to="/eventoSignificativo" hide-expand-icon/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_category" label="Categoria" default-opened>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_category" label="Sabor peru" to="/categories/1" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_category" label="Cafe italia" to="/categories/2" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_category" label="Vaca fria" to="/categories/3" hide-expand-icon/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_shopping_bag" label="Productos" default-opened>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_bag" label="Sabor peru" to="/products/1" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_bag" label="Cafe italia" to="/products/2" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_bag" label="Vaca fria" to="/products/3" hide-expand-icon/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_shopping_cart" label="Venta" default-opened>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_cart" label="Sabor peru" to="/sales/1" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_cart" label="Cafe italia" to="/sales/2" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_cart" label="Vaca fria" to="/sales/3" hide-expand-icon/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_description" label="Reportes" default-opened>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_description" label="Sabor peru" to="/listado/1" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_description" label="Cafe italia" to="/listado/2" hide-expand-icon/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_description" label="Vaca fria" to="/listado/3" hide-expand-icon/>
        </q-expansion-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { setCssVar } from 'quasar'

export default defineComponent({
  name: 'MainLayout',
  data () {
    return {
      leftDrawerOpen: ref(false)
    }
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
      } else if (this.$route.path === '/products/1') {
        setCssVar('primary', '#8C131A')
        return 'Sabor peru'
      } else if (this.$route.path === '/products/2') {
        setCssVar('primary', '#009203')
        return 'Cafe italia'
      } else if (this.$route.path === '/products/3') {
        setCssVar('primary', '#00538F')
        return 'Vaca fria'
      } else if (this.$route.path === '/sales/1') {
        setCssVar('primary', '#8C131A')
        return 'Sabor peru'
      } else if (this.$route.path === '/sales/2') {
        setCssVar('primary', '#009203')
        return 'Cafe italia'
      } else if (this.$route.path === '/sales/3') {
        setCssVar('primary', '#00538F')
        return 'Vaca fria'
      } else if (this.$route.path === '/listado/1') {
        setCssVar('primary', '#8C131A')
        return 'Sabor peru'
      } else if (this.$route.path === '/listado/2') {
        setCssVar('primary', '#009203')
        return 'Cafe italia'
      } else if (this.$route.path === '/listado/3') {
        setCssVar('primary', '#00538F')
        return 'Vaca fria'
      } else {
        return ''
      }
    }
  }
})
</script>

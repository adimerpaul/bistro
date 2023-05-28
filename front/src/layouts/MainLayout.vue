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
          Bistro
          <span class="text-accent "></span>
          {{ store.user.name }}
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
        <q-expansion-item dense exact expand-separator icon="o_people" label="Usuarios" to="/usuarios" expand-icon="null" v-if="store.booluser"/>
        <q-expansion-item dense expand-separator icon="o_engineering" label="Siat" v-if="store.boolsiat||store.boolcuis||store.boolsincr||store.boolcufd||store.boolevento">
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="o_psychology" label="Cuis" default-opened to="/cuis" hide-expand-icon  v-if="store.boolcuis"/>
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="o_countertops" label="sincronizacion" default-opened to="/sincronizacion" hide-expand-icon  v-if="store.boolsincr"/>
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="link" label="Cufd" default-opened to="/cufd" hide-expand-icon  v-if="store.boolcufd"/>
          <q-expansion-item dense exact :header-inset-level="1" expand-separator icon="list" label="Evento significativo" default-opened to="/eventoSignificativo" hide-expand-icon  v-if="store.boolevento"/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_category" label="Categoria" default-opened v-if="store.boolrubrosp||store.boolrubroci||store.boolrubrovf">
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_category" label="Sabor peru" to="/categories/1" hide-expand-icon  v-if="store.boolrubrosp"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_category" label="Cafe italia" to="/categories/2" hide-expand-icon  v-if="store.boolrubroci"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_category" label="Vaca fria" to="/categories/3" hide-expand-icon  v-if="store.boolrubrovf"/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_shopping_bag" label="Productos" default-opened v-if="store.boolproductosp||store.boolproductoci||store.boolproductovf">
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_bag" label="Sabor peru" to="/products/1" hide-expand-icon  v-if="store.boolproductosp"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_bag" label="Cafe italia" to="/products/2" hide-expand-icon  v-if="store.boolproductoci"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_bag" label="Vaca fria" to="/products/3" hide-expand-icon  v-if="store.boolproductovf"/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_shopping_cart" label="Venta" default-opened v-if="store.boolsabor||store.boolcafe||store.boolvaca">
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_cart" label="Sabor peru" to="/sales/1" hide-expand-icon  v-if="store.boolsabor"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_cart" label="Cafe italia" to="/sales/2" hide-expand-icon  v-if="store.boolcafe"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_shopping_cart" label="Vaca fria" to="/sales/3" hide-expand-icon  v-if="store.boolvaca"/>
        </q-expansion-item>
        <q-expansion-item dense  icon="o_description" label="Reportes" default-opened v-if="store.boollistsabor||store.boollistcafe||store.boollistvaca">
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_description" label="Sabor peru" to="/listado/1" hide-expand-icon  v-if="store.boollistsabor"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_description" label="Cafe italia" to="/listado/2" hide-expand-icon  v-if="store.boollistcafe"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="o_description" label="Vaca fria" to="/listado/3" hide-expand-icon  v-if="store.boollistvaca"/>
        </q-expansion-item>
        <q-expansion-item dense  icon="point_of_sale" label="Caja" default-opened v-if="store.boolcajasabor||store.boolcajacafe||store.boolcajavaca">
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="point_of_sale" label="Sabor peru" to="/caja/1" hide-expand-icon  v-if="store.boolcajasabor"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="point_of_sale" label="Cafe italia" to="/caja/2" hide-expand-icon  v-if="store.boolcajacafe"/>
          <q-expansion-item dense expand-separator :header-inset-level="1"  icon="point_of_sale" label="Vaca fria" to="/caja/3" hide-expand-icon  v-if="store.boolcajavaca"/>
        </q-expansion-item>
      </q-list>
    </q-drawer>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { setCssVar } from 'quasar'
import { globalStore } from '../stores/globalStore'

export default defineComponent({
  name: 'MainLayout',
  data () {
    return {
      leftDrawerOpen: ref(false),
      store: globalStore()
    }
  },
  created () {
    this.eventSearch()
  },
  methods: {
    logout () {
      this.$q.dialog({
        title: 'Cerrar sesión',
        message: '¿Está seguro que desea cerrar sesión?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$q.loading.show()
        this.$api.post('logout').then(() => {
          globalStore().user = {}
          localStorage.removeItem('tokenMulti')
          globalStore().isLoggedIn = false
          this.$router.push('/login')
          this.$q.loading.hide()
          globalStore().isLoggedIn = false
          globalStore().booluser = false
          globalStore().boolcuis = false
          globalStore().boolsincr = false
          globalStore().boolcufd = false
          globalStore().boolevento = false
          globalStore().boolrubrosp = false
          globalStore().boolrubroci = false
          globalStore().boolrubrovf = false
          globalStore().boolproductosp = false
          globalStore().boolproductoci = false
          globalStore().boolproductovf = false
          globalStore().boolsabor = false
          globalStore().boolcafe = false
          globalStore().boolvaca = false
          globalStore().boollistsabor = false
          globalStore().boollistcafe = false
          globalStore().boollistvaca = false
          globalStore().boolcajasabor = false
          globalStore().boolcajacafe = false
          globalStore().boolcajavaca = false
          globalStore().boolcliente = false
        })
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      }).onCancel(() => {})
    },
    eventSearch () {
      // this.$api.post('eventSearch').then((res: { data: number }) => {
      // console.log(res.data)
      // this.store.eventNumber = res.data
      // })
    },
    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
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
      } else if (this.$route.path === '/caja/1') {
        setCssVar('primary', '#8C131A')
        return 'Sabor peru'
      } else if (this.$route.path === '/caja/2') {
        setCssVar('primary', '#009203')
        return 'Cafe italia'
      } else if (this.$route.path === '/caja/3') {
        setCssVar('primary', '#00538F')
        return 'Vaca fria'
      } else {
        return ''
      }
    }
  }
})
</script>

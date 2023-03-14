<template>
    <q-page>
      <div class="row">
        <div class="col-12">
            <div class="bg-primary text-white text-bold text-center text-h4">{{titulo}}</div>
          </div>
          <div class="col-12">
            <q-form @submit.prevent="listadoGet">
              <div class="row">
                <div class="col-4 q-pa-xs">
                  <q-input outlined label="FechaIni" type="date" v-model="fechaIni" />
                </div>
                <div class="col-4 q-pa-xs">
                  <q-input outlined label="FechaFin" type="date" v-model="fechaFin" />
                </div>
                <div class="col-4 q-pa-xs flex flex-center">
                  <q-btn label="Buscar" icon="search" color="primary" type="submit" class="" :loading="loading" />
                </div>
              </div>
            </q-form>
        </div>
        <div class="col-12">
            <q-table :rows="listado" :columns="listaColums" :filter="filter">
                <template v-slot:top-right>
                   <q-btn color="green"  label="Export EXCEL" @click="exportar" />
                   <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
                    <template v-slot:append>
                      <q-icon name="search" />
                    </template>
                  </q-input>
                </template>
                <template v-slot:body-cell-siatAnulado="props">
                  <q-td :props="props" auto-width>
                    <q-badge :color="props.row.siatAnulado?'red':'green'" :label="props.row.siatAnulado?'A':'V'"/>
                  </q-td>
                </template>
                <template v-slot:body-cell-Opciones="props">
                  <q-td :props="props" auto-width>
                    <q-btn-dropdown color="primary" label="Opciones">
                      <q-list>
                        <q-item clickable v-close-popup v-if="props.row.siatAnulado==0">
                          <q-item-section>
                            <q-btn icon="print" color="primary" class="full-width" label="Imprimir" no-caps @click="printFactura(props.row)" v-if="props.row.siatAnulado==0"/>
                          </q-item-section>
                        </q-item>
                        <q-item clickable v-close-popup v-if="props.row.siatAnulado==0">
                          <q-item-section>
                            <q-btn icon="list" color="green" class="full-width" label="Comanda" no-caps @click="printComanda(props.row)" v-if="props.row.siatAnulado==0"/>
                          </q-item-section>
                        </q-item>
                        <q-item clickable v-close-popup v-if="props.row.siatAnulado==0">
                          <q-item-section>
                            <q-btn icon="cancel_presentation" color="red" class="full-width" label="Anular" no-caps @click="anularSale(props.row)" v-if="props.row.siatAnulado==0"/>
                          </q-item-section>
                        </q-item>
                        <q-item clickable v-close-popup>
                          <q-item-section>
                            <q-btn type="a" label="Imp Impuestos " class="full-width" color="info" target="_blank" :href="`${cine.url2}consulta/QR?nit=${cine.nit}&cuf=${props.row.cuf}&numero=${props.row.numeroFactura }&t=2`" />
                          </q-item-section>
                        </q-item>
                        <q-item clickable v-close-popup v-if="props.row.siatAnulado==0">
                          <q-item-section>
                            <q-btn label="Enviar Correo " class="full-width" color="teal" @click="correo(props.row)"/>
                          </q-item-section>
                        </q-item>
                      </q-list>
                    </q-btn-dropdown>
                  </q-td>
                </template>
                <template v-slot:body-cell-siatEnviado="props">
                  <q-td :props="props" auto-width>
                    <q-badge :color="props.row.siatEnviado?'green':'red'" :label="props.row.siatEnviado?'V':'E'"/>
                  </q-td>
                </template>
              </q-table>
        </div>
      </div>
      <q-dialog v-model="categoryShow">
        <q-card>
          <q-card-section class="row items-center q-pb-none">
            <div class="text-h6">{{ categoryStatus== 'create' ? 'Crear Categoria' : 'Editar Categoria' }}</div>
            <q-space />
            <q-btn flat icon="close" v-close-popup />
          </q-card-section>
          <q-card-section>
            <q-form @submit.prevent="categorySubmit" ref="myForm">
              <div class="row">
                <div class="col-12 col-md-12">
                  <q-input v-if="categoryStatus == 'edit' || categoryStatus == 'create'" outlined dense v-model="category.name" label="Nombre" hint="" :rules="[val => val.length > 0 || 'El nombre es requerido']" />
                </div>
                <div class="col-12 col-md-12 flex flex-center">
                  <q-color v-if="categoryStatus == 'edit' || categoryStatus == 'create'" v-model="category.color" default-view="palette" style="max-width: 150px" />
                </div>
                <div class="col-12 col-md-12 flex flex-center">
                  <q-uploader
                    v-if="categoryStatus == 'create' || categoryStatus == 'editPhoto'"
                    accept=".jpg, .png"
                    multiple
                    auto-upload
                    label="Arrastra una imagen o haz click para seleccionar"
                    @uploading="uploadingFn"
                    ref="uploader"
                    @failed="errorFn"
                    max-files="1"
                    auto-expand
                    :url="categoryStatus=='create'?`${$url}upload/create/1`:`${$url}upload/editCategory/${category.id}`"
                    stack-label="upload image"
                  />
                </div>
                <div class="col-12 col-md-12 text-center q-pt-xs">
                  <q-btn :loading="loading" color="primary" label="Guardar" type="submit" no-caps icon="o_save" class="full-width"  />
                </div>
              </div>
            </q-form>
          </q-card-section>
        </q-card>
      </q-dialog>
    </q-page>
  </template>

<script>
import xlsx from 'json-as-xlsx'
import { date } from 'quasar'

export default {
  name: 'ListadoPage',
  data () {
    return {
      inventarieDialog: false,
      categoryStatus: 'Crear',
      loading: false,
      inventaries: [],
      categoryShow: false,
      fechaIni: date.formatDate(new Date(), 'YYYY-MM-DD'),
      fechaFin: date.formatDate(new Date(), 'YYYY-MM-DD'),
      shop_id: this.$route.params.id,
      opt: ['SABOR PERU', 'CAFE ITALIA', 'VACA FRIA'],
      categories: [],
      listado: [],
      titulo: '',
      category: {
        name: '',
        color: '',
        imagen: ''
      },
      users: [],
      categoryFiltar: '',
      listaColums: [
        { name: 'Opciones', label: 'Opciones', field: 'Opciones' },
        { name: 'numeroFactura', label: 'numeroFactura', field: row => 'N' + row.numeroFactura, sortable: true },
        { name: 'siatEnviado', label: 'siatEnviado', field: 'siatEnviado', sortable: true },
        { name: 'fechaEmision', label: 'fechaEmision', field: 'fechaEmision', sortable: true },
        { name: 'client_id', label: 'client_id', field: row => row.client.nombreRazonSocial, sortable: true },
        { name: 'user_id', label: 'user_id', field: row => row.user.name, sortable: true },
        { name: 'montoTotal', label: 'montoTotal', field: 'montoTotal', sortable: true },
        { name: 'siatAnulado', label: 'siatAnulado', field: 'siatAnulado', sortable: true },
        { name: 'id', label: 'id', field: 'id', sortable: true },
        { name: 'cuf', label: 'cuf', field: 'cuf', sortable: true }
      ]
    }
  },
  created () {
    this.listadoGet()
    this.$watch(
      () => this.$route.params,
      (toParams) => {
        // console.log(previousParams)
        this.shop_id = toParams.id
        this.titulo = this.opt[this.shop_id - 1]
        this.listadoGet()
      }
    )
  },
  methods: {
    categoryDelete (category) {
      this.$q.dialog({
        title: 'Eliminar Categoria',
        message: '¿Estas seguro de eliminar esta categoria?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.loading = true
        this.$api.delete(`categories/${category.id}`)
          .then(() => {
            this.categoriesGet()
            this.$q.notify({
              color: 'green-4',
              textColor: 'white',
              icon: 'cloud_done',
              position: 'top',
              message: 'Categoria eliminada correctamente'
            })
          })
          .catch(err => {
            this.loading = false
            this.$q.notify({
              color: 'red-4',
              textColor: 'white',
              icon: 'cloud_done',
              position: 'top',
              message: err.response.data.message
            })
          })
      })
    },

    deleteCategory (category) {
      this.$q.dialog({
        title: 'Eliminar',
        message: '¿Estas seguro de eliminar esta categoria?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$q.loading.show()
        this.$api.delete('categories/' + category.id).then(() => {
          this.categoriesGet()
        }).finally(() => {
          this.$q.loading.hide()
        }).catch(() => {
          this.$q.notify({
            message: 'No se puede eliminar esta categoria porque tiene activos asociados',
            color: 'negative',
            icon: 'warning',
            position: 'top'
          })
        })
      })
    },

    categorySubmit () {
      this.$q.loading.show()
      this.category.shop_id = this.shop_id
      if (this.categoryStatus === 'create') {
        this.$api.post('categories', this.category).then(() => {
          this.categoriesGet()
          this.categoryShow = false
        }).finally(() => {
          this.$q.loading.hide()
        })
      } else {
        this.$api.put('categories/' + this.category.id, this.category).then(() => {
          this.categoriesGet()
          this.categoryShow = false
        }).finally(() => {
          this.$q.loading.hide()
        })
      }
    },
    listadoGet () {
      this.loading = true
      this.$api.get('listado', { ini: this.fechaIni, fin: this.fechaFin, tipo: this.titulo }).then((response) => {
        this.listado = response.data
        console.log(this.listado)
      }).finally(() => {
        this.loading = false
      })
    },
    exportSales () {
      const data = [
        {
          columns: [
            { label: 'N', value: 'id' },
            { label: 'Nombre', value: 'name' },
            { label: 'Monto', value: 'amount' },
            { label: 'Estado', value: 'status' },
            { label: 'Fecha', value: 'date' },
            { label: 'Hora', value: 'time' }
            // { label: 'Usuario', value: (row) => row.user.name }
          ],
          content: this.inventaries
        }
      ]
      const settings = {
        fileName: 'MySpreadsheet', // Name of the resulting spreadsheet
        extraLength: 3, // A bigger number means that columns will be wider
        writeMode: 'writeFile', // The available parameters are 'WriteFile' and 'write'. This setting is optional. Useful in such cases https://docs.sheetjs.com/docs/solutions/output#example-remote-file
        writeOptions: {} // Style options from https://docs.sheetjs.com/docs/api/write-options
        // RTL: true // Display the columns from right-to-left (the default value is false)
      }
      xlsx(data, settings) // Will download the excel file
    },
    onSubmit () {
      this.loading = true
      this.$api.post('inventories', this.inventary).then((response) => {
        console.log(response)
        this.inventarieDialog = false
        this.categoriesGet()
      }).catch((error) => {
        console.log(error)
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>

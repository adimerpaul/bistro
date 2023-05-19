<template>
  <q-page>
    <div class="row">
      <div class="col-12">
        <q-table title="Categorias" :loading="loading" :rows-per-page-options="[0]" :columns="inventaryColumns" :rows="categories" flat bordered dense :filter="categoryFiltar">
          <template v-slot:header-cell="props">
            <q-th :props="props" class="bg-primary text-white text-center">
              {{ props.col.label }}
            </q-th>
          </template>
          <template v-slot:top-right>
            <q-btn label="Crear Categoria" color="primary" no-caps icon="add_circle_outline" @click="categoryCreate" dense />
            <q-btn flat round icon="refresh" @click="categoriesGet" dense />
            <q-btn flat round icon="o_download" @click="exportSales" dense />
            <q-input outlined dense v-model="categoryFiltar" label="Buscar" class="q-ml-md" clearable>
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body-cell-actions="props">
            <q-td :props="props" auto-width>
              <q-btn-dropdown round dense color="primary" dropdown-icon="more_vert" label="Acciones" no-caps>
                <q-list>
                  <q-item clickable v-close-popup>
                    <q-item-section @click="categoryEdit(props.row)">Editar</q-item-section>
                  </q-item>
                  <q-item clickable v-close-popup>
                    <q-item-section @click="categoryEditPhoto(props.row)">Editar Foto</q-item-section>
                  </q-item>
                  <q-item clickable v-close-popup>
                    <q-item-section @click="categoryDelete(props.row)">Eliminar</q-item-section>
                  </q-item>
                </q-list>
              </q-btn-dropdown>
            </q-td>
          </template>
          <template v-slot:body-cell-imagen="props">
            <q-td :props="props" auto-width @click="showImage(`${$url}../images/${props.row.imagen}`)">
              <div :style="`width: 50px; height: 50px; background-color: ${props.row.color};`">
                <q-img :src="`${$url}../images/${props.row.imagen}`" style="border-radius: 50%" :style="`width: 50px; height: 50px;`" />
              </div>
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
import { globalStore } from '../stores/globalStore'
export default {
  name: 'CategoriesPage',
  data () {
    return {
      store: globalStore(),
      inventarieDialog: false,
      categoryStatus: 'Crear',
      loading: false,
      inventaries: [],
      categoryShow: false,
      shop_id: this.$route.params.id,
      categories: [],
      category: {
        name: '',
        color: '',
        imagen: ''
      },
      users: [],
      categoryFiltar: '',
      inventaryColumns: [
        { name: 'actions', label: 'Acciones', field: 'actions', align: 'left', sortable: false },
        // { name: 'code', label: 'Codigo', field: 'code', align: 'left', sortable: true },
        { name: 'imagen', label: 'Imagen', field: 'image', align: 'left', sortable: true },
        { name: 'name', label: 'Nombre', field: 'name', align: 'left', sortable: true }
        // { name: 'description', label: 'Descripcion', field: 'description', align: 'left', sortable: true }
        // { name: 'price', label: 'Precio', field: 'price', align: 'left', sortable: true },
        // { name: 'quantity', label: 'Cantidad', field: 'quantity', align: 'left', sortable: true },
        // { name: 'category', label: 'Categoria', field: (row) => row.category.name, align: 'left', sortable: true }
        // { name: 'user', label: 'Usuario', field: (row) => row.user == null ? '' : row.user.name, align: 'left', sortable: true }
      ],
      categoryColumns: [
        { name: 'actions', label: 'Acciones', field: 'actions', align: 'left', sortable: false },
        { name: 'id', label: 'Id', field: 'id', align: 'left', sortable: true },
        { name: 'name', label: 'Nombre', field: 'name', align: 'left', sortable: true },
        { name: 'code', label: 'Codigo', field: 'code', align: 'left', sortable: true }
      ]
    }
  },
  mounted () {
    // this.validar()
    this.categoriesGet()
    this.$watch(() => this.$route.params,
      (toParams) => {
        // console.log(previousParams)
        this.shop_id = toParams.id

        this.categoriesGet()
        // this.validar()
      }
    )
  },
  methods: {
    validar () {
      console.log(this.shop_id)
      console.log(this.store.boolrubrovf)
      switch (this.shop_id) {
        case 1:
          if (!this.store.boolrubrosp) {
            this.$router.replace({ path: '/' })
          }
          break
        case 2:
          if (!this.store.boolrubroci) {
            this.$router.replace({ path: '/' })
          }
          break
        case 3:
          if (!this.store.boolrubrovf) {
            this.$router.replace({ path: '/' })
          }
          break
        default:
          this.$router.replace({ path: '/' })
          break
      }
    },
    categoryEditPhoto (category) {
      this.categoryStatus = 'editPhoto'
      this.categoryShow = true
      this.category = category
    },
    categoryEdit (category) {
      this.categoryStatus = 'edit'
      this.categoryShow = true
      this.category = category
    },
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
    showImage (image) {
      this.$q.dialog({
        title: 'Imagen',
        html: true,
        message: `<img src="${image}" style="width: 100%; height: 100%; object-fit: contain" />`,
        cancel: true,
        persistent: true
      })
    },
    errorFn () {
      // console.log(err)
      this.$q.notify({
        color: 'red-4',
        textColor: 'white',
        icon: 'cloud_done',
        position: 'top',
        message: 'Error al subir la imagen, intente nuevamente el nombre no debe contener espacios o ñ'
      })
    },
    uploadingFn (e) {
      e.xhr.onload = () => {
        if (e.xhr.readyState === e.xhr.DONE) {
          if (e.xhr.status === 200) {
            this.category.imagen = e.xhr.response
          }
        }
      }
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
    categoryCreate () {
      this.categoryStatus = 'create'
      this.category = {
        name: '',
        color: '',
        imagen: ''
      }
      this.categoryShow = true
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
    categoriesGet () {
      this.categories = []
      this.loading = true
      this.$api.get('categories/' + this.shop_id).then((response) => {
        this.categories = response.data
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

<style scoped>
</style>

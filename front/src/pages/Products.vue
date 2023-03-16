<template>
  <q-page>
    <div class="row">
      <div class="col-12">
        <q-table title="Productos" :loading="loading" :rows-per-page-options="[0]" :columns="inventaryColumns" :rows="products" flat bordered dense :filter="productFiltar">
          <template v-slot:header-cell="props">
            <q-th :props="props" class="bg-primary text-white text-center">
              {{ props.col.label }}
            </q-th>
          </template>
          <template v-slot:top-right>
            <q-btn label="Crear Producto" color="primary" no-caps icon="add_circle_outline" @click="productCreate" dense />
            <q-btn flat round icon="refresh" @click="productsGet" dense />
            <q-btn flat round icon="o_download" @click="exportSales" dense />
            <q-input outlined dense v-model="productFiltar" label="Buscar" class="q-ml-md" clearable>
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
                    <q-item-section @click="productEdit(props.row)">Editar</q-item-section>
                  </q-item>
                  <q-item clickable v-close-popup>
                    <q-item-section @click="productEditPhoto(props.row)">Editar Foto</q-item-section>
                  </q-item>
                  <q-item clickable v-close-popup>
                    <q-item-section @click="productDelete(props.row)">Eliminar</q-item-section>
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
    <q-dialog v-model="productShow">
      <q-card>
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">{{ productStatus== 'create' ? 'Crear Categoria' : 'Editar Categoria' }}</div>
          <q-space />
          <q-btn flat icon="close" v-close-popup />
        </q-card-section>
        <q-card-section>
          <q-form @submit.prevent="productSubmit" ref="myForm">
            <div class="row">
              <div class="col-12 col-md-12">
                <q-input v-if="productStatus == 'edit' || productStatus == 'create'" outlined dense v-model="product.name" label="Nombre" hint="" :rules="[val => val.length > 0 || 'El nombre es requerido']" />
              </div>
              <div class="col-12 col-md-12">
                <q-input v-if="productStatus == 'edit' || productStatus == 'create'" outlined dense v-model="product.price" label="Precio" hint="" :rules="[val => val > 0 || 'El precio es requerido']" />
              </div>
              <div class="col-12 col-md-12">
                <q-select v-if="productStatus == 'edit' || productStatus == 'create'" outlined dense v-model="category" label="Categoria" hint="" :options="categories"  />
              </div>
              <div class="col-12 col-md-12 flex flex-center">
                <q-color v-if="productStatus == 'edit' || productStatus == 'create'" v-model="product.color" default-view="palette" style="max-width: 150px" />
              </div>
              <div class="col-12 col-md-12 flex flex-center">
                <q-uploader
                  v-if="productStatus == 'create' || productStatus == 'editPhoto'"
                  accept=".jpg, .png"
                  multiple
                  auto-upload
                  label="Arrastra una imagen o haz click para seleccionar"
                  @uploading="uploadingFn"
                  ref="uploader"
                  @failed="errorFn"
                  max-files="1"
                  auto-expand
                  :url="productStatus=='create'?`${$url}upload/create/1`:`${$url}upload/editproduct/${product.id}`"
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
export default {
  name: 'ProductsPage',
  data () {
    return {
      inventarieDialog: false,
      productStatus: 'Crear',
      loading: false,
      inventaries: [],
      categories: [],
      category: {},
      productShow: false,
      shop_id: this.$route.params.id,
      products: [],
      product: {
        name: '',
        color: '',
        imagen: ''
      },
      users: [],
      productFiltar: '',
      inventaryColumns: [
        { name: 'actions', label: 'Acciones', field: 'actions', align: 'left', sortable: false },
        { name: 'imagen', label: 'Imagen', field: 'imagen', align: 'left', sortable: true },
        { name: 'name', label: 'Nombre', field: 'name', align: 'left', sortable: true },
        { name: 'category', label: 'Categoria', field: row => row.category.name, sortable: true },
        { name: 'price', label: 'Precio', field: 'price', align: 'left', sortable: true },
        { name: 'cantidad', label: 'Cantidad', field: 'cantidad', align: 'left', sortable: true }
        // { name: 'product', label: 'Categoria', field: (row) => row.product.name, align: 'left', sortable: true }
        // { name: 'user', label: 'Usuario', field: (row) => row.user == null ? '' : row.user.name, align: 'left', sortable: true }
      ],
      productColumns: [
        { name: 'actions', label: 'Acciones', field: 'actions', align: 'left', sortable: false },
        { name: 'id', label: 'Id', field: 'id', align: 'left', sortable: true },
        { name: 'name', label: 'Nombre', field: 'name', align: 'left', sortable: true },
        { name: 'code', label: 'Codigo', field: 'code', align: 'left', sortable: true }
      ]
    }
  },
  created () {
    this.productsGet()
    this.categoriesGet()
    this.$watch(
      () => this.$route.params,
      (toParams) => {
        // console.log(previousParams)
        this.shop_id = toParams.id
        this.categoriesGet()
        this.productsGet()
      }
    )
  },
  methods: {
    categoriesGet () {
      this.categories = []
      this.loading = true
      this.$api.get('categories/' + this.shop_id).then((response) => {
        response.data.forEach(d => {
          d.label = d.name
          this.categories.push(d)
        })
      //  this.categories = response.data
      }).finally(() => {
        this.loading = false
      })
    },
    productEditPhoto (product) {
      this.productStatus = 'editPhoto'
      this.productShow = true
      this.product = product
    },
    productEdit (product) {
      this.productStatus = 'edit'
      this.productShow = true
      this.category = product.category
      this.product = product
    },
    productDelete (product) {
      this.$q.dialog({
        title: 'Eliminar Categoria',
        message: '¿Estas seguro de eliminar esta categoria?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.loading = true
        this.$api.delete(`products/${product.id}`)
          .then(() => {
            this.productsGet()
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
            this.product.imagen = e.xhr.response
          }
        }
      }
    },
    deleteproduct (product) {
      this.$q.dialog({
        title: 'Eliminar',
        message: '¿Estas seguro de eliminar esta categoria?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$q.loading.show()
        this.$api.delete('products/' + product.id).then(() => {
          this.productsGet()
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
    productCreate () {
      this.productStatus = 'create'
      this.product = {
        name: '',
        price: 0,
        cantidad: 0,
        color: '',
        imagen: '',
        estado: 'ACTIVO'
      }
      this.category = this.categories[0]
      this.productShow = true
    },
    productSubmit () {
      this.$q.loading.show()
      this.product.category_id = this.category.id
      this.product.shop_id = this.shop_id
      if (this.productStatus === 'create') {
        this.$api.post('products', this.product).then(() => {
          this.productsGet()
          this.productShow = false
        }).finally(() => {
          this.$q.loading.hide()
        })
      } else {
        this.$api.put('products/' + this.product.id, this.product).then(() => {
          this.productsGet()
          this.productShow = false
        }).finally(() => {
          this.$q.loading.hide()
        })
      }
    },
    productsGet () {
      this.products = []
      this.loading = true
      this.$api.get('products/' + this.shop_id).then((response) => {
        this.products = response.data
        console.log(this.products)
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
        this.productsGet()
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

<template>
  <div class="row">
    <div class="col-12 col-sm-7">
      <q-badge label="Categoria" class="text-bold full-width text-center"/>
      <div class="row">
        <div class="col-2" v-for="c in categories" :key="c.id">
          <q-card @click="clickCategoria(c)" :style="`cursor: pointer;background: ${c.color}`">
            <q-tooltip>
              {{c.name}}
            </q-tooltip>
            <q-img :src="$url+'../images/'+c.imagen" width="100%" height="100px">
              <div class="absolute-bottom text-subtitle2 text-center" style="padding: 0px;margin:0px;border: 0px">
                <div class="q-pa-none q-ma-none" >
                  <div class="subtitule-text">{{c.name}}</div>
                </div>
              </div>
            </q-img>
          </q-card>
        </div>
      </div>
      <q-badge label="Productos" class="text-bold full-width text-center"/>
      <div class="row">
        <div class="col-2" v-for="p in products" :key="p.id">
          <q-card @click="addProductsSale(p)" style="cursor: pointer">
            <q-tooltip>
              {{p.name}}
            </q-tooltip>
            <q-img :style="`cursor: pointer;background: ${p.color}`" :src="$url+'../images/'+ (p.imagen==''||p.imagen==null||p.imagen==undefined?'default.png':p.imagen)" width="100%" height="100px">
              <q-btn v-if="p.cantidadPedida==0" style="top: 0px; right: 0px;background: rgba(255,255,255,0.5);border: 1px solid black;cursor: pointer" size="10px" class="absolute all-pointer-events" icon="add_circle_outline" dense/>
              <q-btn v-else :label="p.cantidadPedida" style="top: 0px; right: 0px;background: rgba(255,255,0,0.5);border: 1px solid black;cursor: pointer" size="10px" class="absolute all-pointer-events" icon="o_shopping_basket" dense/>
              <div class="absolute-bottom text-subtitle2 text-center" style="padding: 0px;margin:0px;border: 0px">
                  <div class="q-pa-none q-ma-none" >
                    <div class="subtitule-text">{{p.name}}</div>
                  </div>
              </div>
            </q-img>
            <q-card-section class="q-pa-none q-ma-none">
              <div class="text-center text-subtitle2">{{ p.price }} Bs</div>
              <div :class="p.cantidad<=0?'text-center text-bold text-red':' text-center text-bold'">{{ p.cantidad }} {{ $q.screen.lt.md?'Dis':'Disponible' }}</div>
            </q-card-section>
          </q-card>
        </div>
    </div>
    </div>
    <div class="col-12 col-sm-5">
      <q-card>
        <q-card-section class="q-pa-none q-ma-none ">
          <div class="row">
            <div class="col-6 text-h6 q-pt-xs q-pl-lg">Canasta</div>
            <div class="col-6 text-right"><q-btn class="text-subtitle1 text-blue-10 text-bold" style="text-decoration: underline;" label="Vaciar canasta" @click="vaciarCanasta" no-caps flat outline/></div>
          </div>
        </q-card-section>
        <q-separator></q-separator>
        <q-card-section class="q-pa-none q-ma-none" >
          <div v-if="productsSale.length==0" class="flex flex-center q-pa-lg">
            <q-icon name="o_shopping_basket" color="grey" size="100px"/>
            <div class="q-pa-lg text-grey text-center noSelect">
              A??n no tienes productos en tu canasta. Haz clic sobre un producto para agregarlo.
            </div>
          </div>
          <q-scroll-area v-else style="height: 400px;">
            <q-table dense flat bordered hide-bottom hide-header :rows="productsSale" :columns="columnsProductosVenta" :rows-per-page-options="[0]">
              <template v-slot:body="props">
                <q-tr :props="props">
                  <q-td key="borrar" auto-width :props="props">
                    <q-icon @click="deleteProductosVenta(props.row,props.pageIndex)" name="delete_outline" color="red" size="25px" />
                  </q-td>
                  <q-td key="nombre" :props="props">
                    <div class="row">
                      <div class="col-3">
                        <q-img :src="$url+'../images/' + (props.row.imagen==null||props.row.imagen==''?'default.png':props.row.imagen)" width="40px" height="80px" />
                      </div>
                      <div class="col-9">
                        <div class="subtitule-text" style="color: black">{{props.row.name}}</div>
                        <div class="text-grey">Disponible: {{props.row.cantidad}}</div>
                      </div>
                    </div>
                  </q-td>
                  <q-td key="cantidadVenta" :props="props" width="150px">
                    <q-input dense outlined bottom-slots min="1" v-model="props.row.cantidadVenta" @update:model-value="cambioNumero(props.row,props.pageIndex)" :rules="ruleNumber" input-class="text-center" required placeholder="Escribe el nombre del producto">
                      <template v-slot:prepend>
                        <q-icon style="cursor: pointer" name="remove_circle_outline" @click="removeCantidad(props.row,props.pageIndex)"/>
                      </template>
                      <template v-slot:append>
                        <q-icon style="cursor: pointer" name="add_circle_outline" @click="addCantidad(props.row,props.pageIndex)"/>
                      </template>
                    </q-input>
                    <div class="text-grey">= Bs {{props.row.cantidadVenta*props.row.precioVenta}}</div>
                  </q-td>
                </q-tr>
              </template>
            </q-table>
          </q-scroll-area>
        </q-card-section>
        <q-card-section >
          <q-list padding bordered dense class="rounded-borders full-width q-pa-none q-ma-none">
            <q-expansion-item
              dense
              dense-toggle
              expand-separator
              label="Total"
            >
              <template v-slot:header>
                <q-item-section>
                  Total
                </q-item-section>
                <q-item-section side>
                  <div class="text-right text-grey-8 text-bold"> <u> Bs {{total}}</u></div>
                </q-item-section>
              </template>
              <q-card>
                <q-card-section>
                  <div class="row">
                    <div class="col-7 text-grey">Cantidades de referencia</div>
                    <div class="col-5 text-right">{{productsSale.length}}</div>
                    <div class="col-7 text-grey">
                      Ganancia
                      <q-icon name="o_info">
                        <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
                          Para calcular la ganancia correctamente, deber??s cargar el costo unitario de todos los productos desde tu Inventario.
                        </q-tooltip>
                      </q-icon>
                    </div>
                    <div class="col-5 text-right text-green">0 Bs</div>
                  </div>
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-list>
          <q-btn @click="clickSale" class="full-width" no-caps label="Confirmar venta" :color="productsSale.length==0?'grey':'warning'" :disable="productsSale.length==0?true:false"/>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SalesPage',
  data () {
    return {
      products: [],
      product: {},
      productsSale: [],
      categories: [],
      category: {},
      shop_id: this.$route.params.id,
      ruleNumber: [
        val => val > 0 || 'El n??mero debe ser mayor a 0'
      ],
      columnsProductosVenta: [
        { label: 'borrar', field: 'borrar', name: 'borrar', align: 'left' },
        { label: 'nombre', field: 'nombre', name: 'nombre', align: 'left' },
        { label: 'cantidadVenta', field: 'cantidadVenta', name: 'cantidadVenta' }
      ]
    }
  },
  created () {
    this.categoriesGet()
    this.$watch(
      () => this.$route.params,
      (toParams) => {
        // console.log(previousParams)
        this.shop_id = toParams.id
        this.productsSale = []
        this.categoriesGet()
      }
    )
  },
  methods: {
    vaciarCanasta () {
      this.productsSale = []
      this.productsGet()
    },
    addProductsSale (p) {
      p.cantidadPedida++
      p.cantidad--
      const producto = this.productsSale.find(pv => pv.id === p.id)
      if (producto === undefined) {
        p.cantidadVenta = 1
        p.precioVenta = p.price
        this.productsSale.push(p)
      } else {
        producto.cantidad = p.cantidad
        producto.cantidadVenta++
      }
    },
    categoriesGet () {
      this.categories = []
      this.$api.get('categories/' + this.shop_id).then(response => {
        this.categories = response.data
        this.category = this.categories[0]
        this.productsGet()
      }).catch(error => {
        console.log(error)
      })
    },
    productsGet () {
      this.products = []
      this.$api.get('productSFilter/' + this.category.id).then(response => {
        response.data.forEach(p => {
          p.cantidadPedida = 0
        })
        this.products = response.data
        this.product = this.products[0]
      }).catch(error => {
        console.log(error)
      })
    },
    clickCategoria (category) {
      this.category = category
      this.productsGet()
    },
    deleteProductosVenta (product, pageIndex) {
      this.productsSale.splice(pageIndex, 1)
    },
    addCantidad (product, pageIndex) {
      product.cantidadVenta++
      this.productsSale.splice(pageIndex, 1, product)
    },
    removeCantidad (product, pageIndex) {
      if (product.cantidadVenta > 1) {
        product.cantidadVenta--
        this.productsSale.splice(pageIndex, 1, product)
      }
    },
    cambioNumero (product, pageIndex) {
      if (product.cantidadVenta < 1) {
        product.cantidadVenta = 1
      }
      this.productsSale.splice(pageIndex, 1, product)
    },
    precioVenta (product) {
      if (product.precioVenta < 1) {
        product.precioVenta = 1
      }
    },
    clickSale () {
      this.$axios.post('sales', this.productsSale).then(() => {
        this.$q.notify({
          message: 'Venta realizada con ??xito',
          color: 'positive',
          icon: 'check_circle',
          position: 'top'
        })
        this.productsSale = []
      }).catch(error => {
        console.log(error)
      })
    }
  },
  computed: {
    total () {
      let total = 0
      this.productsSale.forEach(product => {
        total += product.cantidadVenta * product.precioVenta
      })
      return total
    }
  }
}
</script>

<style scoped>
.subtitule-text{
  font-size: 12px;
  line-height: 1;
  color: #fff;
}
</style>

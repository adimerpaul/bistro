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
              Aún no tienes productos en tu canasta. Haz clic sobre un producto para agregarlo.
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
                          Para calcular la ganancia correctamente, deberás cargar el costo unitario de todos los productos desde tu Inventario.
                        </q-tooltip>
                      </q-icon>
                    </div>
                    <div class="col-5 text-right text-green">0 Bs</div>
                  </div>
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-list>
          <q-btn @click="icon = true;tienerebaja=false; booltarjeta=false; tarjeta=false;" class="full-width" no-caps label="Confirmar venta" :color="productsSale.length==0?'grey':'warning'" :disable="productsSale.length==0?true:false"/>
        </q-card-section>
      </q-card>
    </div>

    <q-dialog v-model="icon" full-width persistent>
      <q-card style="width: 700px; max-width: 80vw;">
        <q-card-section class="row items-center q-pa-xs bg-green-14 text-white">
          <div class="text-h6"> <q-icon name="send"></q-icon> Realizar venta</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>
        <q-card-section>
          <div class="row">
            <div class="col-12">
              <q-form
                @submit.prevent="saleInsert"
                class="q-gutter-md"
              >
                <div class="row">
                  <div class="col-2">
                    <q-input required @keyup="searchClient" outlined v-model="client.numeroDocumento" label="CI / NIT *"  hint="Carnet o nit" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato obligatorio']" />
                  </div>
                  <div class="col-2">
                    <q-input @keyup="searchClient" outlined v-model="client.complemento" label="COMPLEMENTO" />
                  </div>
                  <div class="col-3">
                    <q-input required outlined v-model="client.nombreRazonSocial" label="Nombre y razon *" hint="Razon social" style="text-transform: uppercase" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato obligatorio']" />
                  </div>
                  <div class="col-3">
                    <q-select v-model="document" outlined :options="documents" @update:model-value="validarnit"/>
                  </div>
                  <div class="col-2">
                    <q-input outlined v-model="client.email" label="Email" type="email" />
                  </div>
                  <div class="col-3 q-pa-xs">
                    <q-input required outlined disable v-model="total" label="Total*" lazy-rules />
                  </div>
                  <div class="col-3 q-pa-xs">
                    <q-input v-model="efectivo" outlined label="Monto recibido" />
                  </div>
                  <div class="col-3 q-pa-xs">
                    <q-input outlined disable label="Cambio" v-model="cambio" />
                  </div>
                  <div class="row col-3">
                    <!--<q-checkbox v-model="credito"  label="T Credito" dense/>
                    <q-checkbox  v-model="booltarjeta"  label="T VIP" dense @click="verificar"/>-->
                  </div>
                  <div class="col-12">
                  <template v-if="booltarjeta">
                      <q-form @submit.prevent="consultartarjeta">
                      <div class="row">
                      <div class="col-6"><q-input outlined label="Codigo" v-model="codigo"  @keyup="consultartarjeta"/></div>
                      <div class="col-6"><q-banner >Saldo :{{nombresaldo.saldo}} -- {{nombresaldo.nombre}}</q-banner></div>
                    </div>
                    </q-form>
                  </template>
                </div>
              </div>
                <div>
                  <q-btn  label="venta" :loading="loading" icon="send" type="submit" color="positive" :disable="btn"/>
                  <q-btn label="Cerrar" :loading="loading" type="button" size="md" icon="delete" color="negative" class="q-ml-sm" @click="cancelarVenta" />
                </div>
              </q-form>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>

  </div>
</template>

<script>
export default {
  name: 'SalesPage',
  data () {
    return {
      loading: false,
      icon: false,
      products: [],
      client: {},
      product: {},
      productsSale: [],
      documents: [],
      document: {},
      categories: [],
      category: {},
      cine: {},
      efectivo: '',
      shop_id: this.$route.params.id,
      ruleNumber: [
        val => val > 0 || 'El número debe ser mayor a 0'
      ],
      columnsProductosVenta: [
        { label: 'borrar', field: 'borrar', name: 'borrar', align: 'left' },
        { label: 'nombre', field: 'nombre', name: 'nombre', align: 'left' },
        { label: 'cantidadVenta', field: 'cantidadVenta', name: 'cantidadVenta' }
      ]
    }
  },
  created () {
    this.encabezado()
    this.cargarLeyenda()
    this.$api.get('document').then(res => {
      res.data.forEach(r => {
        r.label = r.descripcion
      })
      this.documents = res.data
      this.document = this.documents[0]
    })
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
    validarnit () {
      if (this.document === this.documents[4]) {
        this.$api.get('validanit/' + this.client.numeroDocumento).then(res => {
          console.log(res.data)
          this.$q.notify({
            message: res.data.RespuestaVerificarNit.mensajesList.descripcion,
            color: 'teal',
            icon: 'info'
          })
        })
      }
    },
    cancelarVenta () {
      this.codigo = ''
      this.booltarjeta = false
      this.nombresaldo = {}
      this.icon = false
      this.verificar()
    },
    searchClient () {
      // console.log(this.client)
      this.document = this.documents[0]
      this.client.nombreRazonSocial = ''
      this.client.email = ''
      this.client.id = undefined
      this.$api.post('searchClient', this.client).then(res => {
        // console.log(res.data)
        if (res.data.nombreRazonSocial !== undefined) {
          this.client.nombreRazonSocial = res.data.nombreRazonSocial
          this.client.email = res.data.email
          this.client.id = res.data.id
          const documento = this.documents.find(r => r.codigoClasificador === res.data.codigoTipoDocumentoIdentidad)
          documento.label = documento.descripcion
          this.document = documento
        }
        if (this.document.codigoClasificador === 5) this.validarnit()
      })
    },
    encabezado () {
      this.$api.get('datocine/' + this.shop_id).then(res => {
        this.cine = res.data
        // console.log(this.cine)
      })
    },
    cargarLeyenda () {
      this.$api.post('listleyenda', { codigo: '561120' }).then(res => {
        // console.log(res.data)
        this.leyendas = res.data
      })
    },
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
      product.cantidadPedida = product.cantidadVenta
    },
    removeCantidad (product, pageIndex) {
      if (product.cantidadVenta > 1) {
        product.cantidadVenta--
        this.productsSale.splice(pageIndex, 1, product)
        product.cantidadPedida = product.cantidadVenta
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
    saleInsert () {
      this.$axios.post('sales', this.productsSale).then(() => {
        this.$q.notify({
          message: 'Venta realizada con éxito',
          color: 'positive',
          icon: 'check_circle',
          position: 'top'
        })
        this.productsSale = []
      }).catch(error => {
        console.log(error)
      })
      this.error = ''
      this.loading = true
      this.client.codigoTipoDocumentoIdentidad = this.document.codigoClasificador
      this.client.email = this.client.email === undefined ? '' : this.client.email
      this.$api.post('salecandy', {
        client: this.client,
        montoTotal: this.total,
        detalleVenta: this.productsSale,
        tarjeta: this.credito ? 'SI' : 'NO',
        codigoTarjeta: this.codigo,
        vip: this.booltarjeta ? 'SI' : 'NO'
      }).then(res => {
        this.reset()
        if (res.data.sale.siatEnviado === 1) {
          this.printFactura(res.data.sale)
        }
        this.printComanda(res.data.sale)
        this.icon = false
        // console.log(res.data)
        this.loading = false
      }).catch(err => {
        console.log(err)
        this.loading = false
        this.$q.notify({
          color: 'negative',
          textColor: 'white',
          message: err.message,
          position: 'top',
          timeout: 5000
        })
      })
    }
  },
  computed: {
    cambio () {
      const cambio = parseFloat(this.efectivo === '' ? 0 : this.efectivo) - parseFloat(this.total)
      return Math.round(cambio * 100) / 100
    },
    total () {
      let total = 0
      this.productsSale.forEach(product => {
        total += product.cantidadVenta * product.precioVenta
      })
      return total.toFixed(2)
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

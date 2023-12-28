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
    <q-dialog v-model="dialog_pedido">
    <q-card style="width: 700px; max-width: 80vw;">
    <q-card-section>
    <div class="text-h6">PEDIDOS</div>
      <q-form @submit="consultarOrder" class="q-gutter-md" >
        <div class="row">
          <div class="col-8"><q-input dense  type='date' outlined="" v-model="fecha" label="Fecha" lazy-rules :rules="[ val => val && val.length > 0 || 'ingrese Fecha']" /></div>
          <div class="col-4 text-center"><q-btn dense label="Buscar" type="submit" color="info" icon="search"/></div>
          </div>
      </q-form>
        </q-card-section>
    <q-card-section>
    <q-table dense :rows="orders" :columns="columnsOrder" row-key="name" :rows-per-page-options="[0]" wrap-cells>
      <template v-slot:body-cell-op="props">
        <q-td :props="props" auto-width >
          <q-btn-group>
            <span class="text-grey">{{props.row.id}}</span>
            <q-btn dense color="green" icon="fact_check" v-if="props.row.status=='PENDIENTE'" @click="datoPedido(props.row)" label="Vent" no-caps> <q-tooltip>Realizar Venta</q-tooltip></q-btn>
            <q-btn dense color="info" icon="print" v-if="props.row.status=='PENDIENTE'" @click="printOrder(props.row)" label="Impr" no-caps> <q-tooltip>Reimpresion</q-tooltip></q-btn>
            <q-btn dense color="red" icon="cancel" v-if="props.row.status=='PENDIENTE'" label="Can" no-caps @click="cancelOrder(props.row)"> <q-tooltip>Cancelar Pedido</q-tooltip></q-btn>
          </q-btn-group>
        </q-td>
      </template>
      <template v-slot:body-cell-status="props">
        <q-td :props="props" auto-width>
          <q-badge :color="props.row.status=='PENDIENTE'?'amber-9':props.row.status=='REALIZADO'?'green':'red'"  :label="props.row.status" />
        </q-td>
      </template>
      <template v-slot:body-cell-mesa="props">
        <q-td :props="props" auto-width>
          <q-badge :label="props.row.mesa" />
        </q-td>
      </template>
      <template v-slot:body-cell-detalle="props">
        <q-td :props="props" auto-width>
          <span v-for="d in props.row.detailorders " :key="d">{{d.cantidad}} {{d.producto}} ;</span>
        </q-td>
      </template>
    </q-table>
    </q-card-section>
    <q-card-actions align="right">
    <q-btn flat label="OK" color="primary" v-close-popup />
    </q-card-actions>
    </q-card>
    </q-dialog>
    <div class="col-12 col-sm-5">
      <q-card>
        <q-card-section class="q-pa-none q-ma-none ">
          <div class="row">
            <div class="col-4 text-h6 q-pt-xs q-pl-lg">Canasta</div>
            <div class="col-4 text-h6 q-pt-xs q-pl-lg">
              <q-btn outline @click="cargarPedido"  color="light-green-10" :label="'PEDIDOS:'+ pedidoTotal " v-if="shop_id==2">
                <q-badge color="red" floating>{{pedidoTotal}}</q-badge>
              </q-btn>
            </div>
            <div class="col-4 text-right"><q-btn class="text-subtitle1 text-blue-10 text-bold" style="text-decoration: underline;" label="Vaciar canasta" @click="vaciarCanasta" no-caps flat outline/></div>
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
                    <div class="text-grey">= Bs {{props.row.subtotal}}</div>
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
          <q-btn @click="icon = true;tienerebaja=false; booltarjeta=false; booltarjeta=false;" class="full-width" no-caps label="Confirmar venta" :color="productsSale.length==0?'grey':'warning'" :disable="productsSale.length==0?true:false"/>
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
                    <q-checkbox v-model="boolcredito"  label="T Credito" dense/>
                    <q-checkbox v-model="booltarjeta"  label="T VIP" dense @click="verificar" v-if="shop_id!=='3'"/>
                  </div>
                  <div class="col-12" v-if="shop_id!=='3'">
                  <template v-if="booltarjeta" >
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
    <div id="myelement" class="hidden"></div>
  </div>
</template>

<script>
import { io } from 'socket.io-client'
const socket = io(import.meta.env.VITE_API_SOCKET)
import { Printd } from 'printd'
import conversor from 'conversor-numero-a-letras-es-ar'
import QRCode from 'qrcode'
import { date } from 'quasar'
export default {
  name: 'SalesPage',
  data () {
    return {
      orders: [],
      dialog_pedido: false,
      fecha: date.formatDate(new Date(), 'YYYY-MM-DD'),
      numpedido: 0,
      opts: {
        errorCorrectionLevel: 'M',
        type: 'png',
        quality: 0.95,
        width: 100,
        margin: 1,
        color: {
          dark: '#000000',
          light: '#FFF'
        }
      },
      tienerebaja: false,
      boolcredito: false,
      booltarjeta: false,
      nombresaldo: {},
      loading: false,
      btn: false,
      icon: false,
      products: [],
      client: { complemento: '' },
      product: {},
      productsSale: [],
      documents: [],
      document: {},
      categories: [],
      category: {},
      cine: {},
      efectivo: '',
      tipo: ['SABOR PERU', 'CAFE ITALIA', 'VACA FRIA'],
      shop_id: this.$route.params.id,
      ruleNumber: [
        val => val > 0 || 'El número debe ser mayor a 0'
      ],
      columnsProductosVenta: [
        { label: 'borrar', field: 'borrar', name: 'borrar', align: 'left' },
        { label: 'nombre', field: 'nombre', name: 'nombre', align: 'left' },
        { label: 'cantidadVenta', field: 'cantidadVenta', name: 'cantidadVenta' }
      ],
      columnsOrder: [
        { label: 'Opciones', field: 'op', name: 'op', align: 'left' },
        { label: 'Mesa', field: 'mesa', name: 'mesa', align: 'left' },
        { label: 'Estado', field: 'status', name: 'status', align: 'left' },
        { label: 'Detalle', field: 'detalle', name: 'detalle', align: 'left' }
      ]
    }
  },
  created () {
    // this.$store.boolSocket = true
    // console.log('boolSocket: ', this.$store.boolSocket)
    // console.log('url_socket: ', import.meta.env.VITE_API_SOCKET)
    if (this.$store.boolSocket !== true) {
      socket.on('connect', () => {
        console.log('conectado')
      })
      socket.on('disconnect', () => {
        console.log('desconectado')
      })
      socket.on('order', (data) => {
        // console.log(data)
        // console.log('nuevo pedido')
        // // this.consultarOrder()
        // console.log('shop_id: ', this.shop_id)
        if (parseInt(this.shop_id) === 2) {
          if (data.detailArray !== undefined) {
            this.printOrder(data.order)
            this.$q.notify({
              message: 'Pedido nuevo',
              color: 'teal',
              icon: 'info',
              position: 'top-right'
            })
            this.consultarOrder()
          } else {
            this.printOrderAummentado(data.order, data.detailArray)
            this.$q.notify({
              message: 'Pedido Aumentado',
              color: 'red',
              icon: 'info',
              position: 'top-right'
            })
            this.consultarOrder()
          }
        }
      })
      this.$store.boolSocket = true
    }
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
    this.consultarOrder()
  },
  methods: {
    datoPedido (pedido) {
      this.productsSale = []
      pedido.detailorders.forEach(e => {
        const producto = e.product
        producto.cantidadVenta = e.cantidad
        producto.cantidadPedida = e.cantidad
        producto.precioVenta = e.precio
        producto.product_id = e.product_id
        producto.nombre = e.producto
        producto.precio = e.precio
        producto.subtotal = parseFloat(e.precio) * parseFloat(e.cantidad)
        producto.cantidad = e.cantidad
        this.productsSale.push(producto)
      })
      this.icon = true
      this.tienerebaja = false
      this.booltarjeta = false
      this.booltarjeta = false
      this.numpedido = pedido.id
    },
    cargarPedido () {
      this.numpedido = 0
      this.fecha = date.formatDate(new Date(), 'YYYY-MM-DD')
      this.consultarOrder()
      this.dialog_pedido = true
    },
    consultarOrder () {
      this.$api.post('buscarOrder', { fecha: this.fecha }).then(res => {
        this.orders = res.data
        // const m = this.orders.find((ord) => ord.reimprimir === 0)
      })
    },
    consultartarjeta () {
      if (this.codigo !== '' || this.codigo !== undefined) {
        this.nombresaldo = ''
        this.codigo = this.codigo.replaceAll(' ', '')
        if (this.tienerebaja) {
          this.productsSale.forEach(r => {
            r.precioVenta = (1.25 * r.precioVenta).toFixed(2)
            r.subtotal = (1.25 * r.subtotal).toFixed(2)
          })
          this.btn = false
          this.tienerebaja = false
        }
        this.$api.get('validarTarjeta/' + this.codigo).then(res => {
          console.log(res.data)
          this.$q.loading.hide()
          if (res.data === '0' || res.data === '') { /* empty */ } else {
            this.nombresaldo = res.data
            if (!this.tienerebaja) {
              this.productsSale.forEach(r => {
                r.precioVenta = (0.8 * r.precioVenta).toFixed(2)
                r.subtotal = (0.8 * r.subtotal).toFixed(2)
              })
              this.tienerebaja = true
              if (parseFloat(this.total) <= parseFloat(this.nombresaldo.saldo)) {
                this.btn = false
              } else {
                this.btn = true
              }
            }
          }
        })
      }
    },

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
    verificar () {
      // this.codigo = ''
      this.nombresaldo = ''
      if (!this.booltarjeta) {
        if (this.tienerebaja) {
          this.productsSale.forEach(r => {
            r.precioVenta = (1.25 * r.precioVenta).toFixed(2)
            r.subtotal = (1.25 * r.subtotal).toFixed(2)
          })
          this.btn = false
          this.tienerebaja = false
        }
      }
    },
    searchClient () {
      if (this.client.numeroDocumento.length >= 1) {
        this.document = this.documents[0]
        this.client.nombreRazonSocial = ''
        this.client.email = ''
        this.client.id = undefined
        this.$api.post('searchClient', this.client).then(res => {
          console.log(res.data)
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
      }
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
      this.numpedido = 0
      this.productsSale = []
      this.productsGet()
    },
    addProductsSale (p) {
      // p.cantidadPedida++
      // p.cantidadVenta++
      p.cantidad--
      const productSale = p
      const producto = this.productsSale.find(pv => pv.id === p.id)
      if (producto === undefined) {
        productSale.cantidadVenta = 1
        productSale.cantidadPedida = 1
        productSale.precioVenta = p.price
        productSale.product_id = p.id
        productSale.nombre = p.name
        productSale.precio = p.price
        productSale.subtotal = p.price
        productSale.cantidad = 1
        this.productsSale.push(p)
      } else {
        // producto.cantidad++
        producto.cantidadVenta++
        producto.cantidadPedida++
        producto.subtotal = producto.cantidadVenta * producto.precio
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
      product.subtotal = product.cantidadVenta * product.precio
    },
    removeCantidad (product, pageIndex) {
      if (product.cantidadVenta > 1) {
        product.cantidadVenta--
        this.productsSale.splice(pageIndex, 1, product)
        product.cantidadPedida = product.cantidadVenta
        product.subtotal = product.cantidadVenta * product.precio
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
    reset () {
      this.client = { complemento: '' }
      this.productsSale = []
      this.efectivo = ''
      this.numpedido = 0
      this.productsGet()
    },
    async printFactura (factura) {
      // console.log(factura)
      this.facturadetalle = factura
      const ClaseConversor = conversor.conversorNumerosALetras
      const miConversor = new ClaseConversor()
      const a = miConversor.convertToText(parseInt(factura.montoTotal))
      this.qrImage = await QRCode.toDataURL(this.cine.url2 + 'consulta/QR?nit=' + this.cine.nit + '&cuf=' + factura.cuf + '&numero=' + factura.numeroFactura + '&t=2', this.opts)
      // eslint-disable-next-line no-multi-str
      let cadena = "<style>\
      .titulo{\
      font-size: 12px;\
      text-align: center;\
      font-weight: bold;\
      }\
      .titulo2{\
      font-size: 10px;\
      text-align: center;\
      }\
            .titulo3{\
      font-size: 10px;\
      text-align: center;\
      width:70%;\
      }\
            .contenido{\
      font-size: 10px;\
      text-align: left;\
      }\
      .conte2{\
      font-size: 10px;\
      text-align: right;\
      }\
      .titder{\
      font-size: 12px;\
      text-align: right;\
      font-weight: bold;\
      }\
      hr{\
  border-top: 1px dashed   ;\
}\
  table{\
    width:100%\
  }\
  h1 {\
    color: black;\
    font-family: sans-serif;\
  }</style>\
    <div id='myelement' style='padding-left: 0.5cm;padding-right: 0.5cm'>\
      <div class='titulo'>FACTURA <br>CON DERECHO A CREDITO FISCAL</div>\
      <div class='titulo2'>" + this.cine.razon + '<br>Casa Matriz<br>No. Punto de Venta ' + factura.codigoPuntoVenta + '<br>' + this.cine.direccion.substring(0, 38) + '<br>' + this.cine.direccion.substring(38) + '<br>Tel. ' + this.cine.telefono + "<br>Oruro</div><hr><div class='titulo'>NIT</div><div class='titulo2'>" + this.cine.nit + "</div><div class='titulo'>FACTURA N°</div><div class='titulo2'>" + factura.numeroFactura + "</div><div class='titulo'>CÓD. AUTORIZACIÓN</div><div class='titulo2 ' >" + factura.cuf.substring(0, 41) + '<br>' + factura.cuf.substring(41) + "</div><hr><table><tr><td class='titder'>NOMBRE/RAZÓN SOCIAL:</td><td class='contenido'>" + factura.client.nombreRazonSocial + "</td></tr><tr><td class='titder'>NIT/CI/CEX:</td><td class='contenido'>" + factura.client.numeroDocumento + "</td></tr><tr><td class='titder'>COD. CLIENTE:</td ><td class='contenido'>" + factura.client.id + "</td></tr><tr><td class='titder'>FECHA DE EMISIÓN:</td><td class='contenido'>" + factura.fechaEmision + "</td></tr></table><hr><div class='titulo'>DETALLE</div>"
      factura.details.forEach(r => {
        cadena += "<div style='font-size: 12px'><b>" + r.product_id + ' - ' + r.descripcion + '</b></div>'
        cadena += '<div>' + r.cantidad + '  ' + parseFloat(r.precioUnitario).toFixed(2) + " 0.00<span style='float:right'>" + parseFloat(r.subTotal).toFixed(2) + '</span></div>'
      })
      // eslint-disable-next-line no-multi-str
      cadena += "<hr>\
      <table style='font-size: 8px;'>\
      <tr><td class='titder' style='width: 60%'>SUBTOTAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + "</td></tr><tr><td class='titder'>DESCUENTO Bs</td><td class='conte2'>0.00</td></tr><tr><td class='titder'>TOTAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + "</td></tr><tr><td class='titder'>MONTO GIFT CARD Bs</td ><td class='conte2'>0.00</td></tr><tr><td class='titder'>MONTO A PAGAR Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + "</td></tr><tr><td class='titder' style='font-size: 8px'>IMPORTE BASE CRÉDITO FISCAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + '</td></tr></table><br><div>Son ' + a + (parseFloat(factura.montoTotal).toFixed(2) - Math.floor(parseFloat(factura.montoTotal).toFixed(2))) * 100 + " /100 Bolivianos</div><hr><div class='titulo2' style='font-size: 9px'>ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS,<br>EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE<br>ACUERDO A LEY<br><br>" + factura.leyenda + " <br><br>“Este documento es la Representación Gráfica de un<br>Documento Fiscal Digital emitido en una modalidad de<br>facturación en línea”</div><br><div style='display: flex;justify-content: center;'> <img  src=" + this.qrImage + ' ></div></div>'
      document.getElementById('myelement').innerHTML = cadena
      const d = new Printd()
      d.print(document.getElementById('myelement'))
    },
    cancelOrder (order) {
      this.$q.dialog({
        title: 'Cancelar Pedido',
        message: '¿Está seguro de cancelar el pedido?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.get('cancelOrder/' + order.id).then(res => {
          console.log(res.data)
          this.$q.notify({
            message: 'Pedido cancelado',
            color: 'teal',
            icon: 'info',
            position: 'top-right'
          })
          this.consultarOrder()
        })
      })
    },
    async printOrder (order) {
      // console.log(order)
      console.log(order.detailorders)
      let total = 0
      const ClaseConversor = conversor.conversorNumerosALetras
      const miConversor = new ClaseConversor()
      // eslint-disable-next-line no-multi-str
      let cadena = "<style>\
      .titulo{\
      font-size: 12px;\
      text-align: center;\
      font-weight: bold;\
      }\
      .titulo2{\
      font-size: 10px;\
      text-align: center;\
      }\
            .titulo3{\
      font-size: 10px;\
      text-align: center;\
      width:70%;\
      }\
            .contenido{\
      font-size: 10px;\
      text-align: left;\
      }\
      .conte2{\
      font-size: 10px;\
      text-align: right;\
      }\
      .campotd{\
      text-align: center;\
      }\
      .titder{\
      font-size: 12px;\
      text-align: right;\
      font-weight: bold;\
      }\
      hr{\
  border-top: 1px dashed   ;\
}\
  table{\
    width:100%\
  }\
  h1 {\
    color: black;\
    font-family: sans-serif;\
  }</style>\
    <div id='myelement'>\
      <div class='titulo2'>" + this.cine.razon + "<br> Oruro </div> <hr> <table><tr><td class='titder'>FECHA :</td><td class='contenido'>" + order.fecha + "</td></tr></table> <hr> <div class='titulo'>DETALLE</div> <table style='font-size: 10px;'><thead><tr><th>CANT</th><th>PROD</th><th>P.U.</th><th>SubT</th></tr></thead><tbody>"
      order.detailorders.forEach(r => {
        let ped = ''
        if (r.llevar === 'SI') ped = '-P'
        const subt = parseFloat(r.cantidad) * parseFloat(r.precio)
        cadena += "<tr><td class='campotd'>" + r.cantidad + ped + "</td><td class='campotd'>  " + r.producto + "</td><td class='campotd'>" + parseFloat(r.precio).toFixed(2) + " </td><td class='campotd'>" + parseFloat(subt).toFixed(2) + '</td></tr>'
        total += parseFloat(subt)
      })
      const a = miConversor.convertToText(parseInt(total))
      // eslint-disable-next-line no-multi-str
      cadena += "</tbody></table><hr>\
      <table style='font-size: 8px;'>\
      <tr><td class='titder'>TOTAL Bs</td><td class='conte2'>" + parseFloat(total).toFixed(2) + '</td></tr> </table><br> <div>Son ' + a + ' ' + (parseFloat(total).toFixed(2) - Math.floor(parseFloat(total).toFixed(2))) * 100 + ' /100 Bolivianos</div><div>Mesa: <b style="font-size:24px; text-align: center">' + order.mesa + '</b></div>'
      document.getElementById('myelement').innerHTML = cadena
      const d = new Printd()
      d.print(document.getElementById('myelement'))
    },
    async printOrderAummentado (order, detalle) {
      // console.log(order)
      // console.log(order.detailorders)
      let total = 0
      const ClaseConversor = conversor.conversorNumerosALetras
      const miConversor = new ClaseConversor()
      // eslint-disable-next-line no-multi-str
      let cadena = "<style>\
      .titulo{\
      font-size: 12px;\
      text-align: center;\
      font-weight: bold;\
      }\
      .titulo2{\
      font-size: 10px;\
      text-align: center;\
      }\
            .titulo3{\
      font-size: 10px;\
      text-align: center;\
      width:70%;\
      }\
            .contenido{\
      font-size: 10px;\
      text-align: left;\
      }\
      .conte2{\
      font-size: 10px;\
      text-align: right;\
      }\
      .campotd{\
      text-align: center;\
      }\
      .titder{\
      font-size: 12px;\
      text-align: right;\
      font-weight: bold;\
      }\
      hr{\
  border-top: 1px dashed   ;\
}\
  table{\
    width:100%\
  }\
  h1 {\
    color: black;\
    font-family: sans-serif;\
  }</style>\
    <div id='myelement'>\
      <div class='titulo2'>" + this.cine.razon + "<br> Oruro </div> <hr> <table><tr><td class='titder'>FECHA :</td><td class='contenido'>" + order.fecha + "</td></tr></table> <hr> <div class='titulo'>DETALLE</div> <table style='font-size: 10px;'><thead><tr><th>CANT</th><th>PROD</th><th>P.U.</th><th>SubT</th></tr></thead><tbody>"
      detalle.forEach(r => {
        let ped = ''
        if (r.llevar === 'SI') ped = '-P'
        const subt = parseFloat(r.cantidad) * parseFloat(r.precio)
        cadena += "<tr><td class='campotd'>" + r.cantidad + ped + "</td><td class='campotd'>  " + r.producto + "</td><td class='campotd'>" + parseFloat(r.precio).toFixed(2) + " </td><td class='campotd'>" + parseFloat(subt).toFixed(2) + '</td></tr>'
        total += parseFloat(subt)
      })
      const a = miConversor.convertToText(parseInt(total))
      // eslint-disable-next-line no-multi-str
      cadena += "</tbody></table><hr>\
      <table style='font-size: 8px;'>\
      <tr><td class='titder'>TOTAL Bs</td><td class='conte2'>" + parseFloat(total).toFixed(2) + '</td></tr> </table><br> <div>Son ' + a + ' ' + (parseFloat(total).toFixed(2) - Math.floor(parseFloat(total).toFixed(2))) * 100 + ' /100 Bolivianos</div><div>Mesa: <b style="font-size:24px; text-align: center">' + order.mesa + '</b></div><div><b>AGREGADO AL PEDIDO</b></div>'
      document.getElementById('myelement').innerHTML = cadena
      const d = new Printd()
      d.print(document.getElementById('myelement'))
    },
    async printComanda (factura) {
      this.facturadetalle = factura
      const ClaseConversor = conversor.conversorNumerosALetras
      const miConversor = new ClaseConversor()
      const a = miConversor.convertToText(parseInt(factura.montoTotal))
      // eslint-disable-next-line no-multi-str
      let cadena = "<style>\
      .titulo{\
      font-size: 12px;\
      text-align: center;\
      font-weight: bold;\
      }\
      .titulo2{\
      font-size: 10px;\
      text-align: center;\
      }\
            .titulo3{\
      font-size: 10px;\
      text-align: center;\
      width:70%;\
      }\
            .contenido{\
      font-size: 10px;\
      text-align: left;\
      }\
      .conte2{\
      font-size: 10px;\
      text-align: right;\
      }\
      .campotd{\
      text-align: center;\
      }\
      .titder{\
      font-size: 12px;\
      text-align: right;\
      font-weight: bold;\
      }\
      hr{\
  border-top: 1px dashed   ;\
}\
  table{\
    width:100%\
  }\
  h1 {\
    color: black;\
    font-family: sans-serif;\
  }</style>\
    <div id='myelement'>\
      <div class='titulo2'>" + this.cine.razon + '<br> Casa Matriz<br> No. Punto de Venta ' + factura.codigoPuntoVenta + "<br>Oruro </div> <hr> <table><tr><td class='titder'>FECHA DE EMISIÓN:</td><td class='contenido'>" + factura.fechaEmision + "</td></tr></table> <hr> <div class='titulo'>DETALLE</div> <table style='font-size: 10px;'><thead><tr><th>CANT</th><th>PROD</th><th>P.U.</th><th>SubT</th></tr></thead><tbody>"
      factura.details.forEach(r => {
        cadena += "<tr><td class='campotd'>" + r.cantidad + "</td><td class='campotd'>  " + r.descripcion + "</td><td class='campotd'>" + parseFloat(r.precioUnitario).toFixed(2) + " </td><td class='campotd'>" + parseFloat(r.subTotal).toFixed(2) + '</td></tr>'
      })
      // eslint-disable-next-line no-multi-str
      cadena += "</tbody></table><hr>\
      <table style='font-size: 8px;'>\
      <tr><td class='titder'>TOTAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + '</td></tr> </table><br> <div>Son ' + a + (parseFloat(factura.montoTotal).toFixed(2) - Math.floor(parseFloat(factura.montoTotal).toFixed(2))) * 100 + ' /100 Bolivianos</div><div>Usuario: ' + factura.usuario + '</div><div>Venta: ' + factura.id + '</div>'
      document.getElementById('myelement').innerHTML = cadena
      const d = new Printd()
      d.print(document.getElementById('myelement'))
    },
    saleInsert () {
      this.error = ''
      this.loading = true
      this.client.codigoTipoDocumentoIdentidad = this.document.codigoClasificador
      this.client.email = this.client.email === undefined ? '' : this.client.email
      this.$api.post('/sale', {
        client: this.client,
        montoTotal: this.total,
        detalleVenta: this.productsSale,
        tarjeta: this.boolcredito ? 'SI' : 'NO',
        codigoTarjeta: this.codigo,
        vip: this.booltarjeta ? 'SI' : 'NO',
        tipo: this.tipo[parseInt(this.shop_id) - 1],
        npedido: this.numpedido
      }).then(res => {
        this.reset()
        if (res.data.sale.siatEnviado === 1) {
          this.printFactura(res.data.sale)
        }
        this.printComanda(res.data.sale)
        this.printComanda(res.data.sale)
        this.icon = false
        // console.log(res.data)
        this.loading = false
        this.consultarOrder()
      }).catch(err => {
        console.log(err)
        this.loading = false
        this.$q.notify({
          color: 'negative',
          textColor: 'white',
          message: err.response.data.message,
          position: 'top',
          timeout: 5000
        })
      })
    }
  },
  computed: {
    pedidoTotal () {
      let total = 0
      this.orders.forEach(r => {
        if (r.status === 'PENDIENTE') {
          total++
        }
      })
      return total
    },
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

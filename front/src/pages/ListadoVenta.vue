<template>
    <q-page>
      <div class="row">
          <div class="col-12">
            <q-form @submit.prevent="listadoGet">
              <div class="row">
                <div class="col-4 q-pa-xs">
                  <q-input outlined label="FechaIni" type="date" v-model="fechaIni" dense />
                </div>
                <div class="col-4 q-pa-xs">
                  <q-input outlined label="FechaFin" type="date" v-model="fechaFin" dense/>
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
                   <!--<q-btn color="green"  label="Export EXCEL" @click="exportar" />-->
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
    <q-dialog v-model="dialogAnular" >
        <q-card style="min-width: 350px">
          <q-card-section>
            <div class="text-h6">ANULAR FACTURA</div>
          </q-card-section>
          <q-card-section class="q-pt-none">
            <q-select label="motivo" :options="motivos" v-model="motivo"/>
          </q-card-section>
          <q-card-actions align="right" class="text-primary">
            <q-btn flat label="Cancel" v-close-popup />
            <q-btn flat label="ANULAR" @click="enviarAnular" />
          </q-card-actions>
        </q-card>
      </q-dialog>
      </div>
    </q-page>
  </template>

<script>
import xlsx from 'json-as-xlsx'
import { date } from 'quasar'
import { Printd } from 'printd'

const conversor = require.context('conversor-numero-a-letras-es-ar')
const QRCode = require.context('qrcode')

export default {
  name: 'ListadoPage',
  data () {
    return {
      inventarieDialog: false,
      categoryStatus: 'Crear',
      loading: false,
      dialogAnular: false,
      inventaries: [],
      motivos: [],
      filter: '',
      motivo: {},
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
        this.listadoGet()
      }
    )
  },
  mounted () {
    this.encabezado()
    this.cargarMotivo()
  },
  methods: {
    encabezado () {
      this.$api.get('datocine/' + this.shop_id).then(res => {
        this.cine = res.data
        // console.log(this.cine)
      })
    },
    async printFactura (factura) {
      console.log(factura)
      this.facturadetalle = factura
      const ClaseConversor = conversor.conversorNumerosAconstras
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
      <tr><td class='titder' style='width: 60%'>SUBTOTAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + "</td></tr><tr><td class='titder'>DESCUENTO Bs</td><td class='conte2'>0.00</td></tr><tr><td class='titder'>TOTAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + "</td></tr><tr><td class='titder'>MONTO GIFT CARD Bs</td ><td class='conte2'>0.00</td></tr><tr><td class='titder'>MONTO A PAGAR Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + "</td></tr><tr><td class='titder' style='font-size: 8px'>IMPORTE BASE CRÉDITO FISCAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + '</td></tr></table><br><div>Son ' + a + ' ' + (parseFloat(factura.montoTotal).toFixed(2) - Math.floor(parseFloat(factura.montoTotal).toFixed(2))) * 100 + "/100 Bolivianos</div><hr><div class='titulo2' style='font-size: 9px'>ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS,<br>EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE<br>ACUERDO A LEY<br><br>" + factura.leyenda + " <br><br>“Este documento es la Representación Gráfica de un<br>Documento Fiscal Digital emitido en una modalidad de<br>facturación en línea”</div><br><div style='display: flex;justify-content: center;'> <img src=" + this.qrImage + ' ></div></div>'
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
      <tr><td class='titder'>TOTAL Bs</td><td class='conte2'>" + parseFloat(factura.montoTotal).toFixed(2) + '</td></tr> </table><br> <div>Son ' + a + ' ' + (parseFloat(factura.montoTotal).toFixed(2) - Math.floor(parseFloat(factura.montoTotal).toFixed(2))) * 100 + '/100 Bolivianos</div><div>Usuario: ' + factura.usuario + '</div><div>Venta: ' + factura.id + '</div>'
      document.getElementById('myelement').innerHTML = cadena
      const d = new Printd()
      d.print(document.getElementById('myelement'))
    },
    anularSale () {
      this.$q.loading.show()
      this.$api.post('anularSale', { sale: this.factura, motivo: this.motivo }).then(res => {
        console.log(res.data)
        this.$q.loading.hide()
        this.listadoGet()
        this.dialogAnular = false
      })
    },
    cargarMotivo () {
      this.$api.get('motivoanular').then(res => {
        res.data.forEach(r => {
          r.label = r.descripcion
        })
        this.motivos = res.data
        this.motivo = this.motivos[0]
      })
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
      this.titulo = this.opt[this.shop_id - 1]
      this.loading = true
      this.$api.post('listado', { ini: this.fechaIni, fin: this.fechaFin, tipo: this.titulo }).then((response) => {
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

<template>
        <q-page padding>
          <div class="row">
            <div class="col-2"><q-select dense outlined v-model="user" :options="users" label="Usuario" /></div>
            <div class="col-3"><q-input dense outlined v-model="ini" label="fecha ini" type="date" /></div>
            <div class="col-3"><q-input dense outlined v-model="fin" label="fecha fin" type="date" /></div>
            <div class="col-2 flex flex-center"> <q-btn icon="check" :loading="loading" color="green"  label="Consultar" @click="consultar"/></div>
            <div class="col-2 flex flex-center"> <q-btn icon="print" :loading="loading" color="info"  label="Imprimir" @click="impresion"/></div>
            <div class="col-12">
              <q-table dense :title="'Listado Venta '+ tipo[shop_id - 1] " :rows-per-page-options="[20,50,100,0]" :rows="reporte" :columns="columna" :filter="productoFilter">
                <template v-slot:top-right>
                  <q-input outlined dense debounce="300" v-model="productoFilter" placeholder="Buscar">
                    <template v-slot:append>
                      <q-icon name="search" />
                    </template>
                  </q-input>
                </template>
              </q-table>
            </div>
            <div class="col-12">
              <q-table title="Ventas" :rows="infouser" :columns="columna2" row-key="name" />
            </div>
          </div>
      <div id="myelement" class="hidden"></div>
        </q-page>
  </template>

<script>
import { globalStore } from 'stores/globalStore'
import { date } from 'quasar'
import { Printd } from 'printd'

export default {
  name: 'CajaPage',
  data () {
    return {
      productoFilter: '',
      ini: date.formatDate(new Date(), 'YYYY-MM-DD'),
      fin: date.formatDate(new Date(), 'YYYY-MM-DD'),
      loading: false,
      reporte: [],
      reporteR: [],
      reporteF: [],
      user: {},
      users: [],
      infouser: [],
      tcajaR: 0,
      tcajaF: 0,
      tefectcajaR: 0,
      tefectcajaF: 0,
      store: globalStore(),
      tvip: 0,
      tcredito: 0,
      tefectivo: 0,
      total: 0,
      shop_id: this.$route.params.id,
      tipo: ['SABOR PERU', 'CAFE ITALIA', 'VACA FRIA'],
      columna: [
        { label: 'NOMBRE', field: 'descripcion', name: 'descripcion', sortable: true },
        { label: 'cantidad', field: 'cantidad', name: 'cantidad', sortable: true },
        { label: 'SUBTOTAL', field: 'total', name: 'subtotal', sortable: true }
      ],
      columna2: [
        { label: 'USUARIO', field: 'usuario', name: 'usuario', sortable: true },
        { label: 'TOTAL', field: 'total', name: 'total', sortable: true }
      ]
    }
  },
  created () {
    this.cargaDato()
    this.listuser()
  },
  methods: {
    async cargaDato () {
      await this.$watch(
        () => this.$route.params,
        async (toParams) => {
          console.log(toParams)
          this.shop_id = await parseInt(toParams.id)
        }
      )
    },
    listuser () {
      this.users = [{ id: 0, label: 'TODOS' }]
      this.$api.get('user').then(res => {
        console.log(res.data)
        res.data.forEach(r => {
          r.label = r.name
          this.users.push(r)
        })
        this.user = this.users[0]
        // this.cargaDato()
      })
    },
    consultar () {
      this.loading = true
      this.$api.post('caja', { ini: this.ini, fin: this.fin, id: this.user.id, tipo: this.tipo[this.shop_id - 1] }).then(res => {
        console.log(res.data)
        this.reporte = res.data
        this.resumen()
        this.datosuser()
        this.datofactura()
        this.datorecibo()
        // this.loading = false
      })
    },

    datosuser () {
      this.loading = true
      this.$api.post('usercaja', { ini: this.ini, fin: this.fin, tipo: this.tipo[this.shop_id - 1] }).then(res => {
        console.log(res.data)
        this.infouser = res.data
        this.loading = false
      })
    },
    datofactura () {
      this.loading = true
      this.$api.post('cajaF', { ini: this.ini, fin: this.fin, id: this.user.id, tipo: this.tipo[this.shop_id - 1] }).then(res => {
        console.log(res.data)
        this.reportef = res.data
        this.loading = false
      })
    },
    datorecibo () {
      this.loading = true
      this.$api.post('cajaR', { ini: this.ini, fin: this.fin, id: this.user.id, tipo: this.tipo[this.shop_id - 1] }).then(res => {
        console.log(res.data)
        this.reporter = res.data
        this.loading = false
      })
    },
    resumen () {
      this.loading = true
      this.$api.post('resumen', { ini: this.ini, fin: this.fin, id: this.user.id, tipo: this.tipo[this.shop_id - 1] }).then(res => {
        console.log(res.data)
        this.tcredito = res.data[0].tarjeta == null ? 0 : res.data[0].tarjeta
        this.tvip = res.data[0].vip == null ? 0 : res.data[0].vip
        this.tefectivo = res.data[0].efectivo == null ? 0 : res.data[0].efectivo
        this.$api.post('resumenRF', { ini: this.ini, fin: this.fin, id: this.user.id, tipo: this.tipo[this.shop_id - 1] }).then(res => {
          this.tcajaF = res.data[0].tarjetaF
          this.tcajaR = res.data[0].tarjetaR
          this.tefectcajaR = res.data[0].efectivoR
          this.tefectcajaF = res.data[0].efectivoF
          this.loading = false
        })
      })
    },

    impresion () {
      if (this.reporte.length === 0) {
        return false
      }

      // eslint-disable-next-line no-multi-str
      let cadena = "<style>\
        .f-10{font-size:10px;}\
        .titulo{text-align:center;\
            font-weight:bold;}\
        .titulo2{font-weight:bold;}\
        .titulo3{font-weight:bold; text-align:right;}\
        .table{width:100%; border:0.2px solid;}\
        </style>\
        <div class='f-10 titulo' >BistroFood S.R.L.</div>\
        <div class='f-10 titulo' >ORURO - BOLIVIA</div>\
        <div class='f-10 titulo' >VENTAS " + this.tipo[this.shop_id - 1] + " TOTAL</div><hr><div class='f-10'><span class='titulo2'>Fecha: </span> " + date.formatDate(new Date(), 'DD/MM/YYYY HH:mm:ss') + "</div><div class='f-10'><span class='titulo2'>Fecha Caja: </span> " + this.ini + ' al ' + this.fin + "</div><div class='f-10'><span  class='titulo2'>Usuario: </span> " + this.user.label + "</div><hr><table class='table'><thead><tr><th class='f-10'>DESCRIPCION</th><th class='f-10'>CANTIDAD</th><th class='f-10'>TOTAL</th></tr></thead><tbody>"
      this.reporte.forEach(r => {
        cadena += "<tr><td class='f-10'>" + r.descripcion + "</td><td class='f-10'>" + r.cantidad + "</td><td class='f-10'>" + r.total + '</td></tr>'
      })
      cadena += '</tbody></table>'
      if (this.user.id === 0) {
        cadena += "<table class='table'><tr><th class='f-10'>USUARIO</th><th class='f-10'>TOTAL</th></tr>"
        this.infouser.forEach(r => {
          cadena += "<tr><td class='f-10'>" + r.usuario + "</td> <td class='f-10'>" + r.total + '</td></tr>'
        })
        cadena += '</table>'
      }

      cadena += "<div style='text-align:right;'><span class='f-10 titulo3'>Total: </span> " + this.ventatotal + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total VIP: </span> " + this.tvip + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total Credito: </span> " + this.tcredito + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total Efectivo: </span> " + this.tefectivo + ' Bs</div>'
      document.getElementById('myelement').innerHTML = cadena
      const d = new Printd()
      d.print(document.getElementById('myelement'))

      // eslint-disable-next-line no-multi-str
      let cadena2 = "<style>\
        .f-10{font-size:10px;}\
        .titulo{text-align:center;\
            font-weight:bold;}\
        .titulo2{font-weight:bold;}\
        .titulo3{font-weight:bold; text-align:right;}\
        .table{width:100%; border:0.2px solid;}\
        </style>\
        <div class='f-10 titulo' >BistroFood S.R.L.</div>\
        <div class='f-10 titulo' >ORURO - BOLIVIA</div>\
        <div class='f-10 titulo' >VENTAS " + this.tipo[this.shop_id - 1] + " FACTURA</div><hr><div class='f-10'><span class='titulo2'>Fecha: </span> " + date.formatDate(new Date(), 'DD/MM/YYYY HH:mm:ss') + "</div><div class='f-10'><span class='titulo2'>Fecha Caja: </span> " + this.ini + ' al ' + this.fin + "</div><div class='f-10'><span  class='titulo2'>Usuario: </span> " + this.user.label + "</div><hr><table class='table'><thead><tr><th class='f-10'>DESCRIPCION</th><th class='f-10'>CANTIDAD</th><th class='f-10'>TOTAL</th></tr></thead><tbody>"
      this.reportef.forEach(r => {
        cadena2 += "<tr><td class='f-10'>" + r.descripcion + "</td><td class='f-10'>" + r.cantidad + "</td><td class='f-10'>" + r.total + '</td></tr>'
      })
      cadena2 += '</tbody></table>'
      if (this.tcajaF == null) this.tcajaF = 0
      if (this.tefectcajaF == null) this.tefectcajaF = 0
      cadena2 += "<div style='text-align:right;'><span class='f-10 titulo3'>Total: </span> " + this.ventafactura + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total Efectivo: </span> " + this.tefectcajaF + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total Tarjeta: </span> " + this.tcajaF + ' Bs</div>'
      document.getElementById('myelement').innerHTML = cadena2
      const d2 = new Printd()
      d2.print(document.getElementById('myelement'))

      // eslint-disable-next-line no-multi-str
      let cadena3 = "<style>\
        .f-10{font-size:10px;}\
        .titulo{text-align:center;\
            font-weight:bold;}\
        .titulo2{font-weight:bold;}\
        .titulo3{font-weight:bold; text-align:right;}\
        .table{width:100%; border:0.2px solid;}\
        </style>\
        <div class='f-10 titulo' >BistroFood S.R.L.</div>\
        <div class='f-10 titulo' >ORURO - BOLIVIA</div>\
        <div class='f-10 titulo' >VENTAS " + this.tipo[this.shop_id - 1] + " RECIBO</div><hr><div class='f-10'><span class='titulo2'>Fecha: </span> " + date.formatDate(new Date(), 'DD/MM/YYYY HH:mm:ss') + "</div><div class='f-10'><span class='titulo2'>Fecha Caja: </span> " + this.ini + ' al ' + this.fin + "</div><div class='f-10'><span  class='titulo2'>Usuario: </span> " + this.user.label + "</div><hr><table class='table'><thead><tr><th class='f-10'>DESCRIPCION</th><th class='f-10'>CANTIDAD</th><th class='f-10'>TOTAL</th></tr></thead><tbody>"
      this.reporter.forEach(r => {
        cadena3 += "<tr><td class='f-10'>" + r.descripcion + "</td><td class='f-10'>" + r.cantidad + "</td><td class='f-10'>" + r.total + '</td></tr>'
      })
      cadena3 += '</tbody></table>'
      if (this.tcajaR == null) this.tcajaR = 0
      if (this.tefectcajaR == null) this.tefectcajaR = 0
      cadena3 += "<div style='text-align:right;'><span class='f-10 titulo3'>Total: </span> " + this.ventarecibo + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total Efectivo: </span> " + this.tefectcajaR + " Bs</div><div style='text-align:right;'><span class='f-10 titulo3'>Total Tarjeta: </span> " + this.tcandyR + ' Bs</div>'
      document.getElementById('myelement').innerHTML = cadena3
      const d3 = new Printd()
      d3.print(document.getElementById('myelement'))
    }
  },
  computed: {
    ventatotal () {
      let suma = 0
      this.reporte.forEach(r => {
        suma += r.total
      })
      return suma.toFixed(2)
    },
    ventafactura () {
      let suma = 0
      this.reportef.forEach(r => {
        suma += r.total
      })
      return suma.toFixed(2)
    },
    ventarecibo () {
      let suma = 0
      this.reporter.forEach(r => {
        suma += r.total
      })
      return suma.toFixed(2)
    }
  }
}
</script>

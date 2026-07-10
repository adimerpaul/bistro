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
            <q-table :rows="listado" :columns="listaColums" :filter="filter" row-key="qrId">
                <template v-slot:top-right>
                   <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
                    <template v-slot:append>
                      <q-icon name="search" />
                    </template>
                  </q-input>
                </template>
                <template v-slot:body-cell-venta="props">
                  <q-td :props="props">
                    <q-chip v-if="props.row.sale" color="positive" text-color="white" dense icon="link">
                      #{{ props.row.sale.id }} {{ props.row.sale.tipo }} - {{ props.row.sale.montoTotal }} Bs
                    </q-chip>
                    <q-chip v-else color="negative" text-color="white" dense icon="link_off">
                      SIN RELACION
                    </q-chip>
                  </q-td>
                </template>
                <template v-slot:body-cell-opciones="props">
                  <q-td :props="props">
                    <q-btn v-if="!props.row.sale" dense size="sm" color="primary" icon="link" label="Vincular" @click="abrirVincular(props.row)" />
                    <q-btn v-else dense size="sm" flat color="negative" icon="link_off" label="Quitar" @click="desvincular(props.row)" />
                  </q-td>
                </template>
            </q-table>
        </div>
      </div>

      <q-dialog v-model="dialogVincular">
        <q-card style="width: 800px; max-width: 95vw;">
          <q-card-section class="row items-center q-pb-none">
            <div class="text-h6"><q-icon name="link"/> Vincular pago QR a una venta</div>
            <q-space />
            <q-btn icon="close" flat round dense v-close-popup />
          </q-card-section>
          <q-card-section v-if="pagoSel" class="q-pt-sm">
            <div class="text-caption">
              <b>QR:</b> {{ pagoSel.qrId }} &nbsp; <b>Monto:</b> {{ pagoSel.amount }} {{ pagoSel.currency }} &nbsp;
              <b>Fecha:</b> {{ (pagoSel.paymentDate || '').substring(0, 10) }} {{ pagoSel.paymentTime }} &nbsp;
              <b>Pagado por:</b> {{ pagoSel.senderName }}
            </div>
          </q-card-section>
          <q-card-section>
            <div class="row">
              <div class="col-4 q-pa-xs">
                <q-select dense outlined v-model="tienda" :options="tiendas" label="Tienda" />
              </div>
              <div class="col-4 q-pa-xs">
                <q-input dense outlined v-model="fechaVenta" label="Fecha venta" type="date" />
              </div>
              <div class="col-4 q-pa-xs flex flex-center">
                <q-btn label="Buscar ventas" icon="search" color="primary" :loading="loadingVentas" @click="buscarVentas" />
              </div>
            </div>
            <q-table dense :rows="ventas" :columns="ventaColums" row-key="id" :loading="loadingVentas"
              no-data-label="No hay ventas sin QR para esa fecha y tienda" :rows-per-page-options="[10,20,0]">
              <template v-slot:body-cell-accion="props">
                <q-td :props="props">
                  <q-btn dense size="sm" color="positive" icon="check" label="Vincular"
                    :class="{ 'bg-orange': Number(props.row.montoTotal) !== Number(pagoSel && pagoSel.amount) }"
                    @click="vincular(props.row)" />
                </q-td>
              </template>
            </q-table>
            <div class="text-caption text-grey-7 q-mt-xs">* Solo se muestran ventas que aún no tienen un QR vinculado.</div>
          </q-card-section>
        </q-card>
      </q-dialog>
    </q-page>
  </template>

<script>
import { date } from 'quasar'

export default {
  name: 'PagosQrPage',
  data () {
    return {
      loading: false,
      filter: '',
      fechaIni: date.formatDate(new Date(), 'YYYY-MM-DD'),
      fechaFin: date.formatDate(new Date(), 'YYYY-MM-DD'),
      listado: [],
      dialogVincular: false,
      pagoSel: null,
      tiendas: ['SABOR PERU', 'CAFE ITALIA', 'VACA FRIA'],
      tienda: 'SABOR PERU',
      fechaVenta: date.formatDate(new Date(), 'YYYY-MM-DD'),
      ventas: [],
      loadingVentas: false,
      ventaColums: [
        { name: 'id', label: 'Venta', field: 'id', sortable: true, align: 'left' },
        { name: 'fechaEmision', label: 'Fecha/Hora', field: row => (row.fechaEmision || '').substring(0, 16).replace('T', ' '), sortable: true, align: 'left' },
        { name: 'usuario', label: 'Usuario', field: 'usuario', sortable: true, align: 'left' },
        { name: 'venta', label: 'F/R', field: 'venta', sortable: true, align: 'center' },
        { name: 'montoTotal', label: 'Monto', field: 'montoTotal', sortable: true, align: 'right' },
        { name: 'accion', label: '', field: 'accion', align: 'center' }
      ],
      listaColums: [
        { name: 'qrId', label: 'Codigo QR', field: 'qrId', sortable: true, align: 'left' },
        { name: 'transactionId', label: 'Transaccion', field: 'transactionId', sortable: true, align: 'left' },
        { name: 'paymentDate', label: 'Fecha', field: row => (row.paymentDate || '').substring(0, 10), sortable: true, align: 'left' },
        { name: 'paymentTime', label: 'Hora', field: 'paymentTime', sortable: true, align: 'left' },
        { name: 'amount', label: 'Monto', field: row => `${row.amount} ${row.currency}`, sortable: true, align: 'left' },
        { name: 'senderName', label: 'Pagado por', field: 'senderName', sortable: true, align: 'left' },
        { name: 'senderAccount', label: 'Cuenta origen', field: 'senderAccount', sortable: true, align: 'left' },
        { name: 'description', label: 'Descripcion', field: 'description', sortable: true, align: 'left' },
        { name: 'branchCode', label: 'Sucursal', field: 'branchCode', sortable: true, align: 'left' },
        { name: 'venta', label: 'Venta', field: row => row.sale ? `#${row.sale.id} ${row.sale.tipo}` : 'SIN RELACION', sortable: true, align: 'left' },
        { name: 'opciones', label: 'Opciones', field: 'opciones', align: 'center' }
      ]
    }
  },
  created () {
    this.listadoGet()
  },
  methods: {
    listadoGet () {
      this.loading = true
      this.$api.post('baneco/qr/pagados', { ini: this.fechaIni, fin: this.fechaFin }).then((response) => {
        this.listado = response.data
      }).catch(err => {
        this.$q.notify({
          color: 'negative',
          textColor: 'white',
          message: (err.response && err.response.data && err.response.data.message) || 'No se pudo obtener el listado',
          position: 'top',
          timeout: 5000
        })
      }).finally(() => {
        this.loading = false
      })
    },
    abrirVincular (pago) {
      this.pagoSel = pago
      this.fechaVenta = (pago.paymentDate || '').substring(0, 10) || this.fechaIni
      this.ventas = []
      this.dialogVincular = true
      this.buscarVentas()
    },
    buscarVentas () {
      this.loadingVentas = true
      this.$api.post('baneco/qr/ventas', { fecha: this.fechaVenta, tipo: this.tienda }).then(res => {
        this.ventas = res.data
      }).catch(err => {
        this.$q.notify({
          color: 'negative',
          textColor: 'white',
          message: (err.response && err.response.data && err.response.data.message) || 'No se pudo obtener las ventas',
          position: 'top'
        })
      }).finally(() => {
        this.loadingVentas = false
      })
    },
    vincular (venta) {
      this.$q.dialog({
        title: 'Vincular',
        message: 'Vincular el pago QR de ' + this.pagoSel.amount + ' ' + this.pagoSel.currency + ' con la venta #' + venta.id + ' (' + venta.montoTotal + ' Bs, ' + this.tienda + ')?',
        cancel: true
      }).onOk(() => {
        this.$api.post('baneco/qr/vincular', { qrId: this.pagoSel.qrId, sale_id: venta.id }).then(() => {
          this.$q.notify({ color: 'positive', textColor: 'white', message: 'Venta vinculada correctamente', position: 'top' })
          this.dialogVincular = false
          this.listadoGet()
        }).catch(err => {
          this.$q.notify({
            color: 'negative',
            textColor: 'white',
            message: (err.response && err.response.data && err.response.data.message) || 'No se pudo vincular',
            position: 'top'
          })
        })
      })
    },
    desvincular (pago) {
      this.$q.dialog({
        title: 'Quitar relacion',
        message: 'Quitar la relacion del pago QR con la venta #' + pago.sale.id + ' (' + pago.sale.tipo + ')?',
        cancel: true
      }).onOk(() => {
        this.$api.post('baneco/qr/desvincular', { sale_id: pago.sale.id }).then(() => {
          this.$q.notify({ color: 'positive', textColor: 'white', message: 'Relacion eliminada', position: 'top' })
          this.listadoGet()
        }).catch(err => {
          this.$q.notify({
            color: 'negative',
            textColor: 'white',
            message: (err.response && err.response.data && err.response.data.message) || 'No se pudo quitar la relacion',
            position: 'top'
          })
        })
      })
    }
  }
}
</script>

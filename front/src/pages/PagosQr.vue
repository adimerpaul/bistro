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
            </q-table>
        </div>
      </div>
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
      listaColums: [
        { name: 'qrId', label: 'Codigo QR', field: 'qrId', sortable: true, align: 'left' },
        { name: 'transactionId', label: 'Transaccion', field: 'transactionId', sortable: true, align: 'left' },
        { name: 'paymentDate', label: 'Fecha', field: row => (row.paymentDate || '').substring(0, 10), sortable: true, align: 'left' },
        { name: 'paymentTime', label: 'Hora', field: 'paymentTime', sortable: true, align: 'left' },
        { name: 'amount', label: 'Monto', field: row => `${row.amount} ${row.currency}`, sortable: true, align: 'left' },
        { name: 'senderName', label: 'Pagado por', field: 'senderName', sortable: true, align: 'left' },
        { name: 'senderAccount', label: 'Cuenta origen', field: 'senderAccount', sortable: true, align: 'left' },
        { name: 'description', label: 'Descripcion', field: 'description', sortable: true, align: 'left' },
        { name: 'branchCode', label: 'Sucursal', field: 'branchCode', sortable: true, align: 'left' }
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
    }
  }
}
</script>

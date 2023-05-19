import { defineStore } from 'pinia'

export const globalStore = defineStore('global', {
  state: () => ({
    counter: 0,
    user: {},
    eventNumber: 0,
    isLoggedIn: !!localStorage.getItem('tokenBio'),

    booluser: false,
    boolcuis: false,
    boolsincr: false,
    boolcufd: false,
    boolevento: false,
    boolrubrosp: false,
    boolrubroci: false,
    boolrubrovf: false,
    boolproductosp: false,
    boolproductoci: false,
    boolproductovf: false,
    boolsabor: false,
    boolcafe: false,
    boolvaca: false,
    boollistsabor: false,
    boollistcafe: false,
    boollistvaca: false,
    boolcajasabor: false,
    boolcajacafe: false,
    boolcajavaca: false,
    boolcliente: false
  }),
  getters: {
    doubleCount: (state) => state.counter * 2
  },
  actions: {
    increment () {
      this.counter++
    }
  }
})

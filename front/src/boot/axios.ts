import { boot } from 'quasar/wrappers'
import axios from 'axios'
import { useCounterStore } from 'stores/example-store'
import { globalStore } from 'stores/globalStore'

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
const api = axios.create({ baseURL: import.meta.env.VITE_API_BACK })

export default boot(({ app, router }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  // app.config.globalProperties.$axios = axios
  app.config.globalProperties.$url = import.meta.env.VITE_API_BACK
  app.config.globalProperties.$store = useCounterStore()
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
  const token = localStorage.getItem('tokenBistro')
  console.log(token)
  if (token) {
    api.defaults.headers.common.Authorization = `Bearer ${token}`
    api.post('me').then((response) => {
      console.log(response.data)
      globalStore().user = response.data
      globalStore().isLoggedIn = true
      response.data.permisos.forEach((r: { id: number }) => {
        if (r.id === 1) globalStore().booluser = true
        if (r.id === 2) globalStore().boolcuis = true
        if (r.id === 3) globalStore().boolsincr = true
        if (r.id === 4) globalStore().boolcufd = true
        if (r.id === 5) globalStore().boolevento = true
        if (r.id === 6) globalStore().boolrubrosp = true
        if (r.id === 7) globalStore().boolrubroci = true
        if (r.id === 8) globalStore().boolrubrovf = true
        if (r.id === 9) globalStore().boolproductosp = true
        if (r.id === 10) globalStore().boolproductoci = true
        if (r.id === 11) globalStore().boolproductovf = true
        if (r.id === 12) globalStore().boolsabor = true
        if (r.id === 13) globalStore().boolcafe = true
        if (r.id === 14) globalStore().boolvaca = true
        if (r.id === 15) globalStore().boollistsabor = true
        if (r.id === 16) globalStore().boollistcafe = true
        if (r.id === 17) globalStore().boollistvaca = true
        if (r.id === 18) globalStore().boolcajasabor = true
        if (r.id === 19) globalStore().boolcajacafe = true
        if (r.id === 20) globalStore().boolcajavaca = true
        if (r.id === 21) globalStore().boolcliente = true
      })
    }).catch(() => {
      app.config.globalProperties.$api.defaults.headers.common.Authorization = ''
      globalStore().user = {}
      localStorage.removeItem('tokenBistro')
      globalStore().isLoggedIn = false
      globalStore().booluser = false
      globalStore().boolcuis = false
      globalStore().boolsincr = false
      globalStore().boolcufd = false
      globalStore().boolevento = false
      globalStore().boolrubrosp = false
      globalStore().boolrubroci = false
      globalStore().boolrubrovf = false
      globalStore().boolproductosp = false
      globalStore().boolproductoci = false
      globalStore().boolproductovf = false
      globalStore().boolsabor = false
      globalStore().boolcafe = false
      globalStore().boolvaca = false
      globalStore().boollistsabor = false
      globalStore().boollistcafe = false
      globalStore().boollistvaca = false
      globalStore().boolcajasabor = false
      globalStore().boolcajacafe = false
      globalStore().boolcajavaca = false
      globalStore().boolcliente = false
      router.push('/login')
    })
  } else {
    console.log('no tokrn')
    console.log(router)
    // router.push('/login')
    router.push('/login')
    router.replace({ path: '/login' })
    globalStore().user = {}
    globalStore().isLoggedIn = false
    globalStore().booluser = false
    globalStore().boolcuis = false
    globalStore().boolsincr = false
    globalStore().boolcufd = false
    globalStore().boolevento = false
    globalStore().boolrubrosp = false
    globalStore().boolrubroci = false
    globalStore().boolrubrovf = false
    globalStore().boolproductosp = false
    globalStore().boolproductoci = false
    globalStore().boolproductovf = false
    globalStore().boolsabor = false
    globalStore().boolcafe = false
    globalStore().boolvaca = false
    globalStore().boollistsabor = false
    globalStore().boollistcafe = false
    globalStore().boollistvaca = false
    globalStore().boolcajasabor = false
    globalStore().boolcajacafe = false
    globalStore().boolcajavaca = false
    globalStore().boolcliente = false
    localStorage.removeItem('tokenBistro')
    globalStore().isLoggedIn = false
  }
})

export { api }

import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
//Servicios
import { autenticacion } from '../modules/autenticacion.module'
import { pedidos } from '../modules/pedidos.module'

Vue.use(Vuex)

const vuexAutenticacion = new VuexPersistence({
  key: 'lsUsuario',
  storage: window.localStorage,
  modules: ['autenticacion', 'pedidos']
})

const vuexPedidos = new VuexPersistence({
  key: 'lsPedidos',
  storage: window.localStorage,
  modules: ['pedidos']
})

export default new Vuex.Store({
  modules: {
    autenticacion,
    pedidos
  },
  plugins: [vuexAutenticacion.plugin, vuexPedidos.plugin]
})

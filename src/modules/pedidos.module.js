import ServicioPedidos from '../services/ServicioPedidos'

export const pedidos = {
  namespaced: true,
  state: {
    listaPedidos: null
  },
  mutations: {
    LLENAR_LISTA_PEDIDOS: (state, pedidos) => {
      state.listaPedidos = pedidos
    }
  },
  actions: {
    async obtenerPedidos({ commit }) {
      const { data } = await ServicioPedidos.obtenerPedidos()
      commit('LLENAR_LISTA_PEDIDOS', data.pedidos)
      return Promise.resolve(data)
    },
    async guardarPedidos({ commit }, dataPedido) {
      const { data } = await ServicioPedidos.guardarPedido(dataPedido)
      return Promise.resolve(data)
    }
  },
  getters: {
    listaPedidos: (state) => {
      if (state.listaPedidos.length > 0) return state.listaPedidos
    }
  }
}

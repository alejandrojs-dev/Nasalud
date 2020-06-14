import ServicioPedidos from '../services/ServicioPedidos'

export const pedidos = {
  namespaced: true,
  state: {
    listaPedidos: [],
    pizzas: [],
    paginacion: {
      total: 0,
      paginaActual: 0,
      porPagina: 0,
      ultimaPagina: 0,
      desde: 0,
      hacia: 0
    }
  },
  mutations: {
    LLENAR_LISTA_PEDIDOS: (state, pedidos) => {
      state.listaPedidos = pedidos
    },
    LLENAR_LISTA_PIZZAS: (state, pizzas) => {
      state.pizzas = pizzas
    }
  },
  actions: {
    async obtenerPedidos({ commit }, pagina) {
      const { data } = await ServicioPedidos.obtenerPedidos(pagina)
      commit('LLENAR_LISTA_PEDIDOS', data.pedidos)
      return Promise.resolve(data)
    },
    async guardarPedido({ commit }, pedido) {
      const { data } = await ServicioPedidos.guardarPedido(pedido)
      return Promise.resolve(data)
    },
    async eliminarPedido({ commit }, id) {
      const { data } = await ServicioPedidos.eliminarPedido(id)
      return Promise.resolve(data)
    },
    async obtenerPizzas({ commit }) {
      const { data } = await ServicioPedidos.obtenerPizzas()
      commit('LLENAR_LISTA_PIZZAS', data.pizzas)
      return Promise.resolve(data)
    }
  },
  getters: {
    listaPedidos: (state) => {
      if (state.listaPedidos.length > 0) return state.listaPedidos
    },
    listaPizzas: (state) => {
      if (state.pizzas.length > 0) return state.pizzas
    },
    paginaActual: (state) => {
      if (state.paginacion.paginaActual > 0) return state.paginacion.paginaActual
    },
    totalItems: (state) => {
      if (state.paginacion.total > 0) return state.paginacion.total
    },
    porPagina: (state) => {
      if (state.paginacion.porPagina > 0) return state.paginacion.porPagina
    }
  }
}

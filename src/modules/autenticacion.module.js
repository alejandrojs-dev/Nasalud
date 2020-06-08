import ServicioAutenticacion from '../services/ServicioAutenticacion'

export const autenticacion = {
  namespaced: true,
  state: {
    dataUsuario: {
      usuario: null,
      logueado: false,
      token: null
    }
  },
  mutations: {
    ASIGNAR_VALORES_USUARIO: (state, data) => {
      state.dataUsuario.logueado = true
      state.dataUsuario.usuario = data.usuario
      state.dataUsuario.token = data.token
    },
    LIMPIAR_VALORES_USUARIO: (state) => {
      state.dataUsuario.logueado = false
      state.dataUsuario.usuario = null
      state.dataUsuario.token = null
    }
  },
  actions: {
    async login({ commit }, loginData) {
      const { data } = await ServicioAutenticacion.login(loginData)
      commit('ASIGNAR_VALORES_USUARIO', data)
      return Promise.resolve(data)
    },
    async logout({ commit }) {
      const { data } = await ServicioAutenticacion.logout()
      commit('LIMPIAR_VALORES_USUARIO')
      return Promise.resolve(data)
    },
    async validarToken({ commit }, token) {
      const { data } = await ServicioAutenticacion.validarToken(token)
      console.log(data)
      return Promise.resolve(data)
    }
  },
  getters: {
    nombreUsuario: (state) => {
      if (state.dataUsuario.usuario) return state.dataUsuario.usuario.nombre
    },
    menusUsuario: (state) => {
      if (state.dataUsuario.usuario) return state.dataUsuario.usuario.menus
    }
  }
}

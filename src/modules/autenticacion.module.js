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
      localStorage.setItem('idUsuario', data.usuario.id)
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
      return Promise.resolve(data)
    }
  },
  getters: {
    nombreUsuario: (state) => {
      if (state.dataUsuario.usuario) return state.dataUsuario.usuario.nombre
    },
    menusUsuario: (state) => {
      if (state.dataUsuario.usuario) return state.dataUsuario.usuario.menus
    },
    estaLogueado: (state) => {
      if (state.dataUsuario.logueado) return state.dataUsuario.logueado
    },
    usuarioLogueado: (state) => {
      if (state.dataUsuario.usuario) return state.dataUsuario.usuario
    }
  }
}

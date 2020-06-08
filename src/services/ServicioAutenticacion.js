import api from '../shared/api'

class ServicioAutenticacion {
  async login(loginData) {
    return await api.post('/login', loginData)
  }

  async logout() {
    return await api.get('/logout')
  }

  async validarToken(token) {
    return await api.get(`/verificarToken/${token}`)
  }
}

export default new ServicioAutenticacion()

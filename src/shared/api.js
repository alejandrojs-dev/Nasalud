import axios from 'axios'
import config from '../config/app'
import SweetAlert from '../shared/SweetAlert'
import router from '../router/index'

const api = axios.create({
  baseURL: `${config.URI_API}`,
  headers: {
    Accept: 'application/json',
    'Content-type': 'application/json'
  }
})

api.interceptors.request.use(
  (config) => {
    if (localStorage.getItem('lsUsuario')) {
      const { autenticacion } = JSON.parse(localStorage.getItem('lsUsuario'))
      const { token } = autenticacion.dataUsuario
      if (token) {
        config.headers.common['Authorization'] = `Bearer ${token}`
      }
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

api.interceptors.response.use(
  (response) => {
    return response
  },
  async (error) => {
    if (error.response.status === 422) {
      const { errors } = error.response.data
      let mensaje = ''
      for (let e in errors) {
        mensaje += `${errors[e][0]} </br>`
      }
      const sweetAlert = new SweetAlert('error', '¡Ooops!', mensaje)
      await sweetAlert.lauchBasic()
    }

    if (error.response.status === 403 && error.response.statusText === 'Forbidden') {
      const sweetAlertConfirm = new SweetAlert(
        'warning',
        'Sesión expirada',
        'Tu sesión ha expirado. Serás redirigido a la página de inicio de sesión'
      )
      const result = await sweetAlertConfirm.lauchConfirm()
      if (result.value) {
        console.log('Bye bye!')
        localStorage.removeItem('lsUsuario')
        router.push({ name: 'Login' })
      }
    }

    if (error.response.status === 401 && error.response.statusText === 'Unauthorized') {
      if (error.type === 'login') {
        const mensaje = error.response.data.message
        const sweetAlert = new SweetAlert('error', '¡Ooops!', mensaje)
        await sweetAlert.lauchBasic()
      }

      if (error.type === 'permiso') {
        router.push({ name: 'No-autorizado' })
      }
    }
    return Promise.reject(error)
  }
)

export default api

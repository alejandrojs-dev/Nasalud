import axios from 'axios'
import config from '../config/app'
import router from '../router/index'
import Swal from 'sweetalert2'

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
  (error) => {
    if (error.response.status === 422) {
      const { errors } = error.response.data
      let mensaje = ''
      for (let e in errors) {
        mensaje += `${errors[e][0]} </br>`
      }

      Swal.fire({
        icon: 'error',
        title: '¡Ooops!',
        html: mensaje,
        showConfirmButton: true,
        position: 'center'
      })
    }

    if (error.response.status === 403 && error.response.statusText === 'Forbidden') {
      const swalBotonesBootstrap = Swal.mixin({
        customClass: {
          cancelButton: 'btn btn-danger mr-1',
          confirmButton: 'btn btn-success ml-1'
        },
        buttonsStyling: false
      })

      swalBotonesBootstrap
        .fire({
          title: 'Sesión expirada',
          text: 'Tu sesión ha expirado. Serás redirigido a la página de inicio de sesión',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          cancelButtonColor: '#d33',
          confirmButtonText: '<i class="fa fa-check-circle" aria-hidden="true"></i> Aceptar',
          cancelButtonText: '<i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar',
          reverseButtons: true
        })
        .then((result) => {
          if (result.value) {
            localStorage.removeItem('lsUsuario')
            localStorage.removeItem('lsPedidos')
            localStorage.removeItem('idUsuario')
            router.push({ name: 'Login' })
          }
        })
    }

    if (error.response.status === 401 && error.response.statusText === 'Unauthorized') {
      if (error.response.data.type === 'login') {
        const mensaje = error.response.data.message

        Swal.fire({
          icon: 'error',
          title: '¡Ooops!',
          html: mensaje,
          showConfirmButton: true,
          position: 'center'
        })
      }

      if (error.response.data.type === 'permiso') {
        router.push({ name: 'No-autorizado' })
      }
    }
    return Promise.reject(error)
  }
)

export default api

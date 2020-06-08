import store from '../store/index'

export default async function validarTokenGuard(to, from, next) {
  const lsUsuario = localStorage.getItem('lsUsuario')
  if (to.matched.some((record) => record.meta.auth) && !lsUsuario) {
    next({ name: 'Login' })
    return
  } else {
    const { token } = JSON.parse(lsUsuario).autenticacion.dataUsuario
    try {
      const response = await store.dispatch('autenticacion/validarToken', token)
      if (response.ok) {
        console.log(response)
        next()
      }
    } catch (e) {
      console.log(e.response)
    }
  }
}

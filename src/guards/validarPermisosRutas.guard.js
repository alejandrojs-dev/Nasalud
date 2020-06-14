import store from '../store/index'

export default function validarPermisosRutas(to, from, next) {
  const usuarioLogueado = store.getters['autenticacion/usuarioLogueado']
  if (to.matched.some((record) => record.meta.esAdmin) && usuarioLogueado.esAdmin) {
    next()
    return
  } else {
    if (to.matched.some((record) => record.meta.esEmpleado) && usuarioLogueado.esAdmin == false) {
      next()
      return
    } else {
      next({ name: 'No-autorizado' })
      return
    }
  }
}

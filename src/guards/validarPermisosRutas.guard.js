export default function validarPermisosRutas(to, from, next) {
  const lsUsuario = localStorage.getItem('lsUsuario')
  const usuario = JSON.parse(lsUsuario).autenticacion.dataUsuario.usuario
  if (to.matched.some((record) => record.meta.esAdmin) && usuario.esAdmin) {
    next()
    return
  } else {
    if (to.matched.some((record) => record.meta.esEmpleado) && usuario.esAdmin == false) {
      next()
      return
    } else {
      next({ name: 'No-autorizado' })
      return
    }
  }
}

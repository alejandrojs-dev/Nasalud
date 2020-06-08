export default function autenticadoGuard(to, from, next) {
  const lsUsuario = localStorage.getItem('lsUsuario')
  if (to.matched.some((record) => record.meta.auth) && !lsUsuario) {
    next({ name: 'Login' })
    return
  } else {
    next()
  }
}

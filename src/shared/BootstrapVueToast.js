export default class BootstrapVueToast {
  constructor(
    vueInstance,
    mensaje,
    titulo,
    autoHideDelay = 5000,
    appendToast = false,
    variante = 'default',
    ubicacion = 'b-toaster-top-right'
  ) {
    this.vueInstance = vueInstance
    this.mensaje = mensaje
    this.titulo = titulo
    this.autoHideDelay = autoHideDelay
    this.appendToast = appendToast
    this.variante = variante
    this.ubicacion = ubicacion
  }

  async lauchToast() {
    return await this.vueInstance.$root.$bvToast.toast(this.mensaje, {
      title: this.titulo,
      autoHideDelay: this.autoHideDelay,
      appendToast: this.appendToast,
      variant: this.variante,
      toaster: this.ubicacion
    })
  }
}

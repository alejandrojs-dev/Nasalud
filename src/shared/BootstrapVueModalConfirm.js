export default class BootstrapVueModalConfirm {
  constructor(
    vueInstance,
    mensaje,
    titulo,
    tamano,
    tamanoBotones,
    varianteOk = 'success',
    tituloOk = 'Aceptar',
    varianteCancelar = 'danger',
    tituloCancelar = 'Cancelar'
  ) {
    this.vueInstance = vueInstance
    this.mensaje = mensaje
    this.titulo = titulo
    this.tamano = tamano
    this.tamanoBotones = tamanoBotones
    this.varianteOk = varianteOk
    this.varianteCancelar = varianteCancelar
    this.tituloOk = tituloOk
    this.tituloCancelar = tituloCancelar
  }

  async launch() {
    return await this.vueInstance.$bvModal.msgBoxConfirm(this.mensaje, {
      title: this.titulo,
      size: this.tamano,
      buttonSize: this.tamanoBotones,
      okVariant: this.varianteOk,
      okTitle: this.tituloOk,
      cancelVariant: this.varianteCancelar,
      cancelTitle: this.tituloCancelar,
      footerClass: 'p-2',
      headerBgVariant: 'warning',
      hideHeaderClose: true,
      centered: true
    })
  }
}

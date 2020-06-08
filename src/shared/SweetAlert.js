import Swal from 'sweetalert2'

export default class SweetAlert {
  constructor(icono, titulo, texto, posicion = 'center', timer = 3000) {
    this.icono = icono
    this.titulo = titulo
    this.texto = texto
    this.posicion = posicion
    this.timer = timer
  }

  async lauchBasic() {
    return await Swal.fire({
      icon: this.icono,
      title: this.titulo,
      html: this.texto,
      showConfirmButton: true,
      position: this.posicion
    })
  }

  async lauchConfirm() {
    const swalBotonesBootstrap = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    return await swalBotonesBootstrap.fire({
      title: this.titulo,
      text: this.texto,
      icon: this.icono,
      showCancelButton: false,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Aceptar'
    })
  }
}

import Swal from 'sweetalert2'

export default class SweetAlert {
  constructor(icono, titulo, texto, posicion = 'center', timer = 3000) {
    this.icono = icono
    this.titulo = titulo
    this.texto = texto
    this.posicion = posicion
    this.timer = timer
  }

  lauchBasic() {
    return Swal.fire({
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
        cancelButton: 'btn btn-danger mr-1',
        confirmButton: 'btn btn-success ml-1'
      },
      buttonsStyling: false
    })

    return await swalBotonesBootstrap.fire({
      title: this.titulo,
      text: this.texto,
      icon: this.icono,
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: '<i class="fa fa-check-circle" aria-hidden="true"></i> Aceptar',
      cancelButtonText: '<i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar',
      reverseButtons: true
    })
  }
}

import Swal from 'sweetalert2'

export default class Toast {
  constructor(icono, titulo, posicion = 'botton-end', timer = 3000) {
    this.icono = icono
    this.titulo = titulo
    this.texto = texto
    this.posicion = posicion
    this.timer = timer
  }

  async lauch() {
    const Toast = Swal.mixin({
      toast: true,
      position: this.posicion,
      showConfirmButton: false,
      timer: 3000
    })

    Toast.fire({
      icon: this.icono,
      title: this.titulo
    })
  }
}

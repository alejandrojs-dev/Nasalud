export default class Pedido {
  constructor(numeroPedido, fecha, total, pizzasPedido, usuarioPedido) {
    this.numero_pedido = numeroPedido
    this.fecha = fecha
    this.total = total
    this.pizzas_pedido = pizzasPedido
    this.usuario_id = usuarioPedido
  }
}

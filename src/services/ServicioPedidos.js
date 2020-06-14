import api from '../shared/api'

class ServicioPedidos {
  async guardarPedido(pedido) {
    return await api.post('/pedidos', pedido)
  }

  async obtenerPedidos(pagina) {
    return await api.get(`/pedidos?page=${pagina}`)
  }

  async obtenerPizzas() {
    return await api.get('/pizzas')
  }

  async eliminarPedido(id) {
    return await api.delete(`/pedidos/${id}`)
  }
}

export default new ServicioPedidos()

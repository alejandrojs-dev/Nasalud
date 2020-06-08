import api from '../shared/api'

class ServicioPedidos {
  async guardarPedido(dataPedido) {
    return await api.post('/pedidos', dataPedido)
  }

  async obtenerPedidos() {
    return await api.get('/pedidos')
  }
}

export default new ServicioPedidos()

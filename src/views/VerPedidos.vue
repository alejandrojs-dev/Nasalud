<template>
  <div>
    <Menu />
    <h2 class="text-center mt-3 mb-3">Lista de pedidos</h2>
    <div class="row">
      <div class="col-md-3" v-for="pedido in listaPedidos" :key="pedido.id">
        <div class="card w-85">
          <div class="card-header text-muted">Número de pedido: {{ pedido.numero_pedido }}</div>
          <div class="card-body">
            <h5 class="card-title">Detalles:</h5>
            <p class="card-text">Fecha: {{ pedido.fecha_pedido }}</p>
            <p class="card-text">Orden realizada por: {{ pedido.usuario_pedido.nombre }}</p>
            <p class="card-text">Total a pagar: {{ pedido.total }}</p>
            <button
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#modalPizzasPedido"
              @click="obtenerPizzasPedido(pedido.id)"
            >
              Ver pizzas del pedido
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modalPizzasPedido"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalPizzasPedidoLabel"
      aria-hidden="true"
      data-backdrop="static"
      data-keyboard="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPizzasPedidoLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Tamaño</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(pizza, index) in pizzasPedido" :key="pizza.id">
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ pizza.nombre }}</td>
                  <td>{{ pizza.precio }}</td>
                  <td>{{ pizza.tamano }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from '@/components/Menu.vue'
export default {
  name: 'ListaPedidos',
  components: {
    Menu
  },
  data() {
    return {
      pizzasPedido: null
    }
  },
  computed: {
    listaPedidos() {
      return this.$store.getters['pedidos/listaPedidos']
    }
  },
  methods: {
    async obtenerListaPedidos() {
      try {
        await this.$store.dispatch('pedidos/obtenerPedidos')
      } catch (e) {
        console.log(e.response)
      }
    },
    obtenerPizzasPedido(id) {
      this.pizzasPedido = this.listaPedidos.find((x) => x.id === id).pizzas_pedido
    }
  },
  created() {
    this.obtenerListaPedidos()
  }
}
</script>

<style scoped>
.card {
  margin: 15px;
}
.row {
  margin: 5px;
}
</style>

<template>
  <div>
    <Menu />
    <h2 class="text-center mt-3 mb-3">Lista de pedidos</h2>
    <b-container class="width-container mt-4" v-if="tablaCargada">
      <b-row class="mb-2">
        <b-col lg="6"></b-col>
        <b-col lg="6" class="my-1">
          <b-form-group label="Filtrar por" label-cols-sm="3" label-align-sm="right" label-size="sm" label-for="filterInput" class="mb-0">
            <b-input-group size="sm">
              <b-form-input
                v-model="filtro"
                type="search"
                id="filtro"
                placeholder="Número pedido ó fecha ó usuario"
                autocomplete="off"
              ></b-form-input>
              <b-input-group-append>
                <b-button size="sm" @click="limpiarSearch"><b-icon icon="x-circle-fill" aria-hidden="true"></b-icon> Limpiar</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <div class="table-responsive">
            <table id="tblPedidos" class="table table-bordered text-center">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Número pedido</th>
                  <th scope="col">Fecha pedido</th>
                  <th scope="col">Total</th>
                  <th scope="col">Usuario pedido</th>
                  <th colspan="2">Acciones</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="pedido in filtroPedidos" :key="pedido.id">
                  <td>{{ pedido.numero_pedido }}</td>
                  <td>{{ pedido.fecha_pedido }}</td>
                  <td>{{ pedido.total }}</td>
                  <td>{{ pedido.usuario_pedido.nombre }}</td>
                  <td>
                    <b-button variant="info" size="sm" v-b-modal.modalPizzas @click="obtenerPizzasPedido(pedido.id)" class="mr-1">
                      <b-icon icon="eye-fill" aria-hidden="true"></b-icon> Pizzas
                    </b-button>
                    <b-button variant="danger" size="sm" @click="eliminarPedido(pedido.id)">
                      <b-icon icon="trash-fill" aria-hidden="true"></b-icon> Eliminar
                    </b-button>
                  </td>
                </tr>
              </tbody>
            </table>
            <b-alert class="text-center" show variant="secondary" v-if="noData">
              <strong>No se encontraron resultados</strong>
            </b-alert>
          </div>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <nav>
            <ul class="pagination">
              <li class="page-item" :class="[paginacion.paginaActual > 1 ? '' : 'disabled']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(paginacion.paginaActual - 1)">Anterior</a>
              </li>
              <li class="page-item" v-for="pagina in numeroPaginas" :key="pagina" :class="[pagina == paginaActiva ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagina)">{{ pagina }}</a>
              </li>
              <li class="page-item" :class="[paginacion.paginaActual < paginacion.ultimaPagina ? '' : 'disabled']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(paginacion.paginaActual + 1)">Siguiente</a>
              </li>
            </ul>
          </nav>
        </b-col>
      </b-row>
    </b-container>

    <b-modal
      id="modalPizzas"
      title="Pizzas del pedido"
      :no-close-on-backdrop="true"
      header-bg-variant="dark"
      header-text-variant="light"
      :hide-header-close="true"
      button-size="sm"
    >
      <template v-slot:modal-footer="{ ok }">
        <b-button size="sm" variant="success" @click="ok()"> <b-icon icon="check-circle-fill" aria-hidden="true"></b-icon> Aceptar</b-button>
      </template>
      <b-table striped :items="pizzasPedido" :fields="headersTablaPizzas"></b-table>
    </b-modal>
  </div>
</template>

<script>
import Menu from '@/components/Menu.vue'
import BootstrapVueToast from '../shared/BootstrapVueToast'
import SweetAlert from '../shared/SweetAlert'
export default {
  name: 'ListaPedidos',
  components: {
    Menu
  },
  data() {
    return {
      filtro: '',
      pizzasPedido: [],
      paginaInicial: 1,
      offset: 2,
      tablaCargada: false,
      noData: false,
      paginacion: {
        total: 0,
        paginaActual: 0,
        porPagina: 0,
        ultimaPagina: 0,
        from: 0,
        to: 0
      },
      headersTablaPizzas: [
        {
          key: 'nombre',
          label: 'Nombre',
          sortable: true
        },
        {
          key: 'precio',
          label: 'Precio'
        },
        {
          key: 'tamano',
          label: 'Tamaño'
        }
      ]
    }
  },
  computed: {
    paginaActiva() {
      return this.paginacion.paginaActual
    },
    listaPedidos() {
      return this.$store.getters['pedidos/listaPedidos']
    },
    filtroPedidos() {
      const resultados = this.listaPedidos.filter((item) => {
        return (
          item.fecha_pedido.includes(this.filtro) ||
          String(item.numero_pedido).includes(this.filtro) ||
          item.usuario_pedido.nombre.includes(this.filtro)
        )
      })
      if (!resultados.length) {
        this.noData = true
      } else {
        this.noData = false
      }
      return resultados
    },
    numeroPaginas() {
      if (!this.paginacion.paginaActual) {
        return []
      }

      let from = this.paginacion.paginaActual - this.offset
      if (from < 1) {
        from = 1
      }

      let to = from + this.offset * 2
      if (to >= this.paginacion.ultimaPagina) {
        to = this.paginacion.ultimaPagina
      }

      let arregloPaginas = []

      while (from <= to) {
        arregloPaginas.push(from)
        from++
      }

      return arregloPaginas
    }
  },
  methods: {
    limpiarSearch() {
      this.filtro = ''
    },
    async obtenerPedidos(pagina) {
      const loader = await this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        canCancel: true,
        transition: 'fade',
        color: '#000',
        loader: 'spinner'
      })
      try {
        const response = await this.$store.dispatch('pedidos/obtenerPedidos', pagina)
        if (response.ok) {
          this.paginacion = response.paginacion
          this.tablaCargada = true
          loader.hide()
        }
      } catch (e) {
        loader.hide()
      }
    },
    async cambiarPagina(pagina) {
      this.paginacion.paginaActual = pagina
      await this.obtenerPedidos(pagina)
    },
    async eliminarPedido(id) {
      const sweetAlertConfirm = new SweetAlert('warning', 'Eliminar pedido', '¿Estás seguro que deseas eliminar el pedido?')
      const result = await sweetAlertConfirm.lauchConfirm()
      if (result.value) {
        try {
          const response = await this.$store.dispatch('pedidos/eliminarPedido', id)
          if (response.ok) {
            const toast = new BootstrapVueToast(this, response.message, '¡Éxito!', 3000, false, 'success')
            toast.lauchToast()
            await this.obtenerPedidos(this.paginacion.paginaActual)
          }
        } catch (e) {
          console.log(e.response)
        }
      }
    },
    obtenerPizzasPedido(id) {
      this.pizzasPedido = this.listaPedidos.find((x) => x.id === id).pizzas_pedido
    }
  },
  async created() {
    await this.obtenerPedidos(this.paginaInicial)
  }
}
</script>

<style scoped>
table#tblPedidos {
  margin: 0 auto;
  margin-bottom: 5px;
}
.width-container {
  max-width: 1055px;
  margin: 0 auto;
}
</style>

<template>
  <div>
    <div class="container mx-auto p-3 mt-3" style="max-width: 600px;">
      <b-form @submit.prevent="guardarPedido()" class="form-line">
        <b-form-group id="input-group-numPedido" label="Número de pedido" label-for="numeroPedido">
          <b-input type="text" id="numeroPedido" placeholder="Número de pedido" autocomplete="off" v-model="pedido.numero_pedido"></b-input>
        </b-form-group>
        <b-form-group id="input-group-fecha" label="Fecha" label-for="fecha">
          <b-form-datepicker
            id="fecha"
            placeholder="Selecciona una fecha"
            v-model="pedido.fecha"
            local="es"
            :no-close-on-select="true"
            :hide-header="true"
            :today-button="true"
            :reset-button="true"
            :close-button="true"
            selected-variant="success"
            today-variant="info"
            today-button-variant="success"
            reset-button-variant="primary"
            close-button-variant="danger"
            label-today-button="Hoy"
            label-reset-button="Reiniciar"
            label-close-button="Cerrar"
            label-help="Use las flechas del teclado para navegar por el calendario"
            label-prev-year="Año pasado"
            label-next-year="Año siguiente"
            label-prev-month="Mes pasado"
            label-next-month="Mes siguiente"
            label-current-month="Mes actual"
          ></b-form-datepicker>
        </b-form-group>
        <b-form-group id="input-group-pizzas-pedido" label="Pizzas" label-for="mltsPizzas">
          <multiselect
            id="mltsPizzas"
            label="pizzasPedido"
            selectLabel="Presion enter para seleccionar"
            deselectLabel="Presione enter para deseleccionar"
            selectedLabel="Seleccionada"
            v-model="pizzasPedido"
            :searchable="true"
            :options="listaPizzas"
            :close-on-select="false"
            placeholder="--Seleccionar--"
            track-by="id"
            :multiple="true"
            :custom-label="customLabel"
            @select="sumarPrecio"
            @remove="descontarPrecio"
          >
          </multiselect>
        </b-form-group>
        <b-form-group id="input-group-pizzas-pedido" label="Total a pagar" label-for="total">
          <b-form-input id="total" type="text" placeholder="$0.00" :disabled="true" v-model="pedido.total"></b-form-input>
        </b-form-group>
        <b-button type="submit" variant="success" id="btnGuardarPedido" block>
          <b-icon icon="check-circle-fill" aria-hidden="true"></b-icon> Guardar
        </b-button>
      </b-form>
    </div>
  </div>
</template>

<script>
import Pedido from '../models/Pedido.model'
import Multiselect from 'vue-multiselect'
import accounting from 'accounting-js'
import BootstrapVueToast from '../shared/BootstrapVueToast'
export default {
  name: 'FormularioPedido',
  data() {
    return {
      pedido: new Pedido('', '', 0, [], Number.parseInt(localStorage.getItem('idUsuario'))),
      pizzasPedido: [],
      pizzas: []
    }
  },
  components: {
    Multiselect
  },
  computed: {
    listaPizzas() {
      return this.$store.getters['pedidos/listaPizzas']
    },
    usuarioLogueado() {
      return this.$store.getters['autenticacion/usuarioLogueado']
    },
    idsPizzas() {
      return this.pizzasPedido.map((pizza) => pizza.id)
    },
    numeroPedidoInt() {
      return Number.parseInt(this.pedido.numero_pedido)
    }
  },
  methods: {
    customLabel(opcion) {
      return `${opcion.nombre} - ${opcion.precio} - ${opcion.tamano}`
    },
    sumarPrecio(opcion) {
      this.pedido.total += opcion.precio_sin_formato
    },
    descontarPrecio(opcion) {
      this.pedido.total -= opcion.precio_sin_formato
    },
    async obtenerListaPizzas() {
      const loader = this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        canCancel: true,
        transition: 'fade',
        color: '#000',
        loader: 'spinner'
      })
      try {
        const response = await this.$store.dispatch('pedidos/obtenerPizzas')
        if (response.ok) {
          this.pizzas = response.pizzas
          loader.hide()
        }
      } catch (e) {
        loader.hide()
      }
    },
    async guardarPedido() {
      this.pedido.pizzas_pedido = this.idsPizzas
      this.pedido.numero_pedido = this.pedido.numero_pedido != '' ? this.numeroPedidoInt : ''

      const loader = this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        canCancel: true,
        transition: 'fade',
        color: '#000',
        loader: 'spinner'
      })

      try {
        const response = await this.$store.dispatch('pedidos/guardarPedido', this.pedido)
        if (response.ok) {
          const toast = new BootstrapVueToast(this, response.message, '¡Éxito!', 3000, false, 'success')
          toast.lauchToast()
          loader.hide()

          const usuarioLogueado = this.usuarioLogueado

          if (usuarioLogueado.esAdmin) {
            this.$router.push({ path: 'ver' })
          } else {
            this.$router.push({ path: '/inicio' })
          }
        }
      } catch (e) {
        loader.hide()
      }
    }
  },
  async created() {
    await this.obtenerListaPizzas()
  },
  mounted() {}
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.container {
  max-width: 600px;
}
form.form-line {
  border: 1px solid #9c9c9c;
  border-radius: 5px;
  padding: 20px;
}
</style>

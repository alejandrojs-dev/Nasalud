<template>
  <div>
    <Menu />
    <h2 class="text-center mt-3 mb-3">Nuevo pedido</h2>
    <FormularioPedido />
  </div>
</template>

<script>
import Menu from '@/components/Menu.vue'
import FormularioPedido from '@/components/FormularioPedido.vue'
export default {
  name: 'NuevoPedido',
  components: {
    Menu,
    FormularioPedido
  }
}
</script>

<style></style>

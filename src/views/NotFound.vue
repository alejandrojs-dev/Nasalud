<template>
  <b-container id="noEncontrado" fluid>
    <b-col class="text-center mb-3">
      <img id="img404" alt="Vue logo" src="../assets/sad-face.png" />
    </b-col>
    <b-col class="mb-3">
      <h1 class="text-center">¡Oops! 404 No encontrado</h1>
    </b-col>
    <b-col class="text-center">
      <b-button variant="success" @click="regresarInicio"><i class="fa fa-home" aria-hidden="true"></i> Ir a inicio</b-button>
    </b-col>
  </b-container>
</template>

<script>
export default {
  name: 'NotFound',
  data() {
    return {}
  },
  methods: {
    regresarInicio() {
      this.$router.push({ name: 'Inicio' })
    }
  }
}
</script>

<style>
div#noEncontrado {
  max-width: 1000px;
  margin-top: 150px;
}
img#img404 {
  max-width: 100px;
}
</style>

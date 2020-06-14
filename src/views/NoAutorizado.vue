<template>
  <b-container id="noAutorizado" fluid>
    <b-col class="text-center mb-3">
      <img id="img401" alt="Vue logo" src="../assets/lock.png" />
    </b-col>
    <b-col class="mb-3">
      <h1 class="text-center">¡Oops! 401 No autorizado</h1>
    </b-col>
    <b-col class="text-center">
      <b-button variant="success" @click="regresarInicio"><i class="fa fa-home" aria-hidden="true"></i> Ir a inicio</b-button>
    </b-col>
  </b-container>
</template>

<script>
export default {
  name: 'NoAutorizado',
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
div#noAutorizado {
  max-width: 1000px;
  margin-top: 150px;
}
img#img401 {
  max-width: 100px;
}
</style>

<template>
  <div>
    <div class="container mx-auto p-3">
      <h3 class="text-center mb-2">Inicio de sesión</h3>
      <form @submit.prevent="login()">
        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">Correo</label>
          <div class="col-sm-10">
            <input
              type="text"
              class="form-control"
              id="email"
              name="email"
              placeholder="ejemplo@ejemplo.com"
              autocomplete="off"
              v-model.trim="$v.loginData.email.$model"
              :class="{ 'is-invalid': $v.loginData.email.$error }"
            />
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
          <div class="col-sm-10">
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Contraseña"
              autocomplete="off"
              v-model.trim="$v.loginData.password.$model"
              :class="{ 'is-invalid': $v.loginData.password.$error }"
            />
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Entrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Login from '../models/Login.model'
import { required } from 'vuelidate/lib/validators'
export default {
  name: 'FormularioLogin',
  data() {
    return {
      loginData: new Login('', ''),
      errorLogin: false
    }
  },
  validations: {
    loginData: {
      email: {
        required
      },
      password: {
        required
      }
    }
  },
  methods: {
    async login() {
      try {
        const response = await this.$store.dispatch('autenticacion/login', this.$v.loginData.$model)
        if (response.ok) {
          this.$router.push({ name: 'Inicio' })
        }
      } catch (e) {
        if (e.response.data.errors) {
          this.$v.$touch()
        }
      }
    }
  }
}
</script>

<style scoped>
.container {
  margin-top: 150px;
  max-width: 600px;
  border: 1px solid #9c9c9c;
  border-radius: 5px;
  background-color: #eaeaea;
}
</style>

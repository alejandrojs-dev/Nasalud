<template>
  <div>
    <div class="container mx-auto p-3">
      <h3 class="text-center mb-2">Inicio de sesión</h3>
      <b-form @submit.prevent="login()" class="form-line">
        <b-form-group id="input-group-correo" label="Correo" label-for="email">
          <b-form-input
            id="email"
            type="text"
            placeholder="example@example.com"
            aria-autocomplete="off"
            v-model.trim="$v.loginData.email.$model"
            :class="{ 'is-invalid': $v.loginData.email.$error }"
            autocomplete="off"
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-password" label="Contraseña" label-for="password">
          <b-form-input
            id="password"
            type="password"
            placeholder="Contraseña"
            aria-autocomplete="off"
            v-model.trim="$v.loginData.password.$model"
            :class="{ 'is-invalid': $v.loginData.password.$error }"
          ></b-form-input>
        </b-form-group>
        <b-button type="submit" :block="true" variant="primary">
          Iniciar sesión <b-icon icon="box-arrow-in-right" aria-hidden="true"></b-icon>
        </b-button>
      </b-form>
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
      loginData: new Login('', '')
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
      const loader = this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        canCancel: true,
        transition: 'fade',
        color: '#000',
        loader: 'spinner'
      })
      try {
        const response = await this.$store.dispatch('autenticacion/login', this.$v.loginData.$model)
        if (response.ok) {
          this.$router.push({ name: 'Inicio' })
          loader.hide()
        }
      } catch (e) {
        loader.hide()
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
}

form.form-line {
  border: 1px solid #9c9c9c;
  border-radius: 5px;
  background-color: #eaeaea;
  padding: 20px;
}
</style>

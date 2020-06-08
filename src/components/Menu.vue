<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <router-link class="navbar-brand" :to="{ name: 'Inicio' }">Panel Pizzas</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown" v-for="menu in menusUsuario" :key="menu.id">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ menu.nombre }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <router-link
                class="dropdown-item"
                :to="{ path: `${submenu.path}` }"
                v-for="submenu in menu.submenus"
                :key="submenu.id"
                >{{ submenu.nombre }}
              </router-link>
            </div>
          </li>
        </ul>

        <ul class="navbar-nav" id="navbar-login">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ nombreUsuario }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" @click.prevent="logout()" href="">Cerrar sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'Menu',
  data() {
    return {}
  },
  computed: {
    nombreUsuario() {
      return this.$store.getters['autenticacion/nombreUsuario']
    },
    menusUsuario() {
      return this.$store.getters['autenticacion/menusUsuario']
    }
  },
  methods: {
    async logout() {
      try {
        const response = await this.$store.dispatch('autenticacion/logout')
        if (response.ok) {
          localStorage.removeItem('lsUsuario')
          this.$router.push({ name: 'Login' })
          console.log('Bye bye!')
        }
      } catch (e) {
        console.log(e.response)
      }
    }
  },
  created() {}
}
</script>

<style scoped>
ul#navbar-login {
  margin-right: 6em;
}
</style>

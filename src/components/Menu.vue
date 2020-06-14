<template>
  <div>
    <b-navbar type="light" variant="light">
      <router-link class="navbar-brand" :to="{ name: 'Inicio' }">Panel Pizzas</router-link>
      <b-navbar-nav>
        <b-nav-item-dropdown right v-for="menu in menusUsuario" :key="menu.id">
          <template v-slot:button-content><b-icon :icon="menu.icono" aria-hidden="true"></b-icon> {{ menu.nombre }} </template>
          <router-link class="dropdown-item" :to="{ path: `${submenu.path}` }" v-for="submenu in menu.submenus" :key="submenu.id"
            ><b-icon :icon="submenu.icono" aria-hidden="true"></b-icon> {{ submenu.nombre }}
          </router-link>
        </b-nav-item-dropdown>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown right>
          <template v-slot:button-content><b-icon icon="person-fill" aria-hidden="true"></b-icon> {{ nombreUsuario }} </template>
          <b-dropdown-item @click.prevent="logout()" href=""
            ><b-icon icon="door-closed-fill" aria-hidden="true"></b-icon> Cerrar sesión</b-dropdown-item
          >
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>
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
        const loader = this.$loading.show({
          container: this.fullPage ? null : this.$refs.formContainer,
          canCancel: true,
          transition: 'fade',
          color: '#000',
          loader: 'spinner'
        })

        const response = await this.$store.dispatch('autenticacion/logout')

        if (response.ok) {
          localStorage.removeItem('lsUsuario')
          localStorage.removeItem('lsPedidos')
          localStorage.removeItem('idUsuario')
          this.$router.push({ name: 'Login' })
          loader.hide()
        }
      } catch (e) {
        console.log(e.response)
        loader.hide()
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
.avatar-div {
  margin: 2em;
  margin-left: 6em;
  margin-right: 6em;
  margin-top: 2em;
  width: 100px;
}
</style>

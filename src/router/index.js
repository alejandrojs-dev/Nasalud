import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Pedidos from '../components/Pedidos.vue'
import NuevoPedido from '../views/NuevoPedido'
import VerPedidos from '../views/VerPedidos.vue'
import NotFound from '../views/NotFound.vue'
import NoAutorizado from '../views/NoAutorizado'

//Guards
import validarPermisosRutas from '../guards/validarPermisosRutas.guard'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      title: 'Iniciar sesión - Panel Pizzas'
    }
  },
  {
    path: '/inicio',
    name: 'Inicio',
    component: Home,
    meta: {
      title: 'Inicio - Panel Pizzas',
      auth: true
    }
  },
  {
    path: '/pedidos',
    component: Pedidos,
    name: 'Pedidos',
    children: [
      {
        path: 'nuevoPedido',
        component: NuevoPedido,
        beforeEnter: validarPermisosRutas,
        meta: {
          title: 'Nuevo Pedido - Pizzas Panel',
          auth: true,
          esAdmin: true,
          esEmpleado: true
        }
      },
      {
        path: 'ver',
        component: VerPedidos,
        beforeEnter: validarPermisosRutas,
        meta: {
          title: 'Pedidos - Pizzas Panel',
          auth: true,
          esAdmin: true,
          esEmpleado: false
        }
      }
    ]
  },
  {
    path: '*',
    name: 'Not-found',
    component: NotFound
  },
  {
    path: '/noAutorizado',
    name: 'No-autorizado',
    component: NoAutorizado,
    meta: {
      title: 'No Autorizdo - Pizzas Panel'
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  const lsUsuario = localStorage.getItem('lsUsuario')
  if (to.matched.some((record) => record.meta.auth) && !lsUsuario) {
    next({ name: 'Login' })
  } else {
    if (to.name === 'Login' && lsUsuario) {
      next({ name: 'Inicio' })
    }
    next()
  }
})

export default router

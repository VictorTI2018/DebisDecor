import Vue from 'vue'
import VueRouter from 'vue-router'
import session from '../utils/session'
import Home from '../views/Home.vue'

// Trabalhos
import Trabalhos from '../views/trabalhos/Trabalhos.vue'
import AddTrabalho from '../views/trabalhos/AddTrabalho.vue'

//Autenticação
import Login from '../views/login/Login.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { title: 'Login', public: true }
  },
  {
    path: '/',
    component: Home,
    children: [
      {
        path: '/',
        redirect: '/trabalhos'
      },
      {
        path: '/trabalhos',
        name: 'trabalhos',
        component: Trabalhos,
        meta: { title: 'Trabalhos' }
      },
      {
        path: '/add-trabalhos',
        name: 'add-trabalhos',
        component: AddTrabalho,
        meta: { title: 'Novo Trabalho' }
      }
    ]
  }
]

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next) => {
  checkSession(to, next)
})

const checkSession = (to, next) => {
  if (session.exists()) {
    if (!to.name === "login") {
      next({ path: '/' })
    } else {
      next()
    }
  } else if (!to.meta.public) {
    next({ name: 'login' })
  } else {
    next()
  }
}

export default router

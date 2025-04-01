import { createRouter, createWebHistory } from 'vue-router'
import Login from '../components/Login.vue'
import AnimalList from '../components/AnimalList.vue'
import { ApiAuthService } from '../services/apiAuth'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/animals',
      name: 'Animals',
      component: AnimalList,
      meta: { requiresAuth: true }
    },
    {
      path: '/',
      redirect: '/animals'
    }
  ]
})

// Navigation guard
router.beforeEach((to, from, next) => {
  const apiAuth = new ApiAuthService()
  
  if (to.meta.requiresAuth && !apiAuth.isAuthenticated()) {
    next('/login')
  } else {
    next()
  }
})

export default router 
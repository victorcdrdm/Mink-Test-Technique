import { createRouter, createWebHistory } from 'vue-router'
import Login from '../components/Login.vue'
import AnimalList from '../components/AnimalList.vue'
import AdminAnimalList from '../components/AdminAnimalList.vue'
import BreedForm from '../components/BreedForm.vue'
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
      path: '/admin',
      name: 'admin',
      component: AdminAnimalList,
      meta: { requiresAuth: true }
    },
    {
      path: '/',
      name: 'Animals',
      component: AnimalList,
      meta: { requiresAuth: true }
    },
  
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
import { createRouter, createWebHistory } from 'vue-router'
import AnimalList from '../components/AnimalList.vue'
import { ApiAuthService } from '../services/apiAuth'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Animals',
      component: AnimalList,
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
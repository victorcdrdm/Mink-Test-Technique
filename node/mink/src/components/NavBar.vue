<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { ApiAuthService } from '../services/apiAuth'

const router = useRouter()
const apiAuth = new ApiAuthService()
const isAuthenticated = ref(false)

const checkAuth = () => {
  isAuthenticated.value = apiAuth.isAuthenticated()
}

const handleLogout = () => {
  apiAuth.logout()
  router.push('/login')
}

onMounted(() => {
  checkAuth()
})
</script>

<template>
  <nav class="navbar">
    <div class="navbar-brand">
      <router-link to="/" class="logo">Animal Management</router-link>
    </div>
    
    <div class="navbar-menu">
      <router-link to="/animals" class="nav-link">Animals</router-link>
    </div>

    <div class="navbar-end">
      <template v-if="isAuthenticated">
        <button class="logout-button" @click="handleLogout">
          Logout
        </button>
      </template>
      <template v-else>
        <router-link to="/login" class="login-button">
          Login
        </router-link>
      </template>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background-color: white;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.navbar-brand {
  display: flex;
  align-items: center;
}

.logo {
  font-size: 1.5rem;
  font-weight: 700;
  color: #2c3e50;
  text-decoration: none;
}

.navbar-menu {
  display: flex;
  gap: 1.5rem;
}

.nav-link {
  color: #495057;
  text-decoration: none;
  font-weight: 500;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  transition: background-color 0.2s;
}

.nav-link:hover {
  background-color: #f8f9fa;
}

.navbar-end {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.login-button, .logout-button {
  padding: 0.5rem 1rem;
  border-radius: 4px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.login-button {
  background-color: #007bff;
  color: white;
  text-decoration: none;
}

.login-button:hover {
  background-color: #0056b3;
}

.logout-button {
  background-color: #dc3545;
  color: white;
  border: none;
}

.logout-button:hover {
  background-color: #c82333;
}

@media (max-width: 768px) {
  .navbar {
    padding: 1rem;
    flex-direction: column;
    gap: 1rem;
  }

  .navbar-menu {
    width: 100%;
    justify-content: center;
  }

  .navbar-end {
    width: 100%;
    justify-content: center;
  }

  .login-button, .logout-button {
    width: 100%;
    text-align: center;
  }
}
</style> 
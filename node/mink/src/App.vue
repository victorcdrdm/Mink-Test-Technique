<script setup lang="ts">
// import { onMounted } from 'vue'
import { ApiAuthService } from './services/apiAuth'
import { useRouter } from 'vue-router'

const router = useRouter()
const apiAuth = new ApiAuthService()

// onMounted(() => {
//   // Check if user is authenticated on app load
//   if (!apiAuth.isAuthenticated()) {
//     router.push('/login')
//   }
// })
</script>

<template>
  <div class="app">
    <NavBar />
    <main class="main-content">
      <router-view></router-view>
    </main>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin: 0;
  padding: 0;
  min-height: 100vh;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  margin: 0;
  padding: 0;
  background-color: #f8f9fa;
}

.app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.main-content {
  flex: 1;
  padding: 2rem;
}
</style>

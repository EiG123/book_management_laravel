<!-- src/views/Dashboard.vue -->
<template>
  <div>
    <h2>Welcome, {{ user.name }}</h2>
    <button @click="logout">Logout</button>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import API from '../api'
import { useRouter } from 'vue-router'

const user = ref({})
const router = useRouter()

onMounted(async () => {
  try {
    const res = await API.get('/me')
    user.value = res.data
  } catch {
    router.push('/login') // ถ้า token ไม่ valid ให้กลับไป login
  }
})

const logout = async () => {
  await API.post('/logout')
  localStorage.removeItem('token')
  router.push('/login')
}
</script>

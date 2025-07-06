<!-- layouts/DefaultLayout.vue -->
<template>
  <div class="min-h-screen bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4">
      <h1 class="text-xl font-semibold">📚 Book Management</h1>
      <button @click="logout">Logout</button>
    </header>

    <main class="p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
// ไม่มี logic ตอนนี้
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

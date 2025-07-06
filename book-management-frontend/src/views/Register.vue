<!-- src/views/Register.vue -->
<template>
  <form @submit.prevent="register" class="space-y-4 max-w-md mx-auto">
    <input v-model="name" placeholder="Name" class="border p-2 w-full" />
    <input v-model="email" placeholder="Email" class="border p-2 w-full" />
    <input v-model="password" placeholder="Password" type="password" class="border p-2 w-full" />
    <input
      v-model="confirm"
      placeholder="Confirm Password"
      type="password"
      class="border p-2 w-full"
    />
    <button type="submit" class="bg-blue-500 text-white px-4 py-2">Register</button>
  </form>

  <p v-if="error">{{ error }}</p>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import API from '../api'

const router = useRouter()
const name = ref('')
const email = ref('')
const password = ref('')
const confirm = ref('')
const error = ref(null) // ✅ ประกาศ error ที่ใช้กับ <p v-if="error">

const register = async () => {
  try {
    await API.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: confirm.value,
    })
    router.push('/login')
  } catch (error) {
    error.value = 'Register failed'
    alert('ไม่สามารถสมัครสมาชิกได้')
  }
}
</script>

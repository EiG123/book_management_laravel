<!-- src/views/Register.vue -->
<template>
  <form @submit.prevent="register">
    <input v-model="name" placeholder="Name" />
    <input v-model="email" placeholder="Email" />
    <input v-model="password" placeholder="Password" type="password" />
    <input v-model="confirm" placeholder="Confirm Password" type="password" />
    <button type="submit">Register</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import API from '../api'

const name = ref('')
const email = ref('')
const password = ref('')
const confirm = ref('')

const register = async () => {
  await API.post('/register', {
    name: name.value,
    email: email.value,
    password: password.value,
    password_confirmation: confirm.value,
  })
}
</script>

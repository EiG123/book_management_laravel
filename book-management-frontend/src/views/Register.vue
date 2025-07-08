<!-- src/views/Register.vue -->
<template>
  <div
    class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <!-- Header -->
      <div class="text-center">
        <div class="mx-auto h-12 w-12 bg-indigo-600 rounded-full flex items-center justify-center mb-4">
          <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">สมัครสมาชิก</h2>
        <p class="mt-2 text-sm text-gray-600">กรุณากรอกข้อมูลเพื่อสมัครสมาชิก</p>
      </div>

      <!-- Form -->
      <div class="bg-white rounded-xl shadow-lg p-8">
        <form @submit.prevent="register" class="space-y-6">
          <!-- Name Input -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">ชื่อ</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <input id="name" v-model="name" type="text" required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                placeholder="กรุณากรอกชื่อ" />
            </div>
          </div>

          <!-- Email Input -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">อีเมล</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                  </path>
                </svg>
              </div>
              <input id="email" v-model="email" type="email" required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                placeholder="กรุณากรอกอีเมล" />
            </div>
          </div>

          <!-- Password Input -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">รหัสผ่าน</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                  </path>
                </svg>
              </div>
              <input id="password" v-model="password" type="password" required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                placeholder="กรุณากรอกรหัสผ่าน" />
            </div>
          </div>

          <!-- Confirm Password Input -->
          <div>
            <label for="confirm" class="block text-sm font-medium text-gray-700 mb-2">ยืนยันรหัสผ่าน</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <input id="confirm" v-model="confirm" type="password" required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                placeholder="กรุณายืนยันรหัสผ่าน" />
            </div>
          </div>

          <!-- Submit Button -->
          <div>
            <button type="submit" :disabled="isLoading"
              class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-200 hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg v-if="!isLoading" class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <svg v-else class="animate-spin h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </span>
              {{ isLoading ? 'กำลังสมัครสมาชิก...' : 'สมัครสมาชิก' }}
            </button>
          </div>
        </form>

        <!-- Error Message -->
        <div v-if="error" class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
          <div class="flex items-center">
            <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                clip-rule="evenodd"></path>
            </svg>
            <p class="text-sm text-red-600">{{ error }}</p>
          </div>
        </div>

        <!-- Login Link -->
        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            มีบัญชีอยู่แล้ว?
            <router-link to="/login"
              class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
              เข้าสู่ระบบ
            </router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
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
const error = ref(null)
const isLoading = ref(false)

const register = async () => {
  // Clear previous errors and set loading state
  error.value = null
  isLoading.value = true

  try {
    // Validate form
    if (!name.value || !email.value || !password.value || !confirm.value) {
      error.value = 'กรุณากรอกข้อมูลให้ครบถ้วน'
      return
    }

    if (password.value !== confirm.value) {
      error.value = 'รหัสผ่านไม่ตรงกัน'
      return
    }

    if (password.value.length < 6) {
      error.value = 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร'
      return
    }

    // Validate email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(email.value)) {
      error.value = 'รูปแบบอีเมลไม่ถูกต้อง'
      return
    }

    // Make API call
    await API.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: confirm.value,
    })

    // Success - redirect to login
    router.push('/login')
  } catch (err) {
    // Handle different types of errors
    if (err.response?.data?.message) {
      error.value = err.response.data.message
    } else if (err.response?.data?.errors) {
      // Handle validation errors from backend
      const errorMessages = {
        'The email has already been taken.': 'อีเมลนี้ถูกใช้งานแล้ว',
        'The password confirmation does not match.': 'รหัสผ่านและยืนยันรหัสไม่ตรงกัน',
        'The name field is required.': 'กรุณากรอกชื่อ',
        'The email field is required.': 'กรุณากรอกอีเมล',
        'The password field is required.': 'กรุณากรอกรหัสผ่าน',
        'The email must be a valid email address.': 'รูปแบบอีเมลไม่ถูกต้อง',
        'The password must be at least 6 characters.': 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร',
        // เพิ่มได้เรื่อย ๆ
      }

      const errors = err.response.data.errors
      const firstMessage = Object.values(errors)[0]?.[0] ?? 'เกิดข้อผิดพลาด'
      error.value = errorMessages[firstMessage] || firstMessage
    } else {
      error.value = 'ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง'
    }
  } finally {
    isLoading.value = false
  }
}
</script>
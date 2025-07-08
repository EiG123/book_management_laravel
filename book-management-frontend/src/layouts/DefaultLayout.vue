<!-- layouts/DefaultLayout.vue -->
<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo and Title -->
          <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-2 rounded-lg">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
              Book Management
            </h1>
          </div>

          <!-- User Info and Logout -->
          <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
              <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                <span class="text-white font-semibold text-sm">
                  {{ user.name ? user.name.charAt(0).toUpperCase() : 'U' }}
                </span>
              </div>
              <div class="hidden sm:block">
                <p class="text-sm font-medium text-gray-700">Welcome back,</p>
                <p class="text-lg font-semibold text-gray-900">{{ user.name || 'User' }}</p>
              </div>
            </div>
            
            <button 
              @click="logout" 
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:scale-105 shadow-lg"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              Logout
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="p-6">
          <slot />
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <p class="text-sm text-gray-500">
            © 2025 Book Management System. All rights reserved.
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Help</a>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Support</a>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Privacy</a>
          </div>
        </div>
      </div>
    </footer>

    <!-- Loading Overlay -->
    <div v-if="isLoading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <span class="text-gray-700">Loading...</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import API from '../api'
import { useRouter } from 'vue-router'

const user = ref({})
const router = useRouter()
const isLoading = ref(false)

onMounted(async () => {
  isLoading.value = true
  try {
    const res = await API.get('/me')
    user.value = res.data
  } catch (error) {
    console.error('Authentication failed:', error)
    router.push('/login')
  } finally {
    isLoading.value = false
  }
})

const logout = async () => {
  try {
    isLoading.value = true
    await API.post('/logout')
    localStorage.removeItem('token')
    router.push('/login')
  } catch (error) {
    console.error('Logout failed:', error)
    // ลบ token และ redirect แม้ logout ไม่สำเร็จ
    localStorage.removeItem('token')
    router.push('/login')
  } finally {
    isLoading.value = false
  }
}
</script>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* Smooth transitions */
* {
  transition: all 0.2s ease-in-out;
}

/* Hover effects */
button:hover {
  transform: translateY(-1px);
}

/* Focus states */
button:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>
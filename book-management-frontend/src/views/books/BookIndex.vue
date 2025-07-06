<!-- views/BookIndex.vue -->
<template>
  <DefaultLayout>
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-bold text-gray-800">📚 รายการหนังสือ</h2>
      <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
        ➕ เพิ่มหนังสือ
      </button>
    </div>

    <ul class="grid gap-4">
      <li
        v-for="book in books"
        :key="book.id"
        class="bg-white rounded-xl shadow p-6 border border-gray-200"
      >
        <div class="flex justify-between items-start">
          <div>
            <h3 class="text-xl font-semibold text-gray-900">{{ book.title }}</h3>
            <p class="text-gray-600">✍️ ผู้เขียน: {{ book.author }}</p>
            <p class="text-gray-600">📅 ปีที่พิมพ์: {{ book.published_year || 'ไม่ระบุ' }}</p>
            <p class="text-gray-600">🏷️ ประเภท: {{ book.genre || 'ไม่ระบุ' }}</p>
          </div>

          <div class="flex gap-2">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
              🔍 ดู
            </button>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
              ✏️ แก้ไข
            </button>
            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
              🗑️ ลบ
            </button>
          </div>
        </div>
      </li>
    </ul>
  </DefaultLayout>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import API from '@/api' // สมมติว่าคุณมี axios instance ชื่อ API

const books = ref([])

onMounted(async () => {
  try {
    const response = await API.get('/books')
    books.value = response.data.data || response.data // เผื่อเป็น Laravel pagination
  } catch (error) {
    console.error('โหลดหนังสือล้มเหลว:', error)
  }
})
</script>

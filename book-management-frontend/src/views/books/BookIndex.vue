<!-- views/BookIndex.vue -->
<template>
  <DefaultLayout>
    <h2 class="text-2xl font-bold mb-4">📖 รายการหนังสือ</h2>

    <ul class="space-y-2">
      <li v-for="book in books" :key="book.id" class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold">{{ book.title }}</h3>
        <p class="text-sm text-gray-600">ผู้เขียน: {{ book.author }}</p>
        <p class="text-sm text-gray-600">ปีที่พิมพ์: {{ book.published_year || 'ไม่ระบุ' }}</p>
        <p class="text-sm text-gray-600">ประเภท: {{ book.genre || 'ไม่ระบุ' }}</p>
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

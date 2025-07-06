<template>
  <DefaultLayout>
    <div class="max-w-2xl mx-auto bg-white shadow-md p-6 rounded-lg mt-6">
      <h2 class="text-2xl font-bold mb-4 text-indigo-700">📘 รายละเอียดหนังสือ</h2>
      <button @click="deleteBook(book)"
        class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200"
        v-if="book.user_id === currentUser?.id">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
          </path>
        </svg>
      </button>

      <div class="space-y-3 text-gray-800">
        <p><span class="font-semibold">ชื่อหนังสือ:</span> {{ book.title }}</p>
        <p><span class="font-semibold">ผู้เขียน:</span> {{ book.author }}</p>
        <p><span class="font-semibold">ปีที่พิมพ์:</span> {{ book.published_year || 'ไม่ระบุ' }}</p>
        <p><span class="font-semibold">ประเภท:</span> {{ book.genre || 'ไม่ระบุ' }}</p>
        <p><span class="font-semibold">วันที่พิมพ์:</span> {{ formatDateTime(book.created_at) }}</p>
        <p><span class="font-semibold">วันที่ได้รับการอัพเดท:</span> {{ formatDateTime(book.updated_at) }}</p>
        <p><span class="font-semibold">เขียนโดย:</span> {{ book.by || 'ไม่ระบุ' }}</p>
      </div>

      <div class="mt-6 flex justify-between">
        <router-link v-if="book.user_id === currentUser?.id" :to="`/books/${book.id}/edit`"
          class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
          ✏️ แก้ไข
        </router-link>

        <router-link to="/books" class="text-gray-500 hover:underline text-sm">
          ⬅️ กลับไปหน้ารายการ
        </router-link>
      </div>

      <p v-if="error" class="text-red-600 mt-4">{{ error }}</p>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import API from '@/api'
import router from '@/router'

const route = useRoute()
const id = route.params.id
const book = ref({})
const error = ref('')

const currentUser = ref(null)

onMounted(async () => {
  try {
    const res = await API.get(`/books/${id}`)
    book.value = res.data

    const me = await API.get('/me')
    currentUser.value = me.data
  } catch (err) {
    error.value = 'ไม่สามารถโหลดข้อมูลหนังสือได้'
    console.error(err)
  }
})

const formatDateTime = (datetimeStr) => {
  return datetimeStr
    ? new Date(datetimeStr).toLocaleString('th-TH', {
      dateStyle: 'long',
      timeStyle: 'short',
    })
    : 'ไม่ระบุ'
}

const deleteBook = async (book) => {
  if (confirm(`คุณต้องการลบหนังสือ "${book.title}" หรือไม่?`)) {
    try {
      await API.delete(`/books/${book.id}`)
      router.push('/books')
    } catch (error) {
      console.error('ลบหนังสือล้มเหลว:', error)
      alert('ไม่สามารถลบหนังสือได้')
    }
  }
}


</script>

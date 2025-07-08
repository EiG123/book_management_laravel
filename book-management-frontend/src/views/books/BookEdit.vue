<template>
  <DefaultLayout>
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">✏️ แก้ไขข้อมูลหนังสือ</h2>

      <form @submit.prevent="updateBook" class="space-y-4">
        <div>
          <label class="block text-gray-700 font-semibold">ชื่อหนังสือ</label>
          <input v-model.trim="form.title" type="text"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            required />

        </div>

        <div>
          <label class="block text-gray-700 font-semibold">ผู้เขียน</label>
          <input v-model.trim="form.author" type="text"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            required />
        </div>

        <div>
          <label class="block text-gray-700 font-semibold">ปีที่พิมพ์</label>
          <input v-model="form.published_year" type="number"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" />
        </div>

        <div>
          <label class="block text-gray-700 font-semibold">ประเภท</label>
          <input v-model="form.genre" type="text"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" />
        </div>

        <div class="flex justify-between items-center">
          <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
            {{ loading ? 'กำลังอัปเดต...' : 'อัปเดตข้อมูล' }}
          </button>

          <router-link to="/books" class="text-sm text-gray-500 hover:underline">⬅️ กลับ</router-link>
        </div>
      </form>

      <p v-if="error" class="text-red-600 mt-4">{{ error }}</p>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import API from '@/api'

const route = useRoute()
const router = useRouter()
const id = route.params.id

const form = ref({
  title: '',
  author: '',
  published_year: '',
  genre: '',
})

const error = ref('')

const loadBook = async () => {
  try {
    const res = await API.get(`/books/${id}`)
    form.value = res.data
  } catch (err) {
    error.value = 'ไม่สามารถโหลดข้อมูลหนังสือได้'
    console.error(err)
  }
}

const loading = ref(false)

const updateBook = async () => {
  loading.value = true
  error.value = ''

  // Validate
  if (!form.value.title.trim() || !form.value.author.trim()) {
    error.value = 'กรุณากรอกชื่อหนังสือและผู้เขียน'
    loading.value = false
    return
  }

  try {
    // กรณี published_year ว่างให้ส่ง null
    if (!form.value.published_year) {
      form.value.published_year = null
    }

    await API.put(`/books/${id}`, form.value)
    router.push('/books')
  } catch (err) {
    error.value = 'อัปเดตไม่สำเร็จ'
    console.error(err)
  } finally {
    loading.value = false
  }
}


onMounted(() => {
  loadBook()
})
</script>

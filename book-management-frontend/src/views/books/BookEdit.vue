<template>
  <DefaultLayout>
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">✏️ แก้ไขข้อมูลหนังสือ</h2>

      <form @submit.prevent="updateBook" class="space-y-4">
        <div>
          <label class="block text-gray-700 font-semibold">ชื่อหนังสือ</label>
          <input v-model="form.title" type="text" class="w-full border border-gray-300 rounded px-3 py-2" required />
        </div>

        <div>
          <label class="block text-gray-700 font-semibold">ผู้เขียน</label>
          <input v-model="form.author" type="text" class="w-full border border-gray-300 rounded px-3 py-2" required />
        </div>

        <div>
          <label class="block text-gray-700 font-semibold">ปีที่พิมพ์</label>
          <input v-model="form.published_year" type="number" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div>
          <label class="block text-gray-700 font-semibold">ประเภท</label>
          <input v-model="form.genre" type="text" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div class="flex justify-between items-center">
          <button
            type="submit"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow"
          >
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
  try {
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

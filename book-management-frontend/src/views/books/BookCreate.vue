<template>
  <DefaultLayout>
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">➕ เพิ่มหนังสือใหม่</h2>

      <form @submit.prevent="submitForm" class="space-y-4">
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

        <div class="flex justify-end">
          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
          >
            บันทึก
          </button>
        </div>
      </form>

      <p v-if="error" class="text-red-600 mt-4">{{ error }}</p>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import API from '@/api' // Axios instance
import { useRouter } from 'vue-router'

const router = useRouter()
const form = ref({
  title: '',
  author: '',
  published_year: '',
  genre: '',
})
const error = ref('')

const submitForm = async () => {
  try {
    await API.post('/books', form.value)
    router.push('/index') // กลับไปหน้า index
  } catch (err) {
    error.value = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล'
    console.error(err)
  }
}
</script>

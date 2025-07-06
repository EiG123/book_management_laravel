<template>
  <DefaultLayout>
    <div class="max-w-2xl mx-auto bg-white shadow-md p-6 rounded-lg mt-6">
      <h2 class="text-2xl font-bold mb-4 text-indigo-700">📘 รายละเอียดหนังสือ</h2>

      <div class="space-y-3 text-gray-800">
        <p><span class="font-semibold">ชื่อหนังสือ:</span> {{ book.title }}</p>
        <p><span class="font-semibold">ผู้เขียน:</span> {{ book.author }}</p>
        <p><span class="font-semibold">ปีที่พิมพ์:</span> {{ book.published_year || 'ไม่ระบุ' }}</p>
        <p><span class="font-semibold">ประเภท:</span> {{ book.genre || 'ไม่ระบุ' }}</p>
      </div>

      <div class="mt-6 flex justify-between">
        <router-link
          :to="`/books/${book.id}/edit`"
          class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded"
        >
          ✏️ แก้ไข
        </router-link>

        <router-link
          to="/books"
          class="text-gray-500 hover:underline text-sm"
        >
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

const route = useRoute()
const id = route.params.id
const book = ref({})
const error = ref('')

onMounted(async () => {
  try {
    const res = await API.get(`/books/${id}`)
    book.value = res.data
  } catch (err) {
    error.value = 'ไม่สามารถโหลดข้อมูลหนังสือได้'
    console.error(err)
  }
})
</script>

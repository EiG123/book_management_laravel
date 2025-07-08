<!-- views/BookIndex.vue -->
<template>
  <DefaultLayout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
          <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">📚 ห้องสมุดดิจิทัล</h1>
            <p class="text-gray-600">จัดการและค้นหาหนังสือในคอลเลกชันของคุณ</p>
          </div>
          <router-link to="/books/create"
            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:from-purple-700 hover:to-pink-700 transform transition-all duration-200 hover:scale-105 active:scale-95">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            เพิ่มหนังสือใหม่
          </router-link>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
          <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
              <input v-model="searchQuery" type="text" placeholder="ค้นหาหนังสือ..."
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
            </div>
            <select v-model="selectedGenre"
              class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
              <option value="">ทุกประเภท</option>
              <option v-for="genre in genres" :key="genre" :value="genre">{{ genre }}</option>
            </select>
          </div>
        </div>

        <!-- Stats Section -->
        <!-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-purple-600 mb-2">{{ books.length }}</div>
            <div class="text-gray-600">หนังสือทั้งหมด</div>
          </div>
          <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-pink-600 mb-2">{{ uniqueAuthors.length }}</div>
            <div class="text-gray-600">ผู้เขียน</div>
          </div>
          <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-indigo-600 mb-2">{{ genres.length }}</div>
            <div class="text-gray-600">ประเภท</div>
          </div>
        </div> -->

        <!-- Books Grid -->
        <div v-if="filteredBooks.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="book in filteredBooks" :key="book.id"
            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transform transition-all duration-300 hover:scale-105">
            <!-- Book Cover Placeholder -->
            <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
              <div class="text-6xl">📖</div>
            </div>

            <!-- Book Info -->
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ book.title }}</h3>

              <div class="space-y-2 mb-4">
                <div class="flex items-center text-gray-600">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  <span class="text-sm">{{ book.author }}</span>
                </div>

                <div class="flex items-center text-gray-600">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  <span class="text-sm">{{ book.published_year || 'ไม่ระบุ' }}</span>
                </div>

                <div class="flex items-center text-gray-600">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                  </svg>
                  <span class="text-sm">{{ book.genre || 'ไม่ระบุ' }}</span>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex gap-2">
                <button @click="viewBook(book)"
                  class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                  </svg>
                  ดู
                </button>

                <button @click="editBook(book)"
                  class="flex-1 bg-amber-500 hover:bg-amber-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center"
                  v-if="book.user_id === currentUser?.id">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  แก้ไข
                </button>

                <button @click="deleteBook(book)"
                  class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200"
                  v-if="book.user_id === currentUser?.id">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="meta?.last_page > 1" class="mt-10 flex justify-center gap-2">
          <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
            class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50 hover:bg-gray-300 transition-colors">
            ◀ ก่อนหน้า
          </button>

          <button v-for="page in meta.last_page" :key="page" @click="goToPage(page)" :class="[
            'px-4 py-2 rounded transition-colors',
            currentPage === page ? 'bg-purple-500 text-white' : 'bg-gray-100 hover:bg-gray-200'
          ]">
            {{ page }}
          </button>

          <button @click="goToPage(currentPage + 1)" :disabled="currentPage === meta.last_page"
            class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50 hover:bg-gray-300 transition-colors">
            ถัดไป ▶
          </button>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-12">
          <div class="text-8xl mb-4">📚</div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">ไม่มีหนังสือในคอลเลกชัน</h3>
          <p class="text-gray-600 mb-6">เริ่มต้นสร้างห้องสมุดของคุณโดยการเพิ่มหนังสือเล่มแรก</p>
          <router-link to="/books/create"
            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:from-purple-700 hover:to-pink-700 transform transition-all duration-200 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            เพิ่มหนังสือเล่มแรก
          </router-link>
        </div>

      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import API from '@/api'
import router from '@/router'

const books = ref([])
const searchQuery = ref('')
const selectedGenre = ref('')
const meta = ref([])
const currentPage = ref(1)

// Computed properties
const uniqueAuthors = computed(() => {
  return [...new Set(books.value.map(book => book.author).filter(Boolean))]
})

const genres = computed(() => {
  return [...new Set(books.value.map(book => book.genre).filter(Boolean))]
})

const filteredBooks = computed(() => {
  let filtered = books.value

  // Filter by search query
  if (searchQuery.value) {
    filtered = filtered.filter(book =>
      book.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      book.author.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  }

  // Filter by genre
  if (selectedGenre.value) {
    filtered = filtered.filter(book => book.genre === selectedGenre.value)
  }

  return filtered
})

// Methods
const viewBook = (book) => {
  // Navigate to book detail page
  console.log('View book:', book)
  router.push(`/books/${book.id}`)
}

const editBook = (book) => {
  // Navigate to edit page
  console.log('Edit book:', book)
  router.push(`/books/${book.id}/edit`)
}

const deleteBook = async (book) => {
  if (confirm(`คุณต้องการลบหนังสือ "${book.title}" หรือไม่?`)) {
    try {
      await API.delete(`/books/${book.id}`)
      books.value = books.value.filter(b => b.id !== book.id)
    } catch (error) {
      console.error('ลบหนังสือล้มเหลว:', error)
      alert('ไม่สามารถลบหนังสือได้')
    }
  }
}

const fetchBooks = async (page = 1) => {
  try {
    const response = await API.get(`/books?page=${page}`)
    books.value = response.data.data
    meta.value = {
      current_page: response.data.current_page,
      last_page: response.data.last_page,
      per_page: response.data.per_page,
      total: response.data.total
    }
    console.log(meta.value)
    currentPage.value = page
  } catch (error) {
    console.error('โหลดหนังสือล้มเหลว:', error)
  }
}

const currentUser = ref(null)

onMounted(async () => {
  try {
    fetchBooks()
    const me = await API.get('/me')
    currentUser.value = me.data
  } catch (error) {
    console.error('โหลดหนังสือล้มเหลว:', error)
  }
})

const goToPage = (page) => {
  if (page !== currentPage.value && page >= 1 && page <= meta.value.last_page) {
    fetchBooks(page)
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
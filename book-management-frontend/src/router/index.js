// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import BookIndex from '../views/books/BookIndex.vue'
import BookCreate from '@/views/books/BookCreate.vue'
import BookEdit from '@/views/books/BookEdit.vue'
import BookView from '@/views/books/BookView.vue'

const routes = [
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/dashboard', component: Dashboard },

  //book
  { path: '/books', component: BookIndex },
  //book create
  { path: '/books/create', component: BookCreate },
  //book edit
  { path: `/books/:id/edit`, component: BookEdit },
  //book view
  { path: '/books/:id', component: BookView },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router

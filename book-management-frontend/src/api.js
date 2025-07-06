// src/api.js
import axios from 'axios'

const API = axios.create({
  baseURL: 'http://localhost:8000/api', // เปลี่ยนให้ตรงกับ Laravel serve
  headers: {
    'Content-Type': 'application/json',
  },
})

// ดึง token จาก localStorage แล้วแนบทุก request
API.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`
  }
  return config
})

export default API

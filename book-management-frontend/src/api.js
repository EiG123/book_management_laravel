import axios from 'axios'
import router from './router' // เพิ่มเพื่อ redirect ถ้า token หมดอายุ

const API = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
  },
})

// Intercept request: แนบ token อัตโนมัติ
API.interceptors.request.use((config) => {
  const token = sessionStorage.getItem('token')
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`
  }
  return config
})

// Intercept response: handle token หมดอายุ หรือไม่ได้ login
API.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      sessionStorage.removeItem('token')
      router.push('/login')
    }
    return Promise.reject(error)
  }
)

export default API

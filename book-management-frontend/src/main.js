import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/main.css' // <- ใส่ตรงนี้

createApp(App).use(router).mount('#app')

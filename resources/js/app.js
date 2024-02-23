import './bootstrap';
import { createApp } from 'vue'
import router from "./vueApp/router/index.js";
import 'tailwindcss/tailwind.css';



import  App from './vueApp/views/App.vue'
const app = createApp(App).use(router)
 
app.mount('#app')

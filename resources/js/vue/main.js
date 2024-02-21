import { createApp } from "vue";
import App from "./App.vue";
import axios from 'axios'

//material design
// import "@mdi/font/css/materialdesignicons.min.css"

import router from './router'

const app = createApp(App).use(router)

// implementandoa axios de forma global
app.config.globalProperties.$axios = axios
// emplear axios desde el objeto windows
window.axios = axios

app.mount('#app')
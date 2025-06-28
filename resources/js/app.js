import { createApp } from 'vue'
import { createPinia } from 'pinia'
import TasksContainer from './components/TasksContainer.vue'
import './bootstrap'            // configura o axios
import '../css/app.css'         // importa seu CSS (normalize, webflow, app.css, etc)

const app = createApp(TasksContainer)
app.use(createPinia())
app.mount('#app')

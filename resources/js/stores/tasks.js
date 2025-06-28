// resources/js/stores/tasks.js
import { defineStore } from 'pinia'
import axios from 'axios'

export const useTaskStore = defineStore('tasks', {
  state: () => ({
    tasks: [],
    loading: false,
    error: null
  }),
  actions: {
    async fetchTasks() {
      this.loading = true
      try {
        const { data } = await axios.get('tasks')
        this.tasks = data
      } catch (e) {
        this.error = e.message
      } finally {
        this.loading = false
      }
    },
    async createTask(payload) {
      await axios.post('tasks', payload)
      await this.fetchTasks()
    },
    async updateTask(id, payload) {
      await axios.put(`tasks/${id}`, payload)
      await this.fetchTasks()
    },
    async deleteTask(id) {
      await axios.delete(`tasks/${id}`)
      await this.fetchTasks()
    },
    async toggleTask(id) {
      await axios.patch(`tasks/${id}/toggle`)
      await this.fetchTasks()
    }
  }
})

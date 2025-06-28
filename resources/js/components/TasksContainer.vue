<template>
  <div class="tasks">
    <button class="button" @click="openModal()">+ Nova tarefa</button>
    <div v-if="store.loading">Carregando...</div>
    <ul v-else>
      <li v-for="t in store.tasks" :key="t.id" class="task">
        <input
          type="checkbox"
          class="checkbox"
          :checked="t.finalizado"
          @change="store.toggleTask(t.id)"
        />
        <span :class="['checkbox-label', { checked: t.finalizado }]">
          {{ t.nome }}
        </span>
        <button class="button outlined rounded small" @click="openModal(t)">
          ✎
        </button>
        <button class="button outlined rounded small" @click="store.deleteTask(t.id)">
          🗑
        </button>
      </li>
    </ul>

    <TaskModal
      v-if="modalOpen"
      :task="editingTask"
      @save="handleSave"
      @close="modalOpen = false"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useTaskStore } from '../stores/tasks'
import TaskModal from './TaskModal.vue'

const store = useTaskStore()
const modalOpen = ref(false)
const editingTask = ref(null)

onMounted(() => {
  store.fetchTasks()
})

function openModal(task = null) {
  editingTask.value = task
  modalOpen.value = true
}

async function handleSave(payload) {
  if (editingTask.value) {
    await store.updateTask(editingTask.value.id, payload)
  } else {
    await store.createTask(payload)
  }
  modalOpen.value = false
}
</script>

<template>
  <div class="modal-task">
    <div class="container-modal regular">
      <div class="content-modal">
        <input v-model="form.nome" class="input" placeholder="Nome" />
        <textarea v-model="form.descricao" class="input" placeholder="Descrição"></textarea>
        <input
          type="datetime-local"
          v-model="form.data_limite"
          class="input"
        />
      </div>
      <div class="flex-block-horizontal-right-align bottom-modal">
        <button class="button outlined" @click="$emit('close')">
          Cancelar
        </button>
        <button class="button" @click="emitSave">Salvar</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, watch } from 'vue'

const props = defineProps({ task: Object })
const emit = defineEmits(['save', 'close'])

const form = reactive({ nome: '', descricao: '', data_limite: '' })

watch(
  () => props.task,
  (t) => {
    if (t) {
      form.nome = t.nome
      form.descricao = t.descricao || ''
      // converter para input datetime-local
      form.data_limite = t.data_limite
        ? t.data_limite.slice(0, 16)
        : ''
    } else {
      form.nome = ''
      form.descricao = ''
      form.data_limite = ''
    }
  },
  { immediate: true }
)

function emitSave() {
  emit('save', { ...form })
}
</script>

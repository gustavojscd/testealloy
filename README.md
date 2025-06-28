# Teste Técnico Alloy - To-Do List

## Descrição do Projeto

Este é um teste técnico para desenvolvedores da Alloy, consistindo na implementação de uma aplicação de lista de tarefas (To-Do List) utilizando **Laravel 12** como backend e **Vue.js 3** como frontend.

## Estrutura do Projeto

```
├── app/
│   ├── Http/Controllers/     # Controllers da API
│   ├── Models/              # Models Eloquent
│   ├── Jobs/                # Jobs para processamento em fila
│   └── Services/            # Services para lógica de negócio
├── database/
│   ├── migrations/          # Migrações do banco
│   └── seeders/            # Seeders para dados iniciais
├── resources/
│   ├── js/
│   │   ├── components/      # Componentes Vue.js
│   │   ├── stores/         # Stores Pinia
│   │   └── services/       # Services para API
│   ├── css/                # Estilos CSS
│   └── views/              # Views Blade
├── routes/
│   ├── web.php             # Rotas web
│   └── api.php             # Rotas da API
└── public/webflow/         # Referência de design
```

## Funcionalidades Requeridas

### 1. Gerenciamento de Tarefas (CRUD)

#### Campos da Tarefa:
- `id` - Identificador único
- `nome` - Nome da tarefa (string, obrigatório)
- `descricao` - Descrição detalhada (text, opcional)
- `finalizado` - Status de conclusão (boolean, padrão: false)
- `data_limite` - Data limite para conclusão (datetime, opcional)
- `created_at` - Data de criação
- `updated_at` - Data da última atualização
- `deleted_at` - Data de exclusão (soft delete)

#### Operações:
- **Criar** nova tarefa
- **Listar** todas as tarefas (não excluídas)
- **Visualizar** tarefa específica
- **Editar** tarefa existente (clique para editar)
- **Marcar** como finalizada/não finalizada
- **Excluir** tarefa (soft delete)

### 2. Interface do Usuário

- Interface baseada no design disponível em `public/webflow/index.html`
- Lista de tarefas responsiva
- Modal para criação/edição de tarefas
- Botões de ação (editar, finalizar, excluir)
- Feedback visual para diferentes estados das tarefas

### 3. Sistema de Filas e Jobs

- **Job de Exclusão Automática**: Após uma tarefa ser marcada como finalizada, deve ser criado um job que será executado em 10 minutos para excluir definitivamente o registro
- Configuração de fila para processamento assíncrono

### 4. Sistema de Cache

- **Cache para Requests GET**: Implementar cache para listagem e visualização de tarefas
- **Invalidação de Cache**: Gerenciar invalidação automática quando dados são modificados (CREATE, UPDATE, DELETE)
- Tags de cache para invalidação granular


## Configuração e Execução

### Pré-requisitos
- PHP 8.2+
- Composer
- Node.js 18+
- SQLite

### Instalação

1. **Clone e instale dependências:**
   ```bash
   composer install
   npm install
   ```

2. **Configuração do ambiente:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configuração do banco de dados (.env):**
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

4. **Execute as migrações:**
   ```bash
   php artisan migrate
   ```

5. **Execute o projeto:**
   ```bash
   composer run dev
   ```
   
   Ou alternativamente:
   ```bash
   # Terminal 1 - Laravel
   php artisan serve
   
   # Terminal 2 - Queue Worker
   php artisan queue:work
   
   # Terminal 3 - Vite
   npm run dev
   ```

### Scripts Disponíveis

- `composer run dev` - Executa todos os serviços simultaneamente
- `composer run test` - Executa os testes
- `npm run dev` - Desenvolvimento frontend
- `npm run build` - Build de produção



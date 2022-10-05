import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';

import LoginForm from '../components/LoginForm.vue';
import Dashboard from '../components/Dashboard.vue';
import Tasks from '../components/Tasks.vue';
import TaskForm from '../components/TaskForm.vue';

createApp({
    components: {
        LoginForm,
        Dashboard,
        Tasks,
        TaskForm
    }
}).mount('#app');

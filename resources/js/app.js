import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import LoginForm from '../components/LoginForm.vue';
import Dashboard from '../components/Dashboard.vue';

createApp({
    components: {
        LoginForm,
        Dashboard
    }
}).mount('#app');

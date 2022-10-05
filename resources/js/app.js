import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import LoginForm from '../components/LoginForm.vue';

createApp({
    components: {
        LoginForm
    }
}).mount('#app');

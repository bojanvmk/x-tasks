<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg lg:w-1/3">
            <h3 class="text-2xl font-bold text-center">Login to your account</h3>
            <form>
                <div class="mt-4">
                    <div>
                        <label class="block" for="email">Email</label>
                        <input type="text" id="email" name="password" placeholder="Email" v-model="credentials.email"
                               class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="mt-4">
                        <label class="block" for="password">Password</label>
                        <input id="password" name="password" type="password" placeholder="Password" v-model="credentials.password"
                               class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>

                    <div class="flex items-baseline justify-between">
                        <button type="button" @click.prevent="login()" class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginForm',
    data(){
        return {
            credentials: {
                email: '',
                password: ''
            },
        };
    },
    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie')
                .then(() => axios.post('/login', this.credentials))
                .then(() => window.location.replace('dashboard'));
        }
    }
};
</script>

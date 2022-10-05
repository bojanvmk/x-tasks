<template>
    <div class="navbar bg-gray-100 flex justify-between">
        <h1>Username: <span class="ml-2" v-text="user.username"></span></h1>
        <a class="btn btn-primary" href="/tasks">Tasks crud</a>
        <a class="btn btn-secondary" href="/user/token">Generate new token</a>
        <button class="btn" @click.prevent="logout">Logout</button>
    </div>

</template>

<script>
export default {
    name: 'Dashboard',
    props: {
        user: Object
    },
    methods: {
        logout(){
            axios.get('/sanctum/csrf-cookie')
                .then(() => axios.post('/logout'))
                .then(() => window.location.replace('/'));
        }
    }
};
</script>

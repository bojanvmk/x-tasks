<template>
    <div class="navbar bg-gray-100 flex justify-between">
        <h1>Username: <span class="ml-2" v-text="user.username"></span></h1>
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

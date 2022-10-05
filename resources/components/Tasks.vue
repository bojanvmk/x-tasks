<template>
    <div class="py-12 sm:px-6 lg:px-8 bg-gray-100">
        <h2 class="text-2xl my-8 text-center">Tasks  / <a href="/tasks/create" class="btn-link">Add new</a>
        </h2>
        <div class="flex flex-wrap max-w-7xl mx-auto ">
            <div class="card w-96 lg:w-[31%] lg:mr-[2.3%] lg:mb-10 bg-base-100 shadow-xl" v-for="task in tasks">
                <div class="card-body">
                    <h2 class="rounded-md border-accent card-title" v-text="task.title"></h2>
                    <h2 class="rounded-md border-gray-500" v-text="task.description"></h2>
                    <div class="mt-2">
                        <p>Expiration date: <input class="border" title="expire" v-model="task.expire_at" @change="updateExpireAt(task.id, $event)"/></p>
                    </div>
                    <div class="mt-4" v-for="fieldErrors in validationErrors[task.id] || []">
                        <p v-for="error in fieldErrors" v-text="error"></p>
                    </div>
                    <div class="card-actions justify-end mt-8">
                        <a :href="'/tasks/'+task.id" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginForm',
    props: {
        tasks: Array
    },
    data(){
        return {
            validationErrors: {},
            genericError: 'There was an error. Please try again.'
        };
    },
    methods: {
        updateExpireAt(taskId, event){
            axios.get('/sanctum/csrf-cookie')
                .then(() => axios.patch('/tasks/' + taskId, {expire_at: event.target.value}))
                .catch(({response}) => {
                    this.validationErrors[taskId] = response?.status === 422 ? response.data.errors : [this.genericError];
                });
        }
    }
};
</script>

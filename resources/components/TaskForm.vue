<template>
    <div class="py-12 sm:px-6 lg:px-8 bg-gray-100">
        <h2 class="text-2xl my-8 text-center">Task</h2>
        <div class="flex flex-wrap align-center items-center max-w-7xl mx-auto ">
            <div class="card w-96 lg:w-[31%] lg:mr-[2.3%] lg:mb-10 bg-base-100 shadow-xl">
                <div class="card-body">
                    <input class="rounded-md border card-title" placeholder="title" title="title" type="text" v-model="task.title"/>
                    <textarea rows="4" class="rounded-md border" placeholder="description" title="description"  v-model="task.description"></textarea>
                    <div class="mt-2">
                        <label>Expiration date:</label>
                        <input class="border" title="" type="text" placeholder="yyyy-MM-dd hh:mm:ss" v-model="task.expire_at"/>
                    </div>

                    <div class="mt-2">
                        <label>Status:</label>
                        <select name="status_id" id="status_id" title="status" class="border" v-model="task.status_id">
                            <option :value="status.id" :selected="task.status_id === status.id" v-for="status in statuses" v-text="status.name"></option>
                        </select>
                    </div>

                    <div class="mt-4" v-for="fieldErrors in validationErrors">
                        <p v-for="error in fieldErrors" v-text="error"></p>
                    </div>

                    <div class="card-actions justify-end mt-8">
                        <button class="btn btn-primary" @click.prevent="save()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TaskForm',
    props: {
        task: Object,
        statuses: Object
    },
    data(){
        return {
            validationErrors: {},
            genericError: 'There was an error. Please try again.'
        };
    },
    methods: {
        save(){
            axios.get('/sanctum/csrf-cookie')
                .then(() => {
                        if (this.task.id) {
                            axios.patch('/tasks/' + this.task.id, this.task);
                        }
                        else {
                            axios.post('/tasks', this.task);
                        }
                    }
                )
                .catch(({response}) => {
                    this.validationErrors = response?.status === 422 ? response.data.errors : [this.genericError];
                });
        }
    }
};
</script>

<template layout="default">
    <Head title="Create Category | Expense Tracker"/>
    <h1 class="text-3xl font-medium text-gray-700 mb-3">Create a Category</h1>
    <div class="flex justify-center items-centee">
        <div class="w-11/12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
       
          <form class="mt-6" @submit.prevent="submit">
                <label for="name" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Category Expenses</label>
                <textarea id="name" v-model="form.name" type="text" name="name" placeholder="Travel.." class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner" required />
                <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>

                <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-purple-400 shadow-lg focus:outline-none hover:bg-purple-900 hover:shadow-none">
                Add Category
                </button>
          </form>
        </div>
      </div>
</template>
<script setup>
    import {useForm, Head} from '@inertiajs/inertia-vue3'
    import { defineProps } from 'vue'
    let form = useForm({
        name: '',
    })

    let props = defineProps({
    categories: Array,
    users: Object
})

    const submit = () =>{
        form.post('/category')
    }
    </script>

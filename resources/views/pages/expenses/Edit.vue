<template layout="default">
    <Head title="Edit Expenses | Expense Tracker"/>
    <h1 class="text-3xl font-medium text-gray-700 mb-3">Update Expenses</h1>
    <div class="flex justify-center items-center">
        <div class="w-11/12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
          <form class="mt-6" @submit.prevent="submit">

            <label label class="block mt-2 text-xs font-semibold text-gray-600 uppercase" for="cat_id">Category</label>
                <select id="cat_id" name="cat_id" v-model="form.cat_id" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner">
                    <option value="" disabled>Select a category</option>
                    <option v-for="cat in categories" :value="cat.id" :key="cat.id"> {{ cat.name }}</option>
                </select>
                <span class="w-full">
                    <label for="description" class="block text-xs font-semibold text-gray-600 uppercase">Description</label>
                    <textarea id="description" type="text" v-model="form.description" name="description" placeholder="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner" required />
                    <div class="text-sm text-red-500 italic" v-if="form.errors.description">{{ form.errors.description }}</div>
                </span>
                <label for="amount" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Amount</label>
                <input id="amount" v-model="form.amount" type="number" name="amount" placeholder="1000.00" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner" required />
                <div class="text-sm text-red-500 italic" v-if="form.errors.amount">{{ form.errors.amount }}</div>

                 <label for="date" class="block text-xs font-semibold text-gray-600 uppercase"> Date</label>
                <input id="date" type="date" v-model="form.date" name="start_date" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner" required />
                <div class="text-sm text-red-500 italic" v-if="form.errors.date">{{ form.errors.date }}</div>

                <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-purple-400 shadow-lg focus:outline-none hover:bg-purple-900 hover:shadow-none">
                Edit Expenses
                </button>
          </form>
        </div>
      </div>
</template>
<script setup>
    import {useForm} from '@inertiajs/inertia-vue3'
    import { Head } from '@inertiajs/inertia-vue3'
    let form = useForm({
        amount: props.expenses.amount,
        description:props.expenses.description,
        cat_id:props.expenses.cat_id,
        date: props.expenses.date,
    })

    let props = defineProps({
    expenses: Object,
    categories: Array
})

    const submit = () =>{
        form.put('/expenses/'+props.expenses.id)
    }
    </script>

<template layout="default">
    <Head title="Edit Income | Expense Tracker"/>
    <h1 class="text-3xl font-medium text-gray-700 mb-3">Update Income</h1>
    <div class="flex justify-center items-center">
        <div class="w-11/12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">

          <form class="mt-6" @submit.prevent="submit">

                <label for="description" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Income Description</label>
                <textarea id="description" v-model="form.description" type="text" name="description" placeholder="" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner" required />
                <div class="text-sm text-red-500 italic" v-if="form.errors.description">{{ form.errors.description }}</div>

                <span class="w-full">
                    <label for="amount" class="block text-xs font-semibold text-gray-600 uppercase">Amount</label>
                    <input id="amount" type="number" v-model="form.amount" amount="amount" placeholder="1000.00" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-purple-200 focus:shadow-inner" required />
                    <div class="text-sm text-red-500 italic" v-if="form.errors.amount">{{ form.errors.amount }}</div>
                </span>

                <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-purple-400 shadow-lg focus:outline-none hover:bg-purple-900 hover:shadow-none">
                Edit Income
                </button>
          </form>
        </div>
      </div>
    </template>
    <script setup>
     import {useForm, Head} from '@inertiajs/inertia-vue3'
     import { defineProps } from 'vue'
     let form = useForm({
         amount: props.budget.amount,
         description: props.budget.description,
     })

     let props = defineProps({
        budget: Object,
        users: Array
    })

     const submit = () =>{
         form.put('/budget/'+props.budget.id)
     }
     </script>

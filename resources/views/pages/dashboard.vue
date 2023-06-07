<template layout="default">
    <Head title="Dashboard | Expense Tracker"/>
    <div>
        <div v-if="$page.props.flash.message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
            {{ $page.props.flash.message }}
        </div>
        <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>

        <div class="mt-4">
          <div class="flex flex-wrap -mx-6">
                <div class="w-full px-8 sm:w-1/2 xl:w-1/3">
                <div
                    class="flex px-5 py-6 bg-blue-100 rounded-md shadow-sm"
                >
                    <div class="mx-auto">
                    <h4 class="text-2xl font-semibold text-center text-blue-700">$ {{ totalBudget }}</h4>
                    <div class="text-gray-500">Total Budget</div>
                    </div>
                </div>
                </div>

                <div class="w-full px-8 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div
                    class="flex items-center px-5 py-6 bg-red-100 rounded-md shadow-sm"
                >

                    <div class="mx-auto">
                    <h4 class="text-2xl font-semibold text-red-900">$ {{ totalExpenses }}</h4>
                    <div class="text-gray-500">Total Expenses</div>
                    </div>
                </div>
                </div>

                <div class="w-full px-8 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div
                    class="flex items-center px-5 py-6 bg-green-100 rounded-md shadow-sm"
                >
                    <div class="mx-auto">          
                        <h4 class="text-2xl font-semibold text-green-600">$ {{ balance }}</h4> 
                    
                    <div class="text-gray-500">Available Balance</div>
                    </div>
                </div>
                </div>
          </div>
        </div>
        <hr class="mt-5 bg-purple-900 shadow-sm">

        <div class="flex mt-5">
            <div class="w-1/2 mx-auto">
                <div class="mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
                    <div class="flex items-center justify-between mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 bg-green-200 rounded-sm">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-dark">Recent Budget:</h5>
                        <a href="/budget" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            View all
                        </a>
                    </div>
                    <hr class="shadow-sm">
                    <div class="flow-root">
                        <ul role="list" class="shadow-xl  mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
                            <li class="py-3 sm:py-4" v-for="budget in recentBudgets" :key="budget.id">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-md font-medium text-gray-900 truncate dark:text-dark">
                                            {{ budget.description }}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-green-600 dark:text-green-900">
                                       + ${{ budget.amount }}
                                    </div>
                                </div>
                                <hr class="mt-2">
                            </li>   
                        </ul>
                    </div>
                </div>
            </div>
            <div class="w-1/2 mx-auto">
                <div class="mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
                    <div class="flex items-center justify-between mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 bg-red-200 rounded-sm">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-dark">Recent Expenses:</h5>
                        <a href="/expenses" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            View all
                        </a>
                    </div>
                    <hr class="shadow-sm">
                    <div class="flow-root">
                        <ul role="list" class="shadow-xl  mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
                            <li class="py-3 sm:py-4" v-for="expense in recentExpenses" :key="expense.id">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-dark">
                                            {{ expense.description }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{formattedDate(expense.date)  }}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-red-900">
                                       - ${{ expense.amount }}
                                    </div>
                                </div>
                                <hr class="mt-2">
                            </li>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3'
import { defineProps } from 'vue'
import moment from 'moment'
let props = defineProps({
    totalExpenses:Number,
    totalBudget:Number,
    balance:Number,
    recentBudgets: Array,
    recentExpenses:Array
})
function formattedDate(date){
    return moment(date).format('MMMM D, YYYY');
}

</script>

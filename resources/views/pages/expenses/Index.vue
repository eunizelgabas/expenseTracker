<template layout="default">
    <Head title="Expenses | Expense Tracker"/>
    <div>
        <ConfirmDialog v-if="showConfirm"
            title="Delete Expenses?"
            message="Are you sure about deleting this expenses?"
            @cancel="cancelDelete()"
            @confirm="confirmDelete()">

        </ConfirmDialog>
        <div v-if="$page.props.flash.message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
            {{ $page.props.flash.message }}
        </div>
        <div class="bg-white">
            <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <h1 class="text-3xl font-medium text-gray-700 "></h1>
                    <Link href="/expenses/create" class="btn-primary mb-2" >Add Expenses</Link>
                </div>
                <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-4xl sm:px-6 lg:px-8">
                    <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xl font-bold text-gray-900">List of Expenses</p>
                            <p class="text-sm mt-1 mr-0 mb-0 ml-0 font-semi-bold text-gray-500">Powered by Expense Tracker
                            </p>
                        </div>
                        <div class="mt-4 mr-0 mb-0 ml-0 sm:mt-0">
                            <p class="sr-only">Search Position</p>
                            <div class="relative">
                                <div class="flex items-center pt-0 pr-0 pb-0 pl-3 absolute inset-y-0 left-0 pointer-events-none">
                                    <p>
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21
                                        21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    </p>
                                </div>
                                <input placeholder="Search Expenses " type="text" class="border block pt-2 pr-0 pb-2 pl-10 w-full py-2
                                    pl-10 border border-purple-300 rounded-lg focus:ring-purple-600 focus:border-purple-600 sm:text-sm"
                                    v-model="search" />
                            </div>
                        </div>
                    </div>
                    <hr class=" mt-4 shadow-xl">
                    <div class="shadow-xl mt-8 mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
                        <div class="pt--10 pr-0 pb-10 pl-0">
                            <div class="pt-5 pr-0 pb-0 pl-0 mr-0 mb-0 ml-0" v-for="exp of expenses.data" :key="exp.id">
                                <div class="sm:flex sm:items-center sm:justify-between sm:space-x-5">
                                    <div class="flex items-center flex-1 min-w-0">
                                        <img src="asset/expenses.jpg"
                                            class="flex-shrink-0 object-cover rounded-full btn- w-10 h-10"/>
                                        <div class="mt-0 mr-0 mb-0 ml-4 flex-1 min-w-0">
                                            <p class="text-lg font-bold text-gray-800 truncate">{{ exp.description }}</p>
                                            <p class="text-gray-600 text-md">{{ exp.category.name }}</p>
                                            <p class="text-red-600 text-md"> ${{ exp.amount }}</p>
                                            <p class="text-gray-600 text-md">{{ formattedDate(exp.date) }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mr-0 mb-0 ml-0 pt-0 pr-0 pb-0 pl-14 flex items-center sm:space-x-6 sm:pl-0 sm:justify-end
                                        sm:mt-0">
                                        <Link :href=" '/expenses/edit/' + exp.id " class="bg-green-600 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                            duration-200 hover:bg-gray-700 rounded-lg">Edit
                                        </Link>
                                        <button class="bg-red-600 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                            duration-200 hover:bg-red-700 rounded-lg" @click="remove(exp)">Delete
                                        </button>
                                    </div>
                                </div>
                                <hr class="mt-2 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center space-x-1">
            <Pagination
                :data="expenses"
            />
        </div>
    </div>
</template>

<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3'
import moment from 'moment'
import { ref, computed ,reactive, onMounted, watch} from 'vue';
import { Head } from '@inertiajs/inertia-vue3'
import ConfirmDialog from '@/views/components/confirm-dialog.vue';
import Pagination from '@/views/components/pagination-links.vue';
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({
    expenses: Object,
    categories:Object,
    errors: null,
    filters:Object,
})


function formattedDate(date){
    return moment(date).format('MMMM D, YYYY');
}

let showConfirm = ref(false);
let selectedExpensesDelete = null


function remove(exp){
    selectedExpensesDelete = exp
    showConfirm.value = true;
 }

 function cancelDelete() {
    showConfirm.value = false;
 }

 function confirmDelete(){
    form.delete('/expenses/' +selectedExpensesDelete.id);
    showConfirm.value = false;
 }


let form = useForm({
    amount: '',
    cat_id: '',
    description: '',
    date: '',

})
let search = ref(props.filters.search);
watch(search, (value) => {
    Inertia.get(
        "/expenses",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});


</script>

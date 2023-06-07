<template layout="default">
    <Head title="Category | Expense Tracker"/>
    <div>
        <ConfirmDialog v-if="showConfirm"
            title="Delete Category?"
            message="Are you sure about deleting this category?"
            @cancel="cancelDelete()"
            @confirm="confirmDelete()">
        </ConfirmDialog>
        
        <ErrorMessage v-if="errorConfirm"
            title="General Error"
            :message="errors.GeneralErrors"
            @confirm="deleteCategory()">
        </ErrorMessage>

        <div v-if="$page.props.flash.message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
            {{ $page.props.flash.message }}
        </div>
        <div class="bg-white">
            <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <h1 class="text-3xl font-medium text-gray-700 "></h1>
                    <Link href="/category/create" class="btn-primary mb-2 float-right" >Add Category</Link>
                </div>
                <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-4xl sm:px-6 lg:px-8">
                    <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xl font-bold text-gray-900">List of Category</p>
                            <p class="text-sm mt-1 mr-0 mb-0 ml-0 font-semi-bold text-gray-500">Powered by Expense Tracker
                            </p>
                        </div>
                        <div class="mt-4 mr-0 mb-0 ml-0 sm:mt-0">
                            <p class="sr-only">Search Category</p>
                            <div class="relative">
                                <div class="flex items-center pt-0 pr-0 pb-0 pl-3 absolute inset-y-0 left-0 pointer-events-none">
                                    <p>
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21
                                        21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    </p>
                                </div>
                                <input placeholder="Search Category" type="search" class="border block pt-2 pr-0 pb-2 pl-10 w-full py-2
                                    pl-10 border border-purple-300 rounded-lg focus:ring-purple-600 focus:border-purple-600 sm:text-sm"
                                    v-model="search"/>
                            </div>
                        </div>
                    </div>
                    <hr class=" mt-4 shadow-xl">
                    <div class="shadow-xl mt-8 mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
                        <div class="pt--10 pr-0 pb-10 pl-0">
                            <div class="pt-5 pr-0 pb-0 pl-0 mr-0 mb-0 ml-0" v-for="cat of categories.data" :key="cat.id">
                                <div class="sm:flex sm:items-center sm:justify-between sm:space-x-5">
                                    <div class="flex items-center flex-1 min-w-0">
                                        <img src="asset/category.png"
                                            class="flex-shrink-0 object-cover rounded-full btn- w-10 h-10"/>
                                        <div class="mt-0 mr-0 mb-0 ml-4 flex-1 min-w-0">
                                            <p class="text-lg font-bold text-gray-800 truncate">{{ cat.name }}</p>
                                            <p class="text-gray-600 text-md">{{ formattedDate(cat.created_at) }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mr-0 mb-0 ml-0 pt-0 pr-0 pb-0 pl-14 flex items-center sm:space-x-6 sm:pl-0 sm:justify-end
                                        sm:mt-0">
                                        <Link :href=" '/category/edit/' + cat.id" class="bg-green-600 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                            duration-200 hover:bg-green-700 rounded-lg">Edit
                                        </Link>
                                            <button class="bg-red-600 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                            duration-200 hover:bg-red-700 rounded-lg" @click="remove(cat)">Delete
                                        </button>
                                    </div>
                                </div>
                                <hr class="mt-2 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center space-x-1">
                <Pagination
                    :data="categories"
                />
            </div>
        </div>
        
    </div>
</template>

<script setup>
import {Link, useForm, Head} from '@inertiajs/inertia-vue3'
import { ref , computed, watch, defineProps } from 'vue'
import ConfirmDialog from '@/views/components/confirm-dialog.vue';
import ErrorMessage from '@/views/components/error-message.vue';
import { Inertia } from '@inertiajs/inertia';
import moment from 'moment'
import Pagination from '@/views/components/pagination-links.vue';

let showConfirm = ref(false);
let selectedCategoryDelete = null

let errorConfirm = ref(false)
let errorMessage = ref(false);

let props =  defineProps({
    categories: Object,
    errors: null,
    itemCount: Number,
    filters:Object,
})


let form = useForm({
    name: '',
})

let deleteForm =  useForm();
 let confirmForm = useForm();

 function remove(cat){
    selectedCategoryDelete = cat
    showConfirm.value = true;
 }

 function cancelDelete() {
    showConfirm.value = false;
 }

 function confirmDelete(){

    form.delete('/category/' +selectedCategoryDelete.id);
    errorConfirm.value = true;
    showConfirm.value = false;
 }


 function deleteCategory(){
    errorConfirm.value = false;
    showConfirm.value = false;
 }

 function formattedDate(created_at){
    return moment(created_at).format('MMMM D, YYYY');
}

let search = ref(props.filters.search);
watch(search, (value) => {
    Inertia.get(
        "/category",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>

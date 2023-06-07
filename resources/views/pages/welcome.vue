<template layout="default">
    <Head title="Welcome | Expense Tracker"/>
    <div>
        <section class="bg-white">
            <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="place-self-center mr-auto lg:col-span-7">
                    <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-dark">Track expenses, unlock potential.</h1>
                    <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-600">Join us on the path to financial success and experience the transformative power of our Expense Tracker system.</p>
                    <a href="/login" class="inline-flex justify-center items-center py-3 px-5 mr-3 text-base font-medium text-center text-white rounded-lg bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-900">
                        Sign up
                    </a>
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="asset/logoexp.png" alt="mockup">
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { Link, usePage, useForm, Head } from '@inertiajs/inertia-vue3'
import { defineProps } from 'vue'
let props = defineProps({
   message: null,
   errors: null,
   title: String,

})

let form = useForm({
    task_id: '',
    user_id: '',

})

</script>

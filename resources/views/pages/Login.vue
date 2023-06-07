<template>
    <Head title="Login | Expense Tracker"/>
    <div>
       <div class="min-h-screen bg-purple-400 flex justify-center items-center">

            <div class="absolute w-60 h-60 rounded-xl bg-purple-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block"></div>
            <div class="absolute w-48 h-48 rounded-xl bg-purple-300 bottom-20 right-10 transform rotate-12 hidden md:block"></div>
              <div v-if="$page.props.flash.message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.message }}
              </div>
            <div class="py-5 px-20 bg-white rounded-2xl shadow-xl z-20">
                <div>
                    <img src="asset/logoexp.png" class="h-20 mx-auto" alt="Expense Tracker Logo" />
                    <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">Login to your Account</h1>
                    <p class="w-80 text-center text-sm font-semibold text-gray-700 tracking-wide cursor-pointer">
                        Manage all your tasks for free!</p>
                </div>
                <div class="text-sm text-red-500 italic text-center mt-2" v-if="form.errors.authentication">{{ form.errors.authentication }}</div>
                <form class="space-y-4" @submit.prevent="submit">
                    <div class="mx-auto max-w-lg">
                          <div class="py-2">
                              <span class="px-1 text-sm text-gray-600">Username</span>
                              <input type="text" v-model="form.username"
                              class="text-md block px-3 py-2  rounded-lg w-full
                              bg-white border-2 border-purple-300 placeholder-gray-600 shadow-md focus:bg-white focus:border-purple-600 focus:outline-none">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.username">{{ form.errors.username }}</div>
                            </div>
                          <div class="py-2">
                              <span class="px-1 text-sm text-gray-600">Password</span>
                              <div class="relative">
                                  <input placeholder="" type="password"  v-model="form.password"
                                  class="text-md block px-3 py-2  rounded-lg w-full bg-white border-2 border-purple-300 placeholder-gray-600 shadow-md focus:bg-white focus:border-purple-600 focus:outline-none">
                                  <div class="text-sm text-red-500 italic" v-if="form.errors.password">{{ form.errors.password }}</div>
                              </div>
                          </div>
                          <button class="mt-3 text-lg font-semibold
                              bg-purple-800 w-full text-white rounded-lg
                              px-6 py-3 block shadow-xl hover:text-white hover:bg-purple-500 disabled:bg-gray-300" :disabled="form.processing">
                              Login
                          </button>
                          <p class="w-80 mt-3 text-center text-sm font-semibold text-gray-700 tracking-wide cursor-pointer">Don't have an account? <a href="/register" class="text-purple-400">Sign up</a></p>
                      </div>
                  </form>

            </div>
            <div class="w-40 h-40 absolute bg-purple-300 rounded-full top-35 right-8 hidden md:block"></div>
            <div class="w-20 h-40 absolute bg-purple-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block"></div>
        </div>
    </div>
</template>

<script setup>
import {useForm, Head} from '@inertiajs/inertia-vue3'
import { defineProps } from 'vue'
let form = useForm({
    'username': '',
    'password': ''
})

let props = defineProps({
//    message: null,
   title: String,
})
let submit = () => {
    form.post('/login')
}

</script>

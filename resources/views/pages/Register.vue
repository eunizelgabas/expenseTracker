<template>
    <Head title="Register | Expense Tracker"/>
    <div class="min-h-screen bg-purple-400 flex justify-center items-center">
        <div class="absolute w-60 h-60 rounded-xl bg-purple-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block"></div>
        <div class="absolute w-48 h-48 rounded-xl bg-purple-300 bottom-20 right-10 transform rotate-12 hidden md:block"></div>
        <div class="py-5 px-20 bg-white rounded-2xl shadow-xl z-20">
            <div>
                <img src="asset/logoexp.png" class="h-20 mx-auto" alt="Expense Tracker Logo" />
                <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">Create Account</h1>
                <p class="w-80 text-center text-sm font-semibold text-gray-700 tracking-wide cursor-pointer">Create an
                    account to manage all your tasks for free!</p>
            </div>
            <form class="space-y-4" @submit.prevent="submit">
                <div class="mx-auto max-w-lg">
                      <div class="py-2">
                          <span class="px-1 text-sm text-gray-600">Name</span>
                          <input placeholder="" type="text" v-model="form.name"
                          class="text-md block px-3 py-2  rounded-lg w-full
                          bg-white border-2 border-purple-300 placeholder-gray-600 shadow-md focus:bg-white focus:border-purple-600 focus:outline-none">
                          <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                      <div class="py-2">
                          <span class="px-1 text-sm text-gray-600">Username</span>
                          <input placeholder="" type="text"  v-model="form.username"
                          class="text-md block px-3 py-2  rounded-lg w-full
                          bg-white border-2 border-purple-300 placeholder-gray-600 shadow-md focus:bg-white focus:border-purple-600 focus:outline-none">
                          <div class="text-sm text-red-500 italic" v-if="form.errors.username">{{ form.errors.username }}</div>
                        </div>
                      <div class="py-2">
                          <span class="px-1 text-sm text-gray-600">Email</span>
                          <input type="email" v-model="form.email"
                          class="text-md block px-3 py-2  rounded-lg w-full
                          bg-white border-2 border-purple-300 placeholder-gray-600 shadow-md focus:bg-white focus:border-purple-600 focus:outline-none">
                          <div class="text-sm text-red-500 italic" v-if="form.errors.email">{{ form.errors.email }}</div>
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
                          Register
                      </button>
                      <p class="w-80 mt-3 text-center text-sm font-semibold text-gray-700 tracking-wide cursor-pointer">Already have an account? <a href="/login" class="text-purple-400">Sign in</a></p>
                  </div>
              </form>

		</div>
		<div class="w-40 h-40 absolute bg-purple-300 rounded-full top-35 right-8 hidden md:block"></div>
		<div class="w-20 h-40 absolute bg-purple-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block"></div>
	</div>
</template>

<script setup>
 import {useForm, Head} from '@inertiajs/inertia-vue3'
 import { defineProps } from 'vue'
 let form = useForm({
     name: '',
     username:'',
     email:'',
     password:''
 })

 let props = defineProps({
    users: Array,
    title: String,
})

 const submit = () =>{
     form.post('/register')
 }
 </script>

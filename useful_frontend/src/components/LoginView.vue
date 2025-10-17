<template>

<div class="w-[100vw] h-[100vh] flex justify-center items-center m-auto">

    <div class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm ">

        <div>
            <div class="mb-6">
                <h1 class="text-3xl">Login</h1>
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                    address</label>
                <input type="email" id="email" v-model="email" maxlength="100"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="john.doe@company.com" required />
            </div>
            <div class="mb-6">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password" v-model="password" maxlength="100"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="•••••••••" required />
            </div>
            <button v-if="email.trim()!=='' && password.trim() !== ''" @click="authStore.login(email, password)"
                class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                Submit
            </button>
            <button v-else
                class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                Submit
            </button>
        </div>
    </div>
</div>

</template>

<script setup>
import { useAuthStore } from '@/stores/authStore';
import { ref } from 'vue';

const authStore = useAuthStore()

const email = ref('')
const password = ref('')
</script>
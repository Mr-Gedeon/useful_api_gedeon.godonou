<template>

<div class="w-[100vw] h-[100vh] flex justify-center items-center m-auto">

    <div class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm ">

        <div class="flex flex-col justify-center">
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
            <button v-if="email.trim()!=='' && password.trim() !== ''" @click="login(email, password)"
                class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto px-5 py-2.5 text-center ">
                Submit
            </button>
            <button v-else
            class="text-white m-auto bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto px-5 py-2.5 text-center ">
            Submit
        </button>
        <div class="mt-[20px]">
            <div class="w-full text-center">

                <p>Don't have an account?</p>
                <router-link to="Register" class="text-blue-700">
                  Register
                </router-link>
            </div>
            <span v-if="authStore.login_success !== null" class="text-green-600">{{ authStore.login_success }}</span>
            <span v-if="authStore.login_error !== null" class="text-red-600">{{ authStore.login_error }}</span>
        </div>
        </div>
    </div>
</div>

</template>

<script setup>
import { useAuthStore } from '@/stores/authStore';
import { useRouter } from 'vue-router'
import { ref } from 'vue';

const authStore = useAuthStore()
const router = useRouter()

const email = ref('')
const password = ref('')

async function login(email, password) {
    const log = await authStore.login(email, password)

    if (log === true) {
        authStore.login_error = null
        setTimeout(()=> {

            router.push({name: 'Home'})
            authStore.login_success = null
        }, 2000)
    }
}
</script>
<template>

    <div class="w-[100vw] h-[100vh] flex justify-center items-center m-auto">
    
        <div class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm ">
    
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <h1 class="text-3xl">Register</h1>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" id="name" v-model="name" maxlength="20"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Your name" required />
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                        address</label>
                    <input type="email" id="email" v-model="email" maxlength="100"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Your email" required />
                </div>
                <div class="mb-6">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" v-model="password" maxlength="100"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Password" required />
                </div>
                <div class="mb-6">
                    <label for="confirm password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="confirm_password" v-model="password_confirm" maxlength="100"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Confirm password" required />
                </div>
                <button v-if="email.trim()!=='' && password.trim() !== '' && name.trim()!=='' && password_confirm.trim() !== ''" @click="register(name, email, password)"
                    class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto px-5 py-2.5 text-center ">
                    Submit
                </button>
                <button v-else
                class="text-white m-auto bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto px-5 py-2.5 text-center ">
                Submit
            </button>
            <div class="mt-[20px]">
            <div class="w-full text-center">

                <p>Already have an account?</p>
                <router-link to="Login" class="text-blue-700">
                  Login
                </router-link>
            </div>
                <span v-if="authStore.register_success !== null" class="text-green-600">{{ authStore.register_success }}</span>
                <span v-if="authStore.register_error !== null" class="text-red-600">{{ authStore.register_error }}</span>
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
    
    const name = ref('')
    const email = ref('')
    const password = ref('')
    const password_confirm = ref('')
    
    async function register(Newname, Newemail, Newpassword) {
        const log = await authStore.register(Newname, Newemail, Newpassword)
    
        if ((password.value === password_confirm.value) && (log === true)) {
            authStore.register_error = null
            setTimeout(()=> {
    
                router.push({name: 'Login'})
                authStore.register_success = null
            }, 2000)
        }
        
        if ((password.value !== password_confirm.value)) {
            authStore.register_error = "The passwords don't match"
        }
    }
    </script>
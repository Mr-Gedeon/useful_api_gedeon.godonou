<script setup>
import { useAuthStore } from '@/stores/authStore';
import { useRouter } from 'vue-router'
import { onMounted } from 'vue';

import SideBar from './SideBar.vue';

const authStore = useAuthStore()
const router = useRouter()

onMounted(async () => {
    if (authStore.isUserConnected() === false) {
        router.push({ name: 'Login' })
    }
})


</script>

<template>

    <SideBar></SideBar>

    <div class="p-4 sm:ml-64">
        <div class="flex justify-around gap-[30px] p-4 border-2 border-dashed rounded-lg border-gray-700">

            <div
                class=" flex justify-center w-full p-6 bg-white border border-blue-300 rounded-lg shadow-sm hover:bg-blue-100 cursor-pointer">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-700">Url shortener</h5>
                
            </div>

            <div
                class=" flex justify-center w-full p-6 bg-white border border-orange-300 rounded-lg shadow-sm hover:bg-orange-100 cursor-pointer">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-orange-700">Wallet</h5>
                
            </div>

            <div
                class=" flex justify-center w-full p-6 bg-white border border-green-300 rounded-lg shadow-sm hover:bg-green-100 cursor-pointer">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-700">Time tracker</h5>
                
            </div>

        </div>
    </div>

</template>
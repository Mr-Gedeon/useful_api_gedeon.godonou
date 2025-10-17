<script setup>
import { useAuthStore } from '@/stores/authStore';
import { useModulesStore } from '@/stores/modulesStore';
import { useRouter } from 'vue-router'
import { onMounted } from 'vue';

import SideBar from './SideBar.vue';

const authStore = useAuthStore()
const modulesStore = useModulesStore()
const router = useRouter()

onMounted(async () => {
    if (authStore.isUserConnected() === false) {
        router.push({ name: 'Login' })
    }

    await modulesStore.getUserModules()
})

async function activeModule(moduleId) {
    await modulesStore.activateModule(moduleId)
    await modulesStore.getUserModules()
}

async function deactiveModule(moduleId) {
    await modulesStore.deactivateModule(moduleId)
    await modulesStore.getUserModules()
}
</script>

<template>

    <SideBar></SideBar>

    <div class="p-4 sm:ml-64">
        <div class="flex justify-around gap-[30px] p-4 border-2 border-dashed rounded-lg border-gray-700">

            <div
                class=" flex flex-col justify-center w-full p-6 bg-white border border-blue-300 rounded-lg shadow-sm hover:bg-blue-100 cursor-pointer">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-700 text-center">Url shortener</h5>

                <button @click="activeModule(1)"
                    v-if="modulesStore.userModules.filter(module => module.id === 1).length === 0"
                    class="mt-[10px] text-center text-red-800 cursor-pointer">Deactivated. active</button>
                <button @click="deactiveModule(1)" v-else
                    class="mt-[10px] text-center text-green-800 cursor-pointer">Activated. deactive</button>
            </div>

            <div @click="activeModule(2)"
                class=" flex flex-col justify-center w-full p-6 bg-white border border-orange-300 rounded-lg shadow-sm hover:bg-orange-100 cursor-pointer">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-orange-700 text-center">Wallet</h5>

                <button @click="activeModule(1)"
                    v-if="modulesStore.userModules.filter(module => module.id === 2).length === 0"
                    class="mt-[10px] text-center text-red-800 cursor-pointer">Deactivated. active</button>
                <button @click="deactiveModule(1)" v-else
                    class="mt-[10px] text-center text-green-800 cursor-pointer">Activated. deactive</button>
            </div>

            <div @click="activeModule(4)"
                class=" flex flex-col justify-center w-full p-6 bg-white border border-green-300 rounded-lg shadow-sm hover:bg-green-100 cursor-pointer">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-700 text-center">Time tracker</h5>


                <button @click="activeModule(1)"
                    v-if="modulesStore.userModules.filter(module => module.id === 4).length === 0"
                    class="mt-[10px] text-center text-red-800 cursor-pointer">Deactivated. active</button>
                <button @click="deactiveModule(1)" v-else
                    class="mt-[10px] text-center text-green-800 cursor-pointer">Activated. deactive</button>
            </div>

        </div>
    </div>

</template>
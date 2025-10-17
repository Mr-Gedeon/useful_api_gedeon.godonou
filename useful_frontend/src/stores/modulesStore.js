import {defineStore} from 'pinia'
import axios from 'axios'
import { useAuthStore } from './authStore'


const apiUrl = import.meta.env.VITE_API_URL

export const useModulesStore = defineStore('modules', {
    state: () => (
        {
        authStore: useAuthStore(),
        userModules: []
        }
    ),

    actions: {
        async getUserModules() {

            try {
                const query = await axios.get(apiUrl+'modules', {
                    headers: {
                        Authorization: 'Bearer ' + this.authStore.token
                    }
                })

                this.userModules = query.data

            } catch (error) {
                console.error(error)
            }
        },

        async activateModule(moduleId) {

            try {
                const query = await axios.post(apiUrl+`modules/${moduleId}/activate`)

                return query.data.message
                
            } catch (error) {
                console.error(error)
            }

        },

        async deactivateModule(moduleId) {
            try {
                const query = await axios.post(apiUrl+`modules/${moduleId}/deactivate`)

                return query.data.message
                
            } catch (error) {
                console.error(error)
            }
        }
    },

    persist: true
})
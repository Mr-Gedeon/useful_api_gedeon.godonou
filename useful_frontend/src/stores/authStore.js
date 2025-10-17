import {defineStore} from 'pinia'
import axios from 'axios'

const apiUrl = import.meta.env.VITE_API_URL

export const useAuthStore = defineStore('auth', {

    state: () => (
        {
            user: null,
            user_id: null,
            token: null
        }
    ),

    actions: { // check if the user is connected
        isUserConnected() {
            if (this.user !== null || this.user_id !== null) {

                return true
            } else {
                return false
            }
        },

        // connect a user
        async login(actualEmail, ActualPassword) {

            const UserEmail = actualEmail.trim()
            const UserPassword = ActualPassword.trim()

            try {
                const query = await axios.post(apiUrl + 'login', {
                    email: UserEmail,
                    password: UserPassword
                }, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                console.log(query.data)
                this.token = await query.data.token
                this.user_id = await query.data.user_id

            } catch (error) {

                console.error(error)
            }


        }
    },
    persist: true
})

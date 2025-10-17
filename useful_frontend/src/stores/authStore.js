import {defineStore} from 'pinia'
import axios from 'axios'

const apiUrl = import.meta.env.VITE_API_URL

export const useAuthStore = defineStore('auth', {

    state: () => (
        {
            user: null,
            user_id: null,
            token: null,
            login_success: null,
            login_error: null
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
                this.login_success = "Login successfuly! Redirecting..."

                console.log(query.data)
                this.token = await query.data.token
                this.user_id = await query.data.user_id


                return true

            } catch (error) {

                this.login_error = "Something went wrong! retry"
                console.error(error)

                return false
            }


        }
    },
    persist: true
})

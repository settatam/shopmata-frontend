<template>
    <div class="min-h-screen bg-white flex">
        <!-- left div -->
        <div
            class="hidden lg:block lg:w-1/2 relative w-0 lg:bg-indigo-700 -skew-x-6 -translate-x-20 pt-10 px-18 flex-col"
        >
            <div
                class="flex flex-col lg:px-20 xl:px-24 translate-x-20 skew-x-6 text-white"
            >
                <!-- logo start -->

                <div class="">
                    <div class="mb-32">
                        <img
                            src="../../assets/Shopmata-white.png"
                            class="h-7"
                            alt=""
                        />
                    </div>
                    <!-- logo end -->

                    <!-- text start -->

                    <div class="space-y-2">
                        <div class="font-extrabold">
                            <h1 class="text-5xl m-">Sell more,</h1>
                            <h1 class="text-5xl">anywhere. Fast.</h1>
                        </div>

                        <div class="font-normal">
                            <p class="text-base">
                                Everything you need to sell online, offline
                                <br />
                                and on social media
                            </p>
                        </div>
                    </div>
                    <!-- text end -->

                    <!-- progress bar -->
                    <div class="mt-10">
                        <ul>
                            <li class="list-none no-underline">
                                <span
                                    :style="{
                                        'border-radius': '50%',
                                        padding: '0.4rem 0.8rem'
                                    }"
                                    class="w-5 h-5 mr-4 border-solid border-2 border-white z-20 bg-indigo-700"
                                    >1</span
                                >
                                <span>Basic Information</span>
                            </li>
                            <div
                                :style="{
                                    'border-left': '2px solid #8A8A99',
                                    'margin-left': '1.2rem',
                                    padding: '1.3rem'
                                }"
                                class="z-0"
                            ></div>
                            <li>
                                <span
                                    :style="{
                                        'border-radius': '50%',
                                        padding: '0.4rem 0.8rem'
                                    }"
                                    class="w-5 h-5 mr-4 border-solid border-2 border-gray-darken z-20 bg-indigo-700 text-gray-darken"
                                    >2</span
                                >
                                <span class="text-gray-darken"
                                    >Create a Store</span
                                >
                            </li>
                            <div
                                :style="{
                                    'border-left': '2px solid #8A8A99',
                                    'margin-left': '1.2rem',
                                    padding: '1.3rem'
                                }"
                                class="z-0"
                            ></div>
                            <li>
                                <span
                                    :style="{
                                        'border-radius': '50%',
                                        padding: '0.4rem 0.8rem'
                                    }"
                                    class="w-5 h-5 mr-4 border-solid border-2 border-gray-darken z-20 bg-indigo-700 text-gray-darken"
                                    >3</span
                                >
                                <span class="text-gray-darken"
                                    >Enter Business Address</span
                                >
                            </li>
                        </ul>
                    </div>
                    <!-- progress bar -->
                </div>
            </div>
        </div>

        <!-- Left div ends -->

        <!-- Right div start -->
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2"
        >
            <div class="mx-auto w-full">
                <div class="flex flex-col justify-center">
                    <div class="flex justify-center my-1">
                        <p class="text-xs text-gray-lighter ">Step 1 of 3</p>
                    </div>
                    <div class="flex justify-center my-1">
                        <h1 class="font-bold text-2xl">
                            Let's Get You Started!
                        </h1>
                    </div>
                    <div class="flex justify-center my-1">
                        <p class="text-gray-lighter text-lg text-center">
                            Enter your details to launch your own store <br />
                            in minutes
                        </p>
                    </div>
                </div>

                <div class="">
                    <div>
                        <div class="mt-1 relative">
                            <div
                                class="absolute inset-0 flex items-center"
                                aria-hidden="true"
                            ></div>
                        </div>
                    </div>

                    <div class="">
                        <form
                            action="#"
                            method="POST"
                            class="space-y-6"
                            v-on:submit.prevent="submit"
                        >
                            <!-- Email address -->
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-darker"
                                >
                                    Email address
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        :class="{
                                            'border-red-600': v$.email.$error,
                                            'border-gray-300': !v$.email.$error
                                        }"
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.email"
                                    />
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.email.$error"
                                    >
                                        {{ v$.email.$errors[0].$message }}
                                    </p>
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="errors"
                                    >
                                        {{ errors.email[0] }}
                                    </p>
                                </div>
                            </div>
                            <!-- Email address end -->

                            <div class="flex">
                                <!-- First name begins -->
                                <div class="lg:w-1/2 md:w-1/2">
                                    <label
                                        for="first_name"
                                        class="block text-sm font-medium text-gray-darker"
                                    >
                                        First Name
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm mr-4"
                                    >
                                        <input
                                            id="first_name"
                                            :class="{
                                                'border-red-600':
                                                    v$.first_name.$error,
                                                'border-gray-300': !v$
                                                    .first_name.$error
                                            }"
                                            name="first_name"
                                            type="text"
                                            autocomplete="first_name"
                                            class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store.first_name"
                                        />
                                    </div>
                                    <div class="mt-1">
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.first_name.$error"
                                        >
                                            {{
                                                v$.first_name.$errors[0]
                                                    .$message
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <!-- First name ends -->
                                <!-- Last name begins -->
                                <div class="lg:w-1/2 md:w-1/2">
                                    <label
                                        for="last_name"
                                        class="block text-sm font-medium text-gray-darker"
                                    >
                                        Last Name
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <input
                                            id="last_name"
                                            name="last_name"
                                            :class="{
                                                'border-red-600':
                                                    v$.last_name.$error,
                                                'border-gray-300': !v$.last_name
                                                    .$error
                                            }"
                                            type="text"
                                            autocomplete="last_name"
                                            class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store.last_name"
                                        />
                                    </div>
                                    <div class="mt-1">
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.last_name.$error"
                                        >
                                            {{
                                                v$.last_name.$errors[0].$message
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Last name ends -->
                            </div>

                            <!-- Password start -->
                            <div class="space-y-1">
                                <label
                                    for="password"
                                    class="block text-sm font-medium text-gray-darker"
                                >
                                    Password
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        :class="{
                                            'border-red-600':
                                                v$.password.$error,
                                            'border-gray-300': !v$.password
                                                .$error
                                        }"
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.password"
                                    />
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.password.$error"
                                    >
                                        {{ v$.password.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <!-- Password end -->

                            <!-- Confirm password start -->
                            <div class="space-y-1">
                                <label
                                    for="confirm_password"
                                    class="block text-sm font-medium text-gray-darker"
                                >
                                    Confirm Password
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="confirm_password"
                                        :class="{
                                            'border-red-600':
                                                v$.password_confirmation.$error,
                                            'border-gray-300': !v$
                                                .password_confirmation.$error
                                        }"
                                        name="confirm_password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.password_confirmation"
                                    />
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.password_confirmation.$error"
                                    >
                                        {{
                                            v$.password_confirmation.$errors[0]
                                                .$message
                                        }}
                                    </p>
                                </div>
                            </div>
                            <!-- Confirm password end -->

                            <!--terms and conditions footnote start -->
                            <div class="flex items-center justify-between">
                                <div class="text-sm">
                                    <span class="text-gray-darker"
                                        >By proceeding, you agree to the</span
                                    >
                                    <inertia-link
                                        href="/login"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        Terms and Conditions
                                    </inertia-link>
                                </div>
                            </div>
                            <!--terms and conditions footnote end -->

                            <!-- button start -->
                            <div class="flex justify-end">
                                <button
                                    v-if="!v$.$error"
                                    :disabled="v$.$error"
                                    :class="{
                                        disabled: loading,
                                        'opacity-25 cursor-not-allowed': loading
                                    }"
                                    type="submit"
                                    class="w-36 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    <svg
                                        v-if="loading"
                                        role="status"
                                        class="mr-5 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        viewBox="0 0 100 101"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"
                                        ></path>
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"
                                        ></path>
                                    </svg>

                                    Next
                                </button>

                                <button
                                    v-else
                                    type="submit"
                                    class="w-36 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Next
                                </button>
                            </div>
                            <!-- button end -->

                            <!-- footnote start -->
                            <div class="flex items-center justify-center">
                                <div class="text-sm">
                                    <span class="text-gray-darker"
                                        >Already have an account?</span
                                    >
                                    <inertia-link
                                        href="/login"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        Log In
                                    </inertia-link>
                                </div>
                            </div>
                            <!-- footnote end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { ref, reactive, computed, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from '@vuelidate/core'
import {
    required,
    email,
    sameAs,
    helpers,
    minLength
} from '@vuelidate/validators'

export default {
    props: {
        errors: Object
    },
    data () {
        return {
            notification: null,
            show: false,
            user: {
                email: '',
                password: ''
            },
            selectStore: false,
            stores: [],
            search: ''
        }
    },

    setup (props) {
        const loading = ref(false)
        let errors = ref(null)

        const store = reactive({
            step: 1,
            email: '',
            first_name: '',
            last_name: '',
            password: '',
            password_confirmation: ''
        })

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage(
                        'Please enter an email address',
                        required
                    ),
                    email
                },
                password: {
                    required: helpers.withMessage(
                        'Please enter a password',
                        required
                    )
                },
                password_confirmation: {
                    required: helpers.withMessage(
                        'Please confirm your password',
                        required
                    ),
                    sameAsPassword: helpers.withMessage(
                        'Passwords do not match',
                        sameAs(store.password)
                    )
                },
                first_name: {
                    required: helpers.withMessage(
                        'Please enter a first name',
                        required
                    )
                },
                last_name: {
                    required: helpers.withMessage(
                        'Please enter a last name',
                        required
                    )
                }
            }
        })

        const v$ = useVuelidate(rules, store)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            axios
                .post('/register', store)
                .then(response => {
                    Inertia.visit('/register/step-2', {
                        method: 'get'
                    })
                })
                .catch(error => {
                    loading.value = false
                    if (error.response.data.errors) {
                        errors.value = error.response.data.errors
                    }
                })
        }

        return {
            store,
            submit,
            v$,
            loading,
            errors
        }
    }
}
</script>

<template>
    <div class="min-h-screen bg-white flex flex-col">
        <!-- mobile banner start -->
        <div
            class="lg:hidden bg-purple-darken h-24 w-full m-0 p-0 flex items-center"
        >
            <div class="pl-8">
                <img src="../../assets/Shopmata-white.png" class="h-5" alt="" />
            </div>
        </div>

        <!-- mobile banner end -->

        <div class="flex flex-row min-h-screen">
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
                class="flex-1 flex flex-col py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2"
            >
                <div class="mx-auto lg:my-auto w-full">
                    <!-- header 1 starts -->

                    <div class="flex flex-col justify-center">
                        <div class="hidden lg:flex  justify-center my-1">
                            <p class="text-xs text-gray-lighter ">
                                Step 1 of 3
                            </p>
                        </div>
                        <div class="flex justify-center my-1">
                            <h1 class="font-bold text-2xl">
                                Let's Get You Started!
                            </h1>
                        </div>
                        <div class="flex justify-center my-1">
                            <p
                                class="text-gray-lighter text-sm lg:text-lg text-center"
                            >
                                Enter your details to launch your own store in
                                minutes
                            </p>
                        </div>
                    </div>
                    <!-- header 1 ends -->

                    <!-- circular progress bar header start -->
                    <div class="lg:hidden flex flex-row items-center">
                        <!-- actual circle -->
                        <div class="wrap-circles">
                            <div class="circle per-25">
                                <div class="inner text-xs">
                                    <p class="text-sm">1 of 3</p>
                                </div>
                            </div>
                        </div>
                        <!-- actual circle end -->

                        <!-- circle text start -->
                        <div class="ml-4 ">
                            <div class="text-xl font-medium text-indigo-700">
                                <p>Basic Information</p>
                            </div>
                            <div class="font-normal text-xs">
                                <p>Next: Create a Store</p>
                            </div>
                        </div>
                        <!-- circle text end -->
                    </div>

                    <!-- circular progress bar header end -->

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
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <input
                                            :class="{
                                                'border-red-600':
                                                    v$.email.$error,
                                                'border-gray-300': !v$.email
                                                    .$error
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
                                    <div class="w-1/2">
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
                                    <div class="w-1/2">
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
                                                    'border-gray-300': !v$
                                                        .last_name.$error
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
                                                    v$.last_name.$errors[0]
                                                        .$message
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
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
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
                                            {{
                                                v$.password.$errors[0].$message
                                            }}
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
                                                    v$.password_confirmation
                                                        .$error,
                                                'border-gray-300': !v$
                                                    .password_confirmation
                                                    .$error
                                            }"
                                            name="confirm_password"
                                            type="password"
                                            autocomplete="current-password"
                                            class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="
                                                store.password_confirmation
                                            "
                                        />
                                    </div>
                                    <div class="mt-1">
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="
                                                v$.password_confirmation.$error
                                            "
                                        >
                                            {{
                                                v$.password_confirmation
                                                    .$errors[0].$message
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Confirm password end -->

                                <!--terms and conditions footnote start -->
                                <div class="flex items-center justify-between">
                                    <div class="text-xs md:text-sm">
                                        <span class="text-gray-darker"
                                            >By proceeding, you agree to
                                            the</span
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
                                        :disabled="loading"
                                        :class="{
                                            disabled: loading,
                                            'opacity-25 cursor-not-allowed': loading
                                        }"
                                        type="submit"
                                        class="w-full lg:w-36 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        <LoadingSpinner v-if="loading" />
                                        Next
                                    </button>

                                    <button
                                        v-else
                                        type="submit"
                                        class="w-full lg:w-36 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
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
    </div>
</template>

<script>
import axios from 'axios'
import { ref, reactive, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from '@vuelidate/core'
import LoadingSpinner from '../Components/LoadingSpinner.vue'
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
    components: { LoadingSpinner },
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

<style scoped>
.wrap-circles {
    justify-content: center;
    align-items: center;
    padding: 2rem 1rem;
    background: #fff;
}

.circle {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0.5rem;
    border-radius: 50%;
    overflow: hidden;
}
.circle.per-25 {
    background-image: conic-gradient(#4338ca 33%, #f7f7f7 0);
}

.circle .inner {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 75px;
    height: 75px;
    background: #fff;
    border-radius: 50%;
    color: black;
}
</style>

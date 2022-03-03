<template>
    <div class="min-h-screen bg-white flex">
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
        >
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <img
                        class="h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                        alt="Workflow"
                    />
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Sign in to your account
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Or
                        {{ " " }}
                        <inertia-link
                            href="register"
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                        >
                            start your 14-day free trial
                        </inertia-link>
                    </p>
                </div>

                <div class="mt-8">
                    <div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">
                                Sign in with
                            </p>

                            <div class="mt-1 grid grid-cols-3 gap-3">
                                <div>
                                    <a
                                        href="#"
                                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                    >
                                        <span class="sr-only"
                                            >Sign in with Facebook</span
                                        >
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </a>
                                </div>

                                <div>
                                    <a
                                        href="#"
                                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                    >
                                        <span class="sr-only"
                                            >Sign in with Twitter</span
                                        >
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"
                                            />
                                        </svg>
                                    </a>
                                </div>

                                <div>
                                    <a
                                        href="#"
                                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                    >
                                        <span class="sr-only"
                                            >Sign in with GitHub</span
                                        >
                                        <LoadingSpinner v-if="loading"/>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 relative">
                            <div
                                class="absolute inset-0 flex items-center"
                                aria-hidden="true"
                            >
                                <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">
                                    Or continue with
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <form
                            action="#"
                            method="POST"
                            class="space-y-6"
                            v-on:submit.prevent="loginUser"
                        >
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <input
                                        :class="{
                                            'border-red-600': v$.email.$error,
                                            'border-gray-300': !v$.email.$error,
                                        }"
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="user.email"
                                    />
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.email.$error"
                                    >
                                        {{ v$.email.$errors[0].$message }}
                                    </p>
                                </div>
                                <div mt-1>
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="loginError"
                                    >
                                        Invalid username/password
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label
                                    for="password"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Password
                                </label>
                                <div class="mt-1">
                                    <input
                                        :class="{
                                            'border-red-600':
                                                v$.password.$error,
                                            'border-gray-300':
                                                !v$.password.$error,
                                        }"
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="user.password"
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

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input
                                        id="remember-me"
                                        name="remember-me"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                    />
                                    <label
                                        for="remember-me"
                                        class="ml-2 block text-sm text-gray-900"
                                    >
                                        Remember me
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <inertia-link
                                        href="password/reset"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        Forgot your password?
                                    </inertia-link>
                                </div>
                            </div>

                            <div>
                                <button
                                    v-if="!v$.$error"
                                    :disabled="loading"
                                    :class="{
                                        disabled: loading,
                                        'opacity-25 cursor-not-allowed':
                                            loading,
                                    }"
                                    type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                <LoadingSpinner v-if="loading"/>

                                    Sign in
                                </button>

                                <button
                                    v-else
                                    type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Sign in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img
                class="absolute inset-0 h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80"
                alt=""
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, reactive, computed, watch } from "vue";
import useVuelidate from "@vuelidate/core";
import { Inertia } from "@inertiajs/inertia";
import { required, email, helpers } from "@vuelidate/validators";
import { Link } from '@inertiajs/inertia-vue3'
import LoadingSpinner from '../Components/LoadingSpinner.vue'

export default {
    data() {
        return {
            notification: null,
            show: false,
            user: {
                email: "",
                password: "",
            },
            selectStore: false,
            stores: [],
            search: "",
        };
    },
    components:{LoadingSpinner},
    setup() {
        const loading = ref(false);
        const user = reactive({
            email: "",
            password: "",
        });
        const loginError = ref(false);

        watch(user, () => (loginError.value = false));

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage(
                        "Please enter an email address",
                        required
                    ),
                    email,
                },
                password: {
                    required: helpers.withMessage(
                        "Please enter a password",
                        required
                    ),
                },
            };
        });

        const v$ = useVuelidate(rules, user);

        async function loginUser() {
            this.v$.$validate();
            if (this.v$.$error) {
                return;
            }
            loading.value = !loading.value;
            axios
                .post("/login", user)
                .then((res) => {
                    Inertia.visit("/dashboard", {
                        method: "get",
                    });
                })
                .catch((error) => {
                    loginError.value = true;
                    loading.value = false;
                });
        }
        return { v$, user, loginUser, loginError, loading };
    },
};
</script>

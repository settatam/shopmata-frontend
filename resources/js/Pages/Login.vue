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
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
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

<template>
    <div class="min-h-screen bg-white flex">
        <div class="hidden lg:block lg:w-1/2 relative w-0 lg:bg-indigo-700" />
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2"
        >
            <div class="mx-auto w-full">
                

                <div class="mt-8">
                    <div>
                        <div>
                            <p class="text-lg font-medium text-gray-700">
                                Sign in with
                            </p>
                        </div>

                        <div class="mt-6 relative">
                            <div
                                class="absolute inset-0 flex items-center"
                                aria-hidden="true"
                            ></div>
                        </div>
                    </div>
                    

                    <div class="mt-6">
                        <form
                            action="#"
                            method="POST"
                            class="space-y-6"
                            v-on:submit.prevent="submit"
                        >
                            <div>
                                <label
                                    for="store_name"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Store Name
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        :class="{'border-red-600': v$.name.$error, 'border-gray-300': !v$.name.$error}"
                                        id="store_name"
                                        name="store_name"
                                        type="text"
                                        autocomplete="store_name"
                                        class="appearance-none block w-full cursor-pointer px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.name"
                                    />
                                    <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                        v-if="errors.name"
                                    >
                                        <svg
                                            class="h-5 w-5 text-red-500"
                                            x-description="Heroicon name: solid/exclamation-circle"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class=" mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.name.$error"
                                    >
                                        {{ v$.name.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Email address
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        :class="{'border-red-600': v$.email.$error, 'border-gray-300': !v$.email.$error}"
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.email"
                                    />
                                    <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                        v-if="errors.email"
                                    >
                                        <svg
                                            class="h-5 w-5 text-red-500"
                                            x-description="Heroicon name: solid/exclamation-circle"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.email.$error"
                                    >
                                        {{ v$.email.$errors[0].$message }}
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
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        :class="{'border-red-600': v$.password.$error, 'border-gray-300': !v$.password.$error}"
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="appearance-none cursor-pointer block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.password"
                                    />
                                    <!-- <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="errors.password">
                      <svg class="h-5 w-5 text-red-500" x-description="Heroicon name: solid/exclamation-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                  </div> -->
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

                            <div class="space-y-1">
                                <label
                                    for="confirm_password"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Confirm Password
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="confirm_password"
                                        :class="{'border-red-600': v$.password_confirmation.$error, 'border-gray-300': !v$.password_confirmation.$error}"
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
                                        {{ v$.password_confirmation.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-sm">
                                    <inertia-link
                                        href="/login"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        Already have an account? Log In
                                    </inertia-link>
                                </div>
                            </div>

                            <div>
                                <button v-if="!v$.$error"
                                    :disabled="v$.$error"
                                    :class="{disabled: loading, 'opacity-25 cursor-not-allowed': loading }"
                                    type="submit"
                                    class="w-full  flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                
                                <svg v-if="loading" role="status" class="mr-5 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
                                </svg>

                                Continue

                                </button>

                                <button v-else
                                    type="submit"
                                    class="w-full  flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                                >
                                    Continue 
                                    
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, reactive, computed, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import useVuelidate from "@vuelidate/core";
import { required, email, sameAs, helpers, minLength } from "@vuelidate/validators";

export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            // loading: false,
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
    methods: {
        toggleShow() {
            this.show = !this.show;
        },
    },

    setup(props) {
        // async registerUser() {
        //   this.loading = true;
        //   try {
        //     const res = await axios.post("/register", { ...this.user});
        //     const { notification, storeCount, stores } = res.data;
        //     if (storeCount > 1) {
        //       this.stores = stores;
        //       this.selectStore = true;
        //     } else {
        //       this.notification = notification;
        //       // window.location.href = "/dashboard";
        //     }
        //   } catch (error) {
        //     console.log(error);
        //     const { notification } = error.response.data;
        //     this.notification = notification;
        //     this.loading = false;
        //   }
        // }
        const loading = ref(false)
        const loginError = ref(false);
        const store = reactive({
            step: 1,
            email: "",
            password: "",
            password_confirmation: "",
            name: "",
        });

        watch(store,() => loginError.value = false);

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage("Please enter an email address", required),
                    email,
                },
                password: { required: helpers.withMessage(
                        "Please enter a password",
                        required
                    ), 
                },
                password_confirmation: {
                    required: helpers.withMessage(
                        "Please confirm your password",
                        required
                    ), 
                    sameAsPassword: helpers.withMessage(
                        "Passwords do not match",
                        sameAs(store.password)
                    ),
                },
                name: {
                    required: helpers.withMessage(
                        "Please enter a valid store name",
                        required
                    ),
                },
            };
        });

        const v$ = useVuelidate(rules, store);

        function submit() {
            this.v$.$validate();
            if (!this.v$.$error) {
                loading.value = !loading.value
                Inertia.post("/register", store);
            } else {
                loginError.value = true
            }
        }

        return {
            store,
            submit,
            v$,
            loading,
            loginError
        };
    },
};
</script>

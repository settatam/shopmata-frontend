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
                            <p class="text-sm font-medium text-gray-700">
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
                                    <span
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.name.$error"
                                    >
                                        {{ v$.name.$errors[0].$message }}
                                    </span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        id="store_name"
                                        name="store_name"
                                        type="text"
                                        autocomplete="store_name"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
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
                            </div>
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Email address
                                    <span
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.email.$error"
                                    >
                                        {{ v$.email.$errors[0].$message }}
                                    </span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
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
                            </div>

                            <div class="space-y-1">
                                <label
                                    for="password"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Password
                                    <span
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.password.$error"
                                    >
                                        {{ v$.password.$errors[0].$message }}
                                    </span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.password"
                                    />
                                    <!-- <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="errors.password">
                      <svg class="h-5 w-5 text-red-500" x-description="Heroicon name: solid/exclamation-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                  </div> -->
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label
                                    for="confirm_password"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Confirm Password
                                    <span
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.password_confirmation.$error"
                                    >
                                        {{
                                            v$.password_confirmation.$errors[0]
                                                .$message
                                        }}
                                    </span>
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="confirm_password"
                                        name="confirm_password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.password_confirmation"
                                    />
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-sm">
                                    <a
                                        href="/login"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        Already have an account? Log In
                                    </a>
                                </div>
                            </div>

                            <div>
                                <button v-if="!v$.$error"
                                    :disabled="v$.$error"
                                    type="submit"
                                    class="w-full  flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >Continue</button>

                                <button v-else
                                    type="submit"
                                    class="w-full  flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                                > <svg class="animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
    <!-- ... -->
  </svg>
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
import { ref, reactive, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import useVuelidate from "@vuelidate/core";
import { required, email, sameAs, helpers } from "@vuelidate/validators";

export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            loading: false,
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

        const store = reactive({
            step: 1,
            email: "",
            password: "",
            password_confirmation: "",
            name: "",
        });

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage("* Invalid email", required),
                    email,
                },
                password: { required },
                password_confirmation: {
                    required: helpers.withMessage(
                        "* Passwords do not match",
                        required
                    ),
                    sameAsPassword: sameAs(store.password),
                },
                name: {
                    required: helpers.withMessage(
                        "* Enter a valid store name",
                        required
                    ),
                },
            };
        });

        const v$ = useVuelidate(rules, store);

        function submit() {
            this.v$.$validate();
            // console.log(this.v$);
            if (!this.v$.$error) {
                Inertia.post("/register", store);
            } else {
                console.log("Errors in your form!");
            }
        }

        return {
            store,
            submit,
            v$,
        };
    },
};
</script>

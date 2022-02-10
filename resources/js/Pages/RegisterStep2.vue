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
                                Store Details
                            </p>
                        </div>
                    </div>

                    <!-- Error message -->
                        <div class="mt-1" > 
                            <p class="text-red-600 text-xs" v-if="loginError"> * You have errors in your form</p>
                        </div>
                    <!-- Error ends -->

                    <div class="mt-6">
                        <form
                            action="#"
                            method="POST"
                            class="space-y-6"
                            @submit.prevent="submit"
                        >
                            <div>
                                <label
                                    for="sales_method_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    How do you currently sell your products
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="sales_method_id"
                                        name="location"
                                        v-model="store.sales_method_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    >
                                        <option value="0">Choose method</option>
                                        <option
                                            v-for="method in methods"
                                            :key="method.id"
                                            :value="method.id"
                                        >
                                            {{ method.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-1">
                                <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.sales_method_id.$error"
                                        >{{
                                            v$.sales_method_id.$errors[0]
                                                .$message
                                        }}
                                    </p>
                            </div>
                            </div>
                            

                            <div>
                                <label
                                    for=""
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    What Industry are you currently operating?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="location"
                                        name="location"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        v-model="store.industry_id"
                                    >
                                        <option value="0">
                                            Choose Industry
                                        </option>
                                        <option
                                            v-for="industry in industries"
                                            :key="industry.id"
                                            :value="industry.id"
                                        >
                                            {{ industry.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.industry_id.$error"
                                        >{{
                                            v$.industry_id.$errors[0].$message
                                        }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label
                                    for="has_website"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Do you currently have a website?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="has_website"
                                        name="has_website"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        v-model="store.has_website"
                                    >
                                        <option value="null">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.has_website.$error"
                                        >{{
                                            v$.has_website.$errors[0].$message
                                        }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label
                                    for="has_website"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Which country will you primarily sell in?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="country"
                                        name="country_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        v-model="store.country_id"
                                    >
                                        <option value="0">
                                            Choose Country
                                        </option>
                                        <option
                                            v-for="country in countries"
                                            :key="country.id"
                                            :value="country.id"
                                        >
                                            {{ country.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.country_id.$error"
                                        >{{
                                            v$.country_id.$errors[0].$message
                                        }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <button
                                    v-if="!v$.$error"
                                    :disabled="v$.$error"
                                    :class="{disabled: loading, 'opacity-25 cursor-not-allowed': loading }"
                                    type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Continue

                                    <svg
                                        v-if="loading"
                                        role="status"
                                        class="ml-4 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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
                                </button>

                                <button
                                    v-else
                                    type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
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
import { required, minValue, helpers, numeric } from "@vuelidate/validators";

export default {
    props: {
        industries: Array,
        methods: Array,
        errors: Object,
        countries: Array,
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
        // },
        toggleShow() {
            this.show = !this.show;
        },
    },

    setup(props) {
        const industries = props.industries;
        const methods = props.methods;
        const selected_method = ref("");
        const loading = ref(false);
        const loginError = ref(false);

        const store = reactive({
            industry_id: 0,
            sales_method_id: 0,
            has_website: 0,
            step: 2,
            country_id: 0,
        });

        watch(store,() => loginError.value = false);

        const rules = computed(() => {
            return {
                sales_method_id: {
                    required,
                    minValueValue: helpers.withMessage(
                        "* Select a valid sales method",
                        minValue(1)
                    ),
                },
                has_website: {
                    required,
                    numeric: helpers.withMessage(
                        "* Select a valid option",
                        numeric
                    ),
                },
                industry_id: {
                    required,
                    minValueValue: helpers.withMessage(
                        "* Select a valid industry",
                        minValue(1)
                    ),
                },
                country_id: {
                    required,
                    minValueValue: helpers.withMessage(
                        "* Select a valid country",
                        minValue(1)
                    ),
                },
            };
        });

        const v$ = useVuelidate(rules, store);

        function submit() {
            this.v$.$validate();
            if (!this.v$.$error) {
                loading.value = !loading.value
                Inertia.put("/store", store);
            } else {
                loginError.value = true
            }
        }
        return {
            industries,
            methods,
            selected_method,
            submit,
            store,
            v$,
            loading,
            loginError
        };
    },
};
</script>

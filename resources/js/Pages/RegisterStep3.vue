<template>
    <div class="min-h-screen bg-white flex">
        <div class="hidden lg:block lg:w-1/2 relative w-0 lg:bg-indigo-700" />
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2"
        >
            <div class="mx-auto w-full">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Enter Your Details
                    </h2>
                    <p>Let's know more about you</p>
                </div>

                <!-- Error message -->
                        <div class="mt-1" > 
                            <p class="text-red-600 text-xs" v-if="loginError"> * Form contains errors</p>
                        </div>
                    <!-- Error ends -->

                <div class="mt-8">
                    <div class="mt-6">
                        <form
                            action="#"
                            method="POST"
                            class="space-y-6"
                            v-on:submit.prevent="submit"
                        >
                        <!-- Store name begins -->
                            <div>
                                <label
                                    for="store_name"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Business Name
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        id="store_name"
                                        name="store_name"
                                        type="text"
                                        autocomplete="store_name"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store_details.business_name"
                                    />
                                    
                                    <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                        v-if="errors.business_name"
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
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.business_name.$error"
                                    >
                                        {{ v$.business_name.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <!-- Store name ends -->
                            <div class="flex">
                                <!-- First name begins -->
                                <div class="lg:w-1/2 md:w-1/2">
                                    <label
                                        for="first_name"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        First Name
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm mr-4"
                                    >
                                        <input
                                            id="first_name"
                                            name="first_name"
                                            type="text"
                                            autocomplete="first_name"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.first_name"
                                        />
                                    </div>
                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.first_name.$error"
                                    >
                                        {{ v$.first_name.$errors[0].$message }}
                                    </p>
                                    </div>
                                </div>
                                <!-- First name ends -->
                                <!-- Last name begins -->
                                <div class="lg:w-1/2 md:w-1/2">
                                    <label
                                        for="last_name"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Last Name
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <input
                                            id="last_name"
                                            name="last_name"
                                            type="text"
                                            autocomplete="last_name"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.last_name"
                                        />

                                    </div>
                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.last_name.$error"
                                    >
                                        {{ v$.last_name.$errors[0].$message }}
                                    </p>
                                    </div>
                                </div>
                                <!-- Last name ends -->
                            </div>

                            <!-- phone starts -->
                            <div>
                                <label
                                        for="last_name"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Phone
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center"
                                        >
                                            <label for="country" class="sr-only"
                                                >Country</label
                                            >
                                            <select
                                                id="country"
                                                name="country"
                                                class="h-full py-0 pl-4 pr-8 border-transparent bg-transparent text-gray-500 focus:ring-indigo-500 focus:border-indigo-500 rounded-md"
                                                v-model="
                                                    store_details.country_id
                                                "
                                            >
                                                <option
                                                    v-for="country in countries"
                                                    :value="country.id"
                                                    :key="country.id"
                                                >
                                                    {{ country.iso_code_2 }}
                                                </option>
                                            </select>
                                        </div>
                                        <input
                                            type="text"
                                            name="phone-number"
                                            id="phone-number"
                                            autocomplete="tel"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 pl-20 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="0803 123 5678"
                                            v-model="store_details.phone"
                                        />
                                        
                                    </div>
                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.phone.$error"
                                    >
                                        {{ v$.phone.$errors[0].$message }}
                                    </p>
                                    </div>
                            </div> 
                            <!-- phone ends -->

                            <!-- Street address begins -->
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Street Address
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        id="address"
                                        name="address"
                                        type="text"
                                        autocomplete="address"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store_details.address"
                                    />
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.address.$error"
                                    >
                                        {{ v$.address.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <!-- Street address ends -->

                            <div class="flex">
                                <!-- Suite apt begins -->
                                <div class="lg:w-1/2 md:w-1/2">
                                    <label
                                        for="address2"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Suite / Apt
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm mr-4"
                                    >
                                        <input
                                            id="address2"
                                            name="address2"
                                            type="text"
                                            autocomplete="address2"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.address2"
                                        />
                                    </div>

                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.address2.$error"
                                    >
                                        {{ v$.address2.$errors[0].$message }}
                                    </p>
                                    </div>
                                </div>
                                <!-- Suite apt ends -->
                                <!-- city begins-->
                                    
                                <div class="lg:w-1/2 md:w-1/2">
                                    <label
                                        for="city"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        City
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <input
                                            id="city"
                                            name="city"
                                            type="text"
                                            autocomplete="city"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.city"
                                        />
                                    </div>
                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.city.$error"
                                    >
                                        {{ v$.city.$errors[0].$message }}
                                    </p>
                                    </div>
                                </div>
                                    

                                <!-- city ends -->
                            </div>
                                                   
                            <div class="flex">

                                <!-- Country starts -->
                                <div class="lg:w-1/3 md:w-1/3 lg:mr-4 md:mr-4">
                                    <label
                                        for="country_id"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Country
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <select
                                            name="country_id"
                                            id="country_id"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            v-model="store_details.country_id"
                                        >
                                            <option
                                                v-for="country in countries"
                                                :value="country.id"
                                                :key="country.id"
                                            >
                                                {{ country.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Country ends -->

                                <!-- State starts -->
                                <div class="lg:w-1/3 md:w-1/3 lg:mr-4 md:mr-4">
                                    <label
                                        for="state_id"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        State / Province
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                        v-if="states.length"
                                    >
                                        <select
                                            name="state_id"
                                            id="state_id"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            v-model="store_details.state_id"
                                        >
                                            <option
                                                v-for="state in states"
                                                :value="state.id"
                                                :key="state.id"
                                            >
                                                {{ state.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.state_id.$error"
                                    >
                                        {{ v$.state_id.$errors[0].$message }}
                                    </p>
                                    </div>

                                    <!-- <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                        v-else
                                    >
                                        <input
                                            id="state"
                                            name="state"
                                            type="text"
                                            autocomplete="state"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.state"
                                        />
                                    </div> -->
                                    <!-- <div>
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.state.$error"
                                    >
                                        {{ v$.state.$errors[0].$message }}
                                    </p>
                                    </div> -->
                                </div>

                                <!-- State ends -->

                                <!-- Zip starts -->

                                <div class="lg:w-1/3 md:w-1/3">
                                    <label
                                        for="postal-code"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Zip / Postal Code
                                    </label>
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <input
                                            id="postal-code"
                                            name="postal_code"
                                            type="text"
                                            autocomplete="postal-code"
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.postal_code"
                                        />
                                        
                                    </div>
                                    <div class="mt-1">
                                        <p
                                        class="text-red-600 text-xs mx-4"
                                        v-if="v$.postal_code.$error"
                                    >
                                        {{ v$.postal_code.$errors[0].$message }}
                                    </p>
                                    </div>
                                </div>

                                <!-- Zip ends -->
                            </div>
                            
                            <!-- Buttons start -->
                            <div class="flex justify-between">
                                <inertia-link href="/register/step-2"> Back </inertia-link>
                                <button
                                    v-if="!v$.$error"
                                    :disabled="v$.$error"
                                    type="submit"
                                    :class="{disabled: loading, 'opacity-25 cursor-not-allowed': loading }"
                                    class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Go To Dashboard

                                    <svg v-if="loading" role="status" class="ml-4 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
                                </svg>

                                </button>


                                <!-- else -->
                                <button
                                    v-else
                                    type="submit"
                                    class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Go To Dashboard
                                </button>
                            </div>

                            <!-- Buttons end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, computed, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import useVuelidate from "@vuelidate/core";
import { required, helpers, numeric, minValue, } from "@vuelidate/validators";

export default {
    props: {
        countries: Array,
        states: Array,
        store: Object,
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
        async registerUser() {
            this.loading = true;
            try {
                const res = await axios.post("/register", { ...this.user });
                const { notification, storeCount, stores } = res.data;
                if (storeCount > 1) {
                    this.stores = stores;
                    this.selectStore = true;
                } else {
                    this.notification = notification;
                    // window.location.href = "/dashboard";
                }
            } catch (error) {
                console.log(error);
                const { notification } = error.response.data;
                this.notification = notification;
                this.loading = false;
            }
        },
        toggleShow() {
            this.show = !this.show;
        },
    },

    setup(props) {
        const store_details = reactive(props.store);
        const loading = ref(false);
        const loginError = ref(false);

        watch(store_details,() => loginError.value = false);

        // start

        const rules = computed(() => {
            return {
                business_name: {
                    required: helpers.withMessage("* Enter a valid business name", required),
                },
                first_name: {
                    required: helpers.withMessage("* Enter a valid first name", required),
                },
                last_name: {
                    required: helpers.withMessage("* Enter a valid last name", required),
                },
                address: {
                    required: helpers.withMessage("* Enter a valid address", required),
                },
                address2: {
                    required: helpers.withMessage("* Enter a valid address", required),
                },
                city: {
                    required: helpers.withMessage("* Enter a valid city", required),
                },
                country_id: {
                    required: helpers.withMessage("* Invalid email", required),
                },
                phone: {
                    required: helpers.withMessage("* Invalid phone number", required),
                    numeric,
                },
                country_id: {
                    required,
                    minValueValue: helpers.withMessage(
                        "* Select a valid country",
                        minValue(1)
                    ),
                },
                state_id: {
                    required: helpers.withMessage("* Select a state", required),
                },
                postal_code: {
                    required: helpers.withMessage("* Invalid zip/postal code", required),
                    numeric,
                },
            };
        });
        // end

        const v$ = useVuelidate(rules, store_details);

        function submit() {
            this.v$.$validate();
            // console.log(store_details)
            if(!this.v$.$error){
                store_details.step = 3;
                loading.value = !loading.value
            Inertia.put("/store", store_details);
            } else {
                loginError.value = true
            }
        }

        return {
            store_details,
            submit,
            loading,
            v$,
            loginError
        };
    },
};
</script>

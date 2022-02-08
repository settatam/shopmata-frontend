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

                <div class="mt-8">
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
                                    Business Name
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        id="store_name"
                                        name="store_name"
                                        type="text"
                                        autocomplete="store_name"
                                        required=""
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
                            </div>
                            <div class="flex">
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
                                            required=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.first_name"
                                        />
                                    </div>
                                </div>
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
                                            required=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.last_name"
                                        />
                                    </div>
                                </div>
                            </div>
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
                                        required=""
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store_details.address"
                                    />
                                </div>
                            </div>

                            <div class="flex">
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
                                </div>

                                 <!-- cities -->
                                    <label
                                        for="state_id"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Cities
                                    </label>
                                    

                                 <!-- cities -->
                            </div>
                            <!--  -->
                            
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
                            </div>    
                            <!--  -->
                            <div class="flex">
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
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                        v-else
                                    >
                                        <input
                                            id="state"
                                            name="state"
                                            type="text"
                                            autocomplete="state"
                                            required=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store_details.state"
                                        />
                                    </div>
                                </div>
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
                                </div>
                            </div>
                            <!--  -->
                            <div class="flex justify-between">
                                <inertia-link href="/register/step-2"> Back </inertia-link>
                                <button
                                    type="submit"
                                    class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Go To Dashboard
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
import { ref, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

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

        function submit() {
            store_details.step = 3;
            Inertia.put("/store", store_details);
        }

        return {
            store_details,
            submit,
        };
    },
};
</script>

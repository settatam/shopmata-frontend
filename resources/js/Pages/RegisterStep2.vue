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
                                    'border-left': '2px solid #fff',
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
                                    class="w-5 h-5 mr-4 border-solid border-2 border-white z-20 bg-indigo-700 text-white"
                                    >2</span
                                >
                                <span class="text-white">Create a Store</span>
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

        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2"
        >
            <div class="mx-auto w-full">
                <div class="flex flex-col justify-center">
                    <div class="flex justify-center my-1">
                        <p class="text-xs text-gray-lighter ">Step 2 of 3</p>
                    </div>
                    <div class="flex justify-center my-1">
                        <h1 class="font-bold text-2xl">
                            Create Your First Online Store
                        </h1>
                    </div>
                    <div class="flex justify-center my-1">
                        <p class="text-gray-lighter text-lg text-center">
                            Set up your online store website in minutes
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form
                            action="#"
                            method="POST"
                            class="space-y-6"
                            @submit.prevent="submit"
                        >
                            <!-- Store name starts -->
                            <div>
                                <label
                                    for="store_name"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Store name
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        :class="{
                                            'border-red-600': v$.name.$error,
                                            'border-gray-300': !v$.name.$error
                                        }"
                                        id="store_name"
                                        name="store_name"
                                        type="text"
                                        autocomplete="store_name"
                                        class="appearance-none block w-full cursor-pointer px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="store.name"
                                    />
                                    <!-- <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                        v-if="errors.name"
                                    ></div> -->
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.name.$error"
                                    >
                                        {{ v$.name.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <!-- Store name ends -->

                            <!-- store domain starts -->
                            <div>
                                <label
                                    for="store_domain"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Store domain
                                </label>
                                <div
                                    class="mt-1 relative rounded-md shadow-sm flex"
                                >
                                    <input
                                        :class="{
                                            'border-red-600': v$.name.$error,
                                            'border-gray-300': !v$.name.$error
                                        }"
                                        id="store_domain"
                                        name="store_domain"
                                        type="text"
                                        autocomplete="store_domain"
                                        class="appearance-none flex-none w-full cursor-pointer px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm flex pr-32"
                                        v-model="store.domain"
                                    />

                                    <span
                                        class="flex absolute right-0 bg-transparent rounded text-base text-gray-600 p-2"
                                    >
                                        <p>.Shopmata.com</p>
                                    </span>
                                    <!-- <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                        v-if="errors.name"
                                    ></div> -->
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.domain.$error"
                                    >
                                        {{ v$.domain.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <!-- store domain ends -->

                            <!-- Business size starts -->
                            <div>
                                <label
                                    for="sales_method_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    What size is your online business?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="sales_method_id"
                                        
                                        name="location"
                                        v-model="store.sales_method_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    >
                                        <option value="0">Select</option>
                                        <!-- <option
                                            v-for="method in methods"
                                            :key="method.id"
                                            :value="method.id"
                                        >
                                            {{ method.name }}
                                        </option> -->
                                    </select>
                                </div>
                                <!-- <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.sales_method_id.$error"
                                    >
                                        {{
                                            v$.sales_method_id.$errors[0]
                                                .$message
                                        }}
                                    </p>
                                </div> -->
                            </div>
                            <!-- Business size ends -->

                            <!-- business practice starts -->
                            <div>
                                <label
                                    for=""
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    What best descibes how you currently sell
                                    your products?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="sales_method_id"
                                        :class="{
                                            'border-red-600':
                                                v$.sales_method_id.$error,
                                            'border-gray-300':
                                                !v$.sales_method_id.$error,
                                        }"
                                        name="location"
                                        v-model="store.sales_method_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    >
                                        <option value="0">Select</option>
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
                                        class="text-red-600 text-xs"
                                        v-if="v$.sales_method_id.$error"
                                    >
                                        {{ v$.sales_method_id.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                            <!-- business practice ends -->

                            <!-- indusry start -->
                            <div>
                                <label
                                    for=""
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    What industry will you be operating in?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="location"
                                        :class="{
                                            'border-red-600':
                                                v$.industry_id.$error,
                                            'border-gray-300': !v$.industry_id
                                                .$error
                                        }"
                                        name="location"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        v-model="store.industry_id"
                                    >
                                        <option value="0">
                                            Select
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
                                        class="text-red-600 text-xs"
                                        v-if="v$.industry_id.$error"
                                    >
                                        {{ v$.industry_id.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>

                            <!-- industry end -->

                            <!-- website start -->
                            <div>
                                <label
                                    for="has_website"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Do you have an existing website?
                                </label>

                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        id="has_website"
                                        :class="{
                                            'border-red-600':
                                                v$.has_website.$error,
                                            'border-gray-300': !v$.has_website
                                                .$error
                                        }"
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
                                        class="text-red-600 text-xs"
                                        v-if="v$.has_website.$error"
                                    >
                                        {{ v$.has_website.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>

                            <!-- website end -->

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
import { required, minValue, helpers, numeric } from '@vuelidate/validators'

export default {
    props: {
        industries: Array,
        methods: Array,
        errors: Object,
        countries: Array
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
        const industries = props.industries
        const methods = props.methods
        const selected_method = ref('')
        const loading = ref(false)
        const store = reactive({
            name: "",
            domain: "",
            industry_id: 0,
            has_website: null,
            sales_method_id: 0,
            step: 2,         
        })

        const rules = computed(() => {
            return {
                sales_method_id: {
                    required,
                    minValueValue: helpers.withMessage(
                        'Please enter a valid sales method',
                        minValue(1)
                    )
                },
                has_website: {
                    required,
                    numeric: helpers.withMessage(
                        'Please select a valid option',
                        numeric
                    )
                },
                industry_id: {
                    required,
                    minValueValue: helpers.withMessage(
                        'Please select a valid industry',
                        minValue(1)
                    )
                },
                name: {
                    required: helpers.withMessage(
                        'Please enter a valid store name',
                        required
                    )
                },
                domain: {
                    required: helpers.withMessage(
                        'Please enter a valid store domain',
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
            loading.value = !loading.value
            Inertia.post('/store/create', store)
        }
        return {
            industries,
            methods,
            selected_method,
            submit,
            store,
            v$,
            loading
        }
    }
}
</script>

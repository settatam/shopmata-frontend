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
            <!-- rest -->
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
                                    <span class="text-white"
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

            <div
                class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2"
            >
                <div class="mx-auto lg:my-auto w-full">
                    <div class="flex flex-col justify-center">
                        <div class="hidden lg:flex justify-center my-1">
                            <p class="text-xs text-gray-lighter">Step 2 of 3</p>
                        </div>
                        <div class="flex justify-center my-1">
                            <h1 class="font-bold text-2xl">
                                Create Your First Online Store
                            </h1>
                        </div>
                        <div class="flex justify-center my-1">
                            <p
                                class="text-gray-lighter text-xs md:text-lg text-center"
                            >
                                Set up your online store website in minutes
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
                                    <p class="text-sm">2 of 3</p>
                                </div>
                            </div>
                        </div>

                        <!-- actual circle end -->

                        <!-- circle text start -->
                        <div class=" ">
                            <div class="text-xl font-medium text-indigo-700">
                                <p>Create a Store</p>
                            </div>
                            <div class="font-normal text-xs">
                                <p>Next: Enter Business Address</p>
                            </div>
                        </div>
                        <!-- circle text end -->
                    </div>

                    <!-- circular progress bar header end -->

                    <div class="mt-1">
                        <div class="mt-1">
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
                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <input
                                            :class="{
                                                'border-red-600':
                                                    v$.store_name.$error,
                                                'border-gray-300': !v$
                                                    .store_name.$error
                                            }"
                                            id="store_name"
                                            name="store_name"
                                            type="text"
                                            autocomplete="store_name"
                                            class="appearance-none block w-full cursor-pointer px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="store.store_name"
                                        />
                                        <!-- <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                        v-if="errors.name"
                                    ></div> -->
                                    </div>
                                    <div class="mt-1">
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.store_name.$error"
                                        >
                                            {{
                                                v$.store_name.$errors[0]
                                                    .$message
                                            }}
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
                                                'border-red-600':
                                                    v$.store_domain.$error,
                                                'border-gray-300': !v$
                                                    .store_domain.$error
                                            }"
                                            id="store_domain"
                                            name="store_domain"
                                            type="text"
                                            autocomplete="store_domain"
                                            class="appearance-none flex-none w-full cursor-pointer px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm flex pr-32"
                                            v-model="store.store_domain"
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
                                            v-if="v$.store_domain.$error"
                                        >
                                            {{
                                                v$.store_domain.$errors[0]
                                                    .$message
                                            }}
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

                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <select
                                            id="sales_method_id"
                                            name="location"
                                            v-model="store.size_of_business"
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
                                        What best descibes how you currently
                                        sell your products?
                                    </label>

                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <select
                                            id="sales_method_id"
                                            :class="{
                                                'border-red-600':
                                                    v$.sales_method_id.$error,
                                                'border-gray-300': !v$
                                                    .sales_method_id.$error
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
                                            {{
                                                v$.sales_method_id.$errors[0]
                                                    .$message
                                            }}
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

                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <select
                                            id="location"
                                            :class="{
                                                'border-red-600':
                                                    v$.industry_id.$error,
                                                'border-gray-300': !v$
                                                    .industry_id.$error
                                            }"
                                            name="location"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            v-model="store.industry_id"
                                        >
                                            <option value="0">Select</option>
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
                                            {{
                                                v$.industry_id.$errors[0]
                                                    .$message
                                            }}
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

                                    <div
                                        class="mt-1 relative rounded-md shadow-sm"
                                    >
                                        <select
                                            id="has_website"
                                            :class="{
                                                'border-red-600':
                                                    v$.has_website.$error,
                                                'border-gray-300': !v$
                                                    .has_website.$error
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
                                            {{
                                                v$.has_website.$errors[0]
                                                    .$message
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <!-- website end -->

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
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- rest ends -->
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { ref, reactive, computed, onMounted, onUpdated } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from '@vuelidate/core'
import { required, minValue, helpers, numeric } from '@vuelidate/validators'
import LoadingSpinner from '../Components/LoadingSpinner.vue'

export default {
    props: {
        industries: Array,
        methods: Array,
        errors: Object,
        countries: Array,
        store: Object
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
        const storeProp = reactive(props.store)
        const store = reactive({})

        onMounted(() => {
            if (props.store == null) {
                store.store_name = ''
                store.store_domain = ''
                store.industry_id = 0
                store.has_website = null
                store.sales_method_id = 0
                store.size_of_business = ''
                store.step = 2
            } else {
                store.store_name = storeProp.name
                store.store_domain = storeProp.store_domain
                store.industry_id = storeProp.industry_id
                store.has_website = storeProp.has_website
                store.sales_method_id = storeProp.sales_method_id
                store.size_of_business = storeProp.size_of_business
                store.step = storeProp.step
                store.id = storeProp.id
            }
        })

        const industries = props.industries
        const methods = props.methods
        const selected_method = ref('')
        const loading = ref(false)

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
                store_name: {
                    required: helpers.withMessage(
                        'Please enter a valid store name',
                        required
                    )
                },
                store_domain: {
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
            loading.value = true
            axios
                .post('/store/create', store)
                .then(response => {
                    Inertia.visit('/register/step-3', {
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
            industries,
            methods,
            selected_method,
            submit,
            store,
            v$,
            loading,
            storeProp
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
    background-image: conic-gradient(#4338ca 66%, #f7f7f7 0);
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

<template>
    <div class="min-h-screen bg-white flex flex-col">
        <div>
            <!-- mobile banner start -->
            <div
                class="lg:hidden bg-purple-darken h-24 w-full m-0 p-0 flex items-center"
            >
                <div class="pl-8">
                    <img
                        src="../../assets/Shopmata-white.png"
                        class="h-5"
                        alt=""
                    />
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
                                        Everything you need to sell online,
                                        offline
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
                                            >3</span
                                        >
                                        <span class="text-white"
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
                                <p class="text-xs text-gray-lighter ">
                                    Step 3 of 3
                                </p>
                            </div>
                            <div class="flex justify-center my-1">
                                <h1 class="font-bold text-2xl">
                                    Add Your Business Address
                                </h1>
                            </div>
                            <div class="flex justify-center my-1">
                                <p
                                    class="text-gray-lighter text-lg text-center"
                                >
                                    This address will be used as your default
                                    business address. It can be changed later
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
                                        <p class="text-sm">3 of 3</p>
                                    </div>
                                </div>
                            </div>
                            <!-- actual circle end -->

                            <!-- circle text start -->
                            <div class="ml-4 ">
                                <div
                                    class="text-xl font-medium text-indigo-700"
                                >
                                    <p>Enter Business Address</p>
                                </div>
                            </div>
                            <!-- circle text end -->
                        </div>

                        <!-- circular progress bar header end -->

                        <div class="mt-8">
                            <div class="mt-6">
                                <form
                                    action="#"
                                    method="POST"
                                    class="space-y-6"
                                    v-on:submit.prevent="submit"
                                >
                                    <!-- Street address begins -->
                                    <div>
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Address
                                        </label>
                                        <div
                                            class="mt-1 relative rounded-md shadow-sm"
                                        >
                                            <input
                                                id="address"
                                                :class="{
                                                    'border-red-600':
                                                        v$.address.$error,
                                                    'border-gray-300': !v$
                                                        .address.$error
                                                }"
                                                name="address"
                                                type="text"
                                                autocomplete="address"
                                                class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                v-model="store_details.address"
                                            />
                                        </div>
                                        <div class="mt-1">
                                            <p
                                                class="text-red-600 text-xs"
                                                v-if="v$.address.$error"
                                            >
                                                {{
                                                    v$.address.$errors[0]
                                                        .$message
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Street address ends -->

                                    <!-- Suite apt begins -->
                                    <div class="w-full">
                                        <label
                                            for="address2"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Apartment/Suite
                                        </label>
                                        <div
                                            class="mt-1 relative rounded-md shadow-sm "
                                        >
                                            <input
                                                id="address2"
                                                :class="{
                                                    'border-red-600':
                                                        v$.address2.$error,
                                                    'border-gray-300': !v$
                                                        .address2.$error
                                                }"
                                                name="address2"
                                                type="text"
                                                autocomplete="address2"
                                                class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                v-model="store_details.address2"
                                            />
                                        </div>

                                        <div class="mt-1">
                                            <p
                                                class="text-red-600 text-xs"
                                                v-if="v$.address2.$error"
                                            >
                                                {{
                                                    v$.address2.$errors[0]
                                                        .$message
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Suite apt ends -->

                                    <div class="flex">
                                        <!-- Country starts -->
                                        <div class="w-1/2 mr-4">
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
                                                    :class="{
                                                        'border-red-600':
                                                            v$.country_id
                                                                .$error,
                                                        'border-gray-300': !v$
                                                            .country_id.$error
                                                    }"
                                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                    v-model="
                                                        store_details.country_id
                                                    "
                                                >
                                                    <option value="null"
                                                        >Select Country</option
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
                                        <div class="w-1/2">
                                            <label
                                                for="state_id"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                State
                                            </label>
                                            <div
                                                class="mt-1 relative rounded-md shadow-sm"
                                                v-if="states.length"
                                            >
                                                <select
                                                    name="state_id"
                                                    :class="{
                                                        'border-red-600':
                                                            v$.state_id.$error,
                                                        'border-gray-300': !v$
                                                            .state_id.$error
                                                    }"
                                                    id="state_id"
                                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                    v-model="
                                                        store_details.state_id
                                                    "
                                                >
                                                    <option
                                                        v-for="state in states[0]
                                                            .states"
                                                        :value="state.id"
                                                        :key="state.id"
                                                    >
                                                        {{ state.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- v-else -->
                                            <div
                                                class="mt-1 relative rounded-md shadow-sm"
                                                v-else
                                            >
                                                <select
                                                    name="state_id"
                                                    :class="{
                                                        'border-red-600':
                                                            v$.state_id.$error,
                                                        'border-gray-300': !v$
                                                            .state_id.$error
                                                    }"
                                                    id="state_id"
                                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                    v-model="
                                                        store_details.state_id
                                                    "
                                                >
                                                    <option value="null"
                                                        >Select State</option
                                                    >
                                                </select>
                                            </div>

                                            <div class="mt-1">
                                                <p
                                                    class="text-red-600 text-xs"
                                                    v-if="v$.state_id.$error"
                                                >
                                                    {{
                                                        v$.state_id.$errors[0]
                                                            .$message
                                                    }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- State ends -->
                                    </div>

                                    <div class="flex">
                                        <!-- city begins-->

                                        <div class="w-1/2 mr-4 ">
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
                                                    :class="{
                                                        'border-red-600':
                                                            v$.city.$error,
                                                        'border-gray-300': !v$
                                                            .city.$error
                                                    }"
                                                    name="city"
                                                    type="text"
                                                    autocomplete="city"
                                                    class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="store_details.city"
                                                />
                                            </div>
                                            <div class="mt-1">
                                                <p
                                                    class="text-red-600 text-xs"
                                                    v-if="v$.city.$error"
                                                >
                                                    {{
                                                        v$.city.$errors[0]
                                                            .$message
                                                    }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- city ends -->

                                        <!-- Zip starts -->

                                        <div class="w-1/2">
                                            <label
                                                for="postal-code"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Zip Code
                                            </label>
                                            <div
                                                class="mt-1 relative rounded-md shadow-sm"
                                            >
                                                <input
                                                    id="postal-code"
                                                    name="zip"
                                                    :class="{
                                                        'border-red-600':
                                                            v$.zip.$error,
                                                        'border-gray-300': !v$
                                                            .zip.$error
                                                    }"
                                                    type="text"
                                                    autocomplete="postal-code"
                                                    class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="store_details.zip"
                                                />
                                            </div>
                                            <div class="mt-1">
                                                <p
                                                    class="text-red-600 text-xs"
                                                    v-if="v$.zip.$error"
                                                >
                                                    {{
                                                        v$.zip.$errors[0]
                                                            .$message
                                                    }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Zip ends -->
                                    </div>

                                    <!-- phone starts -->
                                    <div>
                                        <label
                                            for="last_name"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Phone Number
                                        </label>
                                        <div
                                            class="mt-1 relative rounded-md shadow-sm"
                                        >
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center"
                                            >
                                                <label
                                                    for="country"
                                                    class="sr-only"
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
                                                :class="{
                                                    'border-red-600':
                                                        v$.phone.$error,
                                                    'border-gray-300': !v$.phone
                                                        .$error
                                                }"
                                                id="phone-number"
                                                autocomplete="tel"
                                                class="appearance-none block w-full px-3 py-2 border pl-20 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                placeholder="0803 123 5678"
                                                v-model="store_details.phone"
                                            />
                                        </div>
                                        <div class="mt-1">
                                            <p
                                                class="text-red-600 text-xs"
                                                v-if="v$.phone.$error"
                                            >
                                                {{
                                                    v$.phone.$errors[0].$message
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- phone ends -->

                                    <!-- Buttons start -->
                                    <div class="flex justify-between">
                                        <inertia-link
                                            class="flex justify-center py-2 w-36 border-gray-darken border rounded-md bg-white shadow-sm text-sm font-medium hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="/register/step-2?back=1"
                                        >
                                            Back
                                        </inertia-link>
                                        <button
                                            v-if="!v$.$error"
                                            :disabled="loading"
                                            type="submit"
                                            :class="{
                                                disabled: loading,
                                                'opacity-25 cursor-not-allowed': loading
                                            }"
                                            class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            <LoadingSpinner v-if="loading" />
                                            Enter My Store
                                        </button>

                                        <!-- else -->
                                        <button
                                            v-else
                                            type="submit"
                                            class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Enter My Store
                                        </button>
                                    </div>

                                    <!-- Buttons end -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, computed, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from '@vuelidate/core'
import { required, helpers, numeric, minValue } from '@vuelidate/validators'
import LoadingSpinner from '../Components/LoadingSpinner.vue'

export default {
    props: {
        countries: Array,
        store: Object,
        errors: Object
    },
    data () {
        return {
            loading: false,
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
        const countries = props.countries

        const store_details = reactive({
            address: '',
            address2: '',
            country_id: null,
            state_id: null,
            city: '',
            zip: '',
            phone: '',
            step: 3
        })

        const states = computed(() => {
            return countries.filter(
                country => country.id == store_details.country_id
            )
        })

        const loading = ref(false)

        // start

        const rules = computed(() => {
            return {
                address: {
                    required: helpers.withMessage('Enter an address', required)
                },
                address2: {
                    required: helpers.withMessage('Enter an address', required)
                },
                city: {
                    required: helpers.withMessage('Enter a city', required)
                },
                country_id: {
                    required: helpers.withMessage('Invalid country', required)
                },
                phone: {
                    required: helpers.withMessage(
                        'Enter a phone number',
                        required
                    ),
                    numeric
                },
                state_id: {
                    required: helpers.withMessage('* Select a state', required)
                },
                zip: {
                    required: helpers.withMessage(
                        'Enter a postal code',
                        required
                    ),
                    numeric
                }
            }
        })
        // end

        const v$ = useVuelidate(rules, store_details)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            axios
                .put('/store', store_details)
                .then(response => {
                    Inertia.visit('/dashboard', {
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
            store_details,
            submit,
            loading,
            v$,
            countries,
            states
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

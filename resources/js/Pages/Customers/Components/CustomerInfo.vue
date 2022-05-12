<template>
    <!-- Main content -->
    <div class=" bg-white my-7 mx-auto rounded-md">
        <!-- header -->
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">Customer Information</h1>
        </div>

        <AddLead
            @close-modal="pushValue"
            :leads="leads"
            @close="popUp = false"
            v-if="popUp"
        />

        <div class="px-6 pt-6  flex flex-row space-x-4">
            <div class="space-x-2">
                <input
                    type="radio"
                    id="easy"
                    value="easy"
                    v-model="CustomerInfo.customerDifficulty"
                />
                <label for="easy">Easy</label>
            </div>
            <div class="space-x-2">
                <input
                    type="radio"
                    id="med"
                    value="med"
                    v-model="CustomerInfo.customerDifficulty"
                />
                <label for="med">Med</label>
            </div>
            <div class="space-x-2">
                <input
                    type="radio"
                    id="hard"
                    value="hard"
                    v-model="CustomerInfo.customerDifficulty"
                />
                <label for="hard">Hard</label>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-4">
                <div>
                    <inertia-link
                        class="text-purple-darken 2xl font-bold"
                        :href="'/admin/customers/' + customer.id"
                        >{{ customer.first_name }} {{ customer.last_name }} (ID:
                        {{ customer.id }})</inertia-link
                    >
                </div>
                <!-- first row start -->

                <div class="flex flex-col lg:flex-row">
                    <div class="required w-full mr-5 mt-4 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                First Name
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.first_name.$error,
                                    'border-gray-300': !v$.first_name.$error
                                }"
                                type="text"
                                id="firstName"
                                name="firstName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.first_name"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.first_name.$error"
                            >
                                {{ v$.first_name.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div class="required w-full mt-4 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Last Name
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.last_name.$error,
                                    'border-gray-300': !v$.last_name.$error
                                }"
                                type="text"
                                id="lastName"
                                name="lastName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.last_name"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.last_name.$error"
                            >
                                {{ v$.last_name.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- first row end -->

                <!-- secnd start -->

                <div class="flex flex-col lg:flex-row">
                    <div class="required w-full mr-5 mt-4 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Address 1:
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.address.$error,
                                    'border-gray-300': !v$.address.$error
                                }"
                                type="text"
                                id="firstName"
                                name="firstName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.address"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.address.$error"
                            >
                                {{ v$.address.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div class="required w-full mt-4 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Address 2:
                            </label>
                            <input
                                type="text"
                                id="lastName"
                                name="lastName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.addressTwo"
                            />
                        </div>
                    </div>
                </div>

                <!-- second end -->

                <!-- third start -->

                <div class="flex flex-col lg:flex-row mt-4">
                    <div class="required w-full">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                City
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.city.$error,
                                    'border-gray-300': !v$.city.$error
                                }"
                                type="text"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.city"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.city.$error"
                            >
                                {{ v$.city.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="required w-full  mt-4 lg:mt-0 ml-0 lg:ml-5 relative"
                    >
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                State
                            </label>
                            <!-- state v-if start -->

                            <div v-if="states.length">
                                <select
                                    id="state"
                                    name="state"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="CustomerInfo.state_id"
                                    :class="{
                                        'border-red-600': v$.state_id.$error,
                                        'border-gray-300': !v$.state_id.$error
                                    }"
                                >
                                    <option value="">Choose a State</option>
                                    <option
                                        v-for="(state, index) in states"
                                        :key="index"
                                        :value="state.id"
                                    >
                                        {{ state.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- state v-if end -->
                            <!-- v-else -->
                            <div v-else>
                                <select
                                    :class="{
                                        'border-red-600': v$.state_id.$error,
                                        'border-gray-300': !v$.state_id.$error
                                    }"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="CustomerInfo.state_id"
                                    required
                                >
                                    <option value="null">Select State</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.state_id.$error"
                            >
                                {{ v$.state_id.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative"
                    >
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Zip
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.zip.$error,
                                    'border-gray-300': !v$.zip.$error
                                }"
                                type="text"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.zip"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.zip.$error"
                            >
                                {{ v$.zip.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <!-- address ends -->
                </div>

                <!-- third ends -->

                <!-- 4th start -->

                <div class="required w-full mr-5 mt-5 relative">
                    <div class="required w-full mr-5 mt-5 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Mobile
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.phone_number.$error,
                                    'border-gray-300': !v$.phone_number.$error
                                }"
                                type="tel"
                                id="tel"
                                name="tel"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.phone_number"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.phone_number.$error"
                            >
                                {{ v$.phone_number.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 4th ends -->

                <!-- 5th starts -->

                <div class="flex flex-col lg:flex-row">
                    <div class="required w-full mr-5 mt-4 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Home / Work:
                            </label>
                            <input
                                type="text"
                                id="firstName"
                                name="firstName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.home_work"
                            />
                        </div>
                    </div>

                    <div class="required w-full mt-4 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Ext:
                            </label>
                            <input
                                type="text"
                                id="lastName"
                                name="lastName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.ext"
                            />
                        </div>
                    </div>
                </div>

                <!-- 5th ends -->

                <!-- 6th starts -->

                <div class="required w-full mr-5 mt-5 relative">
                    <div>
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Email Address
                        </label>
                        <input
                            :class="{
                                'border-red-600': v$.email.$error,
                                'border-gray-300': !v$.email.$error
                            }"
                            type="email"
                            id="email"
                            name="email"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="CustomerInfo.email"
                        />
                    </div>

                    <div class="mt-1">
                        <p class="text-red-600 text-xs" v-if="v$.email.$error">
                            {{ v$.email.$errors[0].$message }}
                        </p>
                    </div>
                </div>

                <!-- 6th ends -->

                <!-- 7th starts -->
                <div class="required w-full mr-5 mt-5 relative">
                    <div>
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            DOB:
                        </label>
                        <input
                            :class="{
                                'border-red-600': v$.dob.$error,
                                'border-gray-300': !v$.dob.$error
                            }"
                            type="date"
                            id="tel"
                            name="tel"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="CustomerInfo.dob"
                        />
                    </div>

                    <div class="mt-1">
                        <p class="text-red-600 text-xs" v-if="v$.dob.$error">
                            {{ v$.dob.$errors[0].$message }}
                        </p>
                    </div>
                </div>

                <!-- 7th ends -->

                <!-- 8th starts -->

                <div class="required w-full mr-5 mt-5 relative">
                    <div>
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Gender
                        </label>
                        <select
                            :class="{
                                'border-red-600': v$.gender.$error,
                                'border-gray-300': !v$.gender.$error
                            }"
                            id="email"
                            name="email"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="CustomerInfo.gender"
                        >
                            <option value="">Select One</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mt-1">
                        <p class="text-red-600 text-xs" v-if="v$.gender.$error">
                            {{ v$.gender.$errors[0].$message }}
                        </p>
                    </div>
                </div>

                <!-- 8th ends -->

                <!-- 9th starts -->

                <div class="required w-full mr-5 mt-5 relative">
                    <div class="flex flex-row space-x-2">
                        <div class="w-11/12">
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Lead
                            </label>
                            <select
                                :class="{
                                    'border-red-600': v$.lead.$error,
                                    'border-gray-300': !v$.lead.$error
                                }"
                                id="email"
                                name="email"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.lead"
                            >
                                <option value="">Choose Lead</option>
                                <option
                                    v-for="lead in leads"
                                    :key="lead.index"
                                    :value="lead.id"
                                    >{{ lead.name }}</option
                                >
                            </select>
                        </div>

                        <div
                            class="flex flex-col justify-end cursor-pointer w-1/12"
                        >
                            <PlusIcon @click="popModal()"
                                class="h-7 w-7 mb-2 text-purple-darken font-bold"
                            />
                        </div>
                    </div>

                    <div class="mt-1">
                        <p class="text-red-600 text-xs" v-if="v$.lead.$error">
                            {{ v$.lead.$errors[0].$message }}
                        </p>
                    </div>
                </div>

                <!-- 9th ends -->

                <!-- 10th starts -->

                <div class="required w-full mr-5 mt-8 relative">
                    <div>
                        <textarea
                            class="shadow-sm block sm:text-sm border-gray-300 rounded-md w-full"
                            placeholder="Customer Notes"
                            name="private"
                            id=""
                            rows="3"
                            v-model="CustomerInfo.customer_notes"
                            @input="saveNote"
                        ></textarea>
                    </div>
                </div>

                <!-- 10th ends -->
            </div>

            <!-- <div class="flex mt-4 flex-col lg:flex-row">
                    <div class="required w-full mr-5 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Country
                            </label>
                            <select
                                :class="{
                                    'border-red-600': v$.country_id.$error,
                                    'border-gray-300': !v$.country_id.$error
                                }"
                                id="country"
                                name="country"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.country_id"
                            >
                                <option value="">Choose a Country</option>
                                <option
                                    v-for="(country, index) in countries"
                                    :key="index"
                                    :value="country.id"
                                >
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.country_id.$error"
                            >
                                {{ v$.country_id.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative"
                    >
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Apartment/Suite
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.apartment.$error,
                                    'border-gray-300': !v$.apartment.$error
                                }"
                                type="text"
                                id="apartment"
                                name="apartment"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="CustomerInfo.apartment"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.apartment.$error"
                            >
                                {{ v$.apartment.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                </div> -->
        </div>

        <div class="flex justify-end">
            <button
                v-if="!v$.$error"
                :disabled="loading"
                type="submit"
                :class="{
                    disabled: loading,
                    'opacity-25 cursor-not-allowed': loading
                }"
                class="disabled:bg-gray-400 mb-6 mr-6 w-fit flex justify-center py-3 px-12 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="submit()"
            >
                <LoadingSpinner v-if="loading" />
                Update User Info
            </button>

            <button
                v-else
                type="button"
                class="bg-indigo-600 text-white rounded-md px-8 py-3 w-fit mb-6 mr-6"
            >
                Update User Info
            </button>
        </div>
    </div>
</template>

<script>
import { ref, reactive, watch, computed } from 'vue'
import axios from 'axios'
import LoadingSpinner from '../../../Components/LoadingSpinner.vue'
import AddLead from './AddLead.vue'
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import { PlusIcon } from '@heroicons/vue/solid'
import { Inertia } from '@inertiajs/inertia'
import { notify } from 'notiwind'
import moment from 'moment'
import {
    required,
    maxLength,
    numeric,
    helpers,
    email
} from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}
export default {
    created: function () {
        this.moment = moment
    },
    props: {
        customer: Object,
        countries: Array,
        errors: Object,
        states: Array,
        user: Object,
        notification: Object,
        customer_notification: Object,
        leads: Array,
        states: Array,
        tags: Array
    },

    components: {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        LoadingSpinner,
        PlusIcon,
        AddLead
    },

    setup (props) {
        const customer = props.customer
        const loading = ref(false)
        const successMessage = ref('')
        const states = props.states
        const selectedCountry = ref(customer.country_id)
        const selectedState = ref(customer.state_id)
        const selectedDob = ref(moment(customer.dob).format('MM-DD-YYYY'))
        const CustomerInfo = reactive({
            customerDifficulty: '',
            first_name: customer.first_name,
            last_name: customer.last_name,
            address: customer.address,
            addressTwo: '',
            city: customer.city,
            state_id: selectedState.value ? customer.state_id : '',
            zip: customer.zip,
            phone_number: customer.phone_number,
            home_work: '',
            ext: '',
            email: customer.email,
            dob: selectedDob.value ? customer.dob : '',
            gender: '' ? customer.gender : '',
            lead: '' ? customer.lead : '',
            customer_notes: ''
        })
        const popUp = ref(false)
        const popModal = () => {
            popUp.value = true
        }

        const rules = computed(() => {
            return {
                first_name: {
                    required: helpers.withMessage(
                        'Enter a first name',
                        required
                    )
                },
                last_name: {
                    required: helpers.withMessage('Enter a last name', required)
                },
                address: {
                    required: helpers.withMessage('Enter an address', required)
                },
                city: {
                    required: helpers.withMessage('Enter a city', required)
                },
                state_id: {
                    required: helpers.withMessage('Select a state', required)
                },
                zip: {
                    required: helpers.withMessage(
                        'Enter a postal code',
                        required
                    )
                },
                phone_number: {
                    required: helpers.withMessage(
                        'Enter a phone number',
                        required
                    )
                },

                email: {
                    required: helpers.withMessage(
                        'Please enter an email address',
                        required
                    ),
                    email
                },
                dob: {
                    required: helpers.withMessage(
                        'Please enter a DOB',
                        required
                    )
                },
                gender: {
                    required: helpers.withMessage('Select a gender', required)
                },
                lead: {
                    required: helpers.withMessage('Select a lead', required)
                }
            }
        })

        function onClickTop () {
            notify(
                {
                    group: 'top',
                    title: 'Success',
                    text: successMessage.value
                },
                4000
            )
        }
        function onClickBot () {
            notify(
                {
                    group: 'bottom',
                    title: 'Error',
                    text: successMessage.value
                },
                4000
            )
        }

        function addTag () {
            axios
                .post(`/admin/customer/tag/`, {
                    tag: CustomerInfo.customerDifficulty
                })
                .then(res => {
                    successMessage.value = res.data.message
                    setTimeout(onClickTop, 2000)
                })
                .catch(err => {
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                })
        }

        function pushValue(){
            popUp.value = false
        }

        const v$ = useVuelidate(rules, CustomerInfo)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            axios
                .put(`/admin/customers/${customer.id}`, CustomerInfo)
                .then(res => {
                    successMessage.value = res.data.message
                    setTimeout(onClickTop, 2000)
                })
                .then(Inertia.visit('/admin/customers', { method: 'get' }))
                .catch(error => {
                    loading.value = false
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                })
        }

        return {
            popUp,
            popModal,
            statusStyles,
            CustomerInfo,
            submit,
            loading,
            submit,
            v$,
            states,
            onClickTop,
            onClickBot,
            customer,
            selectedCountry,
            selectedState,
            selectedDob,
            pushValue
        }
    }
}
</script>

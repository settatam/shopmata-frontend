<template>
    <!-- Main content -->
    <div class="bg-white my-7 mx-auto rounded-md" :key="custkey">
        <!-- header -->
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">Customer Information</h1>
        </div>

        <AddLead @close-modal="pushValue" :leads="leads" :customer="customer.id" @close="popUp = false" v-if="popUp" />

        <div class="px-6 pt-6 flex flex-row space-x-4">
            <div @change="addTag()" class="space-x-2" v-for="tag in tags" :key="tag.index">
                <input type="radio" :id="tag.id" :value="tag.id" v-model="CustomerInfo.customerDifficulty" />
                <label :for="tag.id">{{ tag.name }}</label>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-4">
                <div>
                    <inertia-link class="text-purple-darken 2xl font-bold" :href="'/admin/customers/' + customer.id">{{
                            customer.first_name
                    }} {{ customer.last_name }} (ID:
                        {{ customer.id }})</inertia-link>
                </div>
                <!-- first row start -->

                <div class="flex flex-col lg:flex-row">
                    <div class="required w-full mr-5 mt-4 relative">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                First Name
                            </label>
                            <input :class="{
                                'border-red-600': v$.first_name.$error,
                                'border-gray-300': !v$.first_name.$error,
                            }" type="text" id="firstName" name="firstName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.first_name" @change="submit" />
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.first_name.$error">
                                {{ v$.first_name.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div class="required w-full mt-4 relative">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Last Name
                            </label>
                            <input  @change="submit" :class="{
                                'border-red-600': v$.last_name.$error,
                                'border-gray-300': !v$.last_name.$error,
                            }" type="text" id="lastName" name="lastName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.last_name" />
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.last_name.$error">
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
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Address 1:
                            </label>
                            <input  @change="submit" :class="{
                                'border-red-600': v$.address.$error,
                                'border-gray-300': !v$.address.$error,
                            }" type="text" id="firstName" name="firstName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.address" />
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.address.$error">
                                {{ v$.address.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div class="required w-full mt-4 relative">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Address 2:
                            </label>
                            <input  @change="submit" type="text" id="lastName" name="lastName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.address2" />
                        </div>
                    </div>
                </div>

                <!-- second end -->

                <!-- third start -->

                <div class="flex flex-col lg:flex-row mt-4">
                    <div class="required w-full">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                City
                            </label>
                            <input  @change="submit" :class="{
                                'border-red-600': v$.city.$error,
                                'border-gray-300': !v$.city.$error,
                            }" type="text"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.city" />
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.city.$error">
                                {{ v$.city.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                State
                            </label>
                            <!-- state v-if start -->

                            <div v-if="states.length">
                                <select  @change="submit" id="state" name="state"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" required v-model="CustomerInfo.state_id" :class="{
                                        'border-red-600': v$.state_id.$error,
                                        'border-gray-300': !v$.state_id.$error,
                                    }">
                                    <option value="0">Choose a State</option>
                                    <option v-for="(state, index) in states" :key="index" :value="state.id">
                                        {{ state.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- state v-if end -->
                            <!-- v-else -->
                            <div v-else>
                                <select :class="{
                                    'border-red-600': v$.state_id.$error,
                                    'border-gray-300': !v$.state_id.$error,
                                }" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="CustomerInfo.state_id" required>
                                    <option value="null">Select State</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.state_id.$error">
                                {{ v$.state_id.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Zip
                            </label>
                            <input  @change="submit" :class="{
                                'border-red-600': v$.zip.$error,
                                'border-gray-300': !v$.zip.$error,
                            }" type="text"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.zip" />
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.zip.$error">
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
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Mobile
                            </label>
                            <input  @change="submit" :class="{
                                'border-red-600': v$.phone_number.$error,
                                'border-gray-300': !v$.phone_number.$error,
                            }" type="tel" id="tel" name="tel"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.phone_number" />
                        </div>

                        <div class="mt-1">
                            <p class="text-red-600 text-xs" v-if="v$.phone_number.$error">
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
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Home / Work:
                            </label>
                            <input  @change="submit" type="text" id="firstName" name="firstName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.home_work" />
                        </div>
                    </div>

                    <div class="required w-full mt-4 relative">
                        <div>
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Ext:
                            </label>
                            <input  @change="submit" type="text" id="lastName" name="lastName"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" required v-model="CustomerInfo.ext" />
                        </div>
                    </div>
                </div>

                <!-- 5th ends -->

                <!-- 6th starts -->

                <div class="required w-full mr-5 mt-5 relative">
                    <div>
                        <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                            Email Address
                        </label>
                        <input  @change="submit" :class="{
                            'border-red-600': v$.email.$error,
                            'border-gray-300': !v$.email.$error,
                        }" type="email" id="email" name="email"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="" required v-model="CustomerInfo.email" />
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
                        <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                            DOB:
                        </label>
                        <input  @change="submit" :class="{
                            'border-red-600': v$.dob.$error,
                            'border-gray-300': !v$.dob.$error,
                        }" type="date" id="tel" name="tel"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="" required v-model="CustomerInfo.dob" />
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
                        <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                            Gender
                        </label>
                        <select  @change="submit" :class="{
                            'border-red-600': v$.gender.$error,
                            'border-gray-300': !v$.gender.$error,
                        }" id="email" name="email"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="" required v-model="CustomerInfo.gender">
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
                            <label class="block text-gray-600 font-semibold mb-1 bg-transparent">
                                Lead
                            </label>
                            <select  @change="submit" id="email" name="email"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="" v-model="CustomerInfo.lead_id">
                                <option value="">Choose Lead</option>
                                <option v-for="lead in customerLeads" :key="lead.id" :value="lead.id">
                                    {{ lead.name }}
                                </option>
                            </select>
                        </div>

                        <div class="flex flex-col justify-end cursor-pointer w-1/12">
                            <PlusIcon @click="popModal()" class="h-7 w-7 mb-2 text-purple-darken font-bold" />
                        </div>
                    </div>
                </div>

                <!-- 9th ends -->

                <!-- 10th starts -->

                <div class="required w-full mr-5 mt-8 relative">
                    <div>
                        <textarea  @change="submit" class="shadow-sm block sm:text-sm border-gray-300 rounded-md w-full"
                            placeholder="Customer Notes" name="private" id="" rows="3"
                            v-model="CustomerInfo.customer_notes" @input="saveNote"></textarea>
                    </div>
                </div>

                <!-- 10th ends -->
            </div>
        </div>

        <div class="flex justify-end">
            <button v-if="!v$.$error" :disabled="loading" type="submit" :class="{
                disabled: loading,
                'opacity-25 cursor-not-allowed': loading,
            }" class="disabled:bg-gray-400 mb-6 mr-6 w-fit flex justify-center py-3 px-12 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="submit()">
                <LoadingSpinner v-if="loading" />
                Update User Info
            </button>

            <button v-else type="button" class="bg-indigo-600 text-white rounded-md px-8 py-3 w-fit mb-6 mr-6">
                Update User Info
            </button>
        </div>

        <NotificationGroup group="top" position="top">
            <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                <div class="w-full max-w-sm">
                    <Notification v-slot="{ notifications, close }" enter="transform ease-out duration-300 transition"
                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        enter-to="translate-y-0 opacity-100 sm:translate-x-0" leave="transition ease-in duration-500"
                        leave-from="opacity-100" leave-to="opacity-0" move="transition duration-500"
                        move-delay="delay-300">
                        <div class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                            v-for="notification in notifications" :key="notification.id">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                        <p class="font-semibold text-gray-800">
                                            {{ notification.title }}
                                        </p>
                                        <p class="text-sm font-semibold text-gray-500">
                                            {{ notification.text }}
                                        </p>
                                    </div>
                                    <div class="flex flex-shrink-0 ml-4">
                                        <button @click="close(notification.id)"
                                            class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                            <span class="sr-only">Close</span>
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Notification>
                </div>
            </div>
        </NotificationGroup>

        <NotificationGroup group="bottom" position="top">
            <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                <div class="w-full max-w-sm">
                    <Notification v-slot="{ notifications }" enter="transform ease-out duration-300 transition"
                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        enter-to="translate-y-0 opacity-100 sm:translate-x-0" leave="transition ease-in duration-500"
                        leave-from="opacity-100" leave-to="opacity-0" move="transition duration-500"
                        move-delay="delay-300">
                        <div class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
                            v-for="notification in notifications" :key="notification.id">
                            <div class="flex items-center justify-center w-12 bg-red-500">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                            </div>

                            <div class="px-4 py-2 -mx-3">
                                <div class="mx-3">
                                    <span class="font-semibold text-red-500">{{ notification.title }}</span>
                                    <p class="text-sm text-gray-600">
                                        {{ notification.text }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </Notification>
                </div>
            </div>
        </NotificationGroup>
    </div>
</template>

<script>
import { ref, reactive, watch, computed } from "vue";
import axios from "axios";
import LoadingSpinner from "../../../Components/LoadingSpinner.vue";
import AddLead from "./AddLead.vue";
import urls from "../../../api/urls"
import notification from "../../../Utils/notification";
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { PlusIcon } from "@heroicons/vue/solid";
import { Inertia } from "@inertiajs/inertia";
import { notify } from "notiwind";
import moment from "moment";
import {
    required,
    maxLength,
    numeric,
    helpers,
    email,
} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    created: function () {
        this.moment = moment;
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
        tags: Array,
    },

    components: {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        LoadingSpinner,
        PlusIcon,
        AddLead,
    },

    setup(props) {
        const customer = props.customer;
        const address = customer.customer_address;
        const custkey = ref(1);
        const loading = ref(false);
        const states = props.states;
        const selectedCountry = ref(customer.country_id);
        const selectedState = ref(customer.state_id);
        const selectedDob = ref(moment(customer.dob).format("MM-DD-YYYY"));
        const selectedTags = ref(customer.tags);
        const CustomerInfo = reactive({
            customerDifficulty:
                selectedTags.value.length > 0
                    ? customer.tags[customer.tags.length - 1].tag_id
                    : "",
            first_name: customer.first_name,
            last_name: customer.last_name,
            address: null != address ? address.address : null,
            address2: null != address ? address.address2 : null,
            city: null != address ? address.city : null,
            state_id: null != address ? address.state_id : 0,
            zip: null != address ? address.zip : null,
            phone_number: customer.phone_number,
            home_work: customer.home_phone_number,
            ext: customer.ext,
            email: customer.email,
            dob: selectedDob.value ? customer.dob : "",
            gender: null != customer.gender ? customer.gender : "",
            lead_id: null != customer.lead_id ? customer.lead_id : "",
            customer_notes: customer.customer_notes,
        });
        const popUp = ref(false);
        const { notifyAlert } = notification();
        const popModal = () => {
            popUp.value = true;
        };
        let leads = props.leads;
        const customerLeads = ref(leads);

        const rules = computed(() => {
            return {
                first_name: {
                    required: helpers.withMessage(
                        "Enter a first name",
                        required
                    ),
                },
                last_name: {
                    required: helpers.withMessage(
                        "Enter a last name",
                        required
                    ),
                },
                address: {
                    required: helpers.withMessage("Enter an address", required),
                },
                city: {
                    required: helpers.withMessage("Enter a city", required),
                },
                state_id: {
                    required: helpers.withMessage("Select a state", required),
                },
                zip: {
                    required: helpers.withMessage(
                        "Enter a postal code",
                        required
                    ),
                },
                phone_number: {
                    required: helpers.withMessage(
                        "Enter a phone number",
                        required
                    ),
                },

                email: {
                    required: helpers.withMessage(
                        "Please enter an email address",
                        required
                    ),
                    email,
                },
                dob: {
                    required: helpers.withMessage(
                        "Please enter a DOB",
                        required
                    ),
                },
                gender: {
                    required: helpers.withMessage("Select a gender", required),
                },
            };
        });


        function addTag() {
            axios
                .post(`/admin/customer/${customer.id}/tags`, {
                    tag_id: CustomerInfo.customerDifficulty,
                })
                .then((res) => {
                    setTimeout(
                        notifyAlert(
                            "Details updated successfully",
                            "top",
                            "Success"
                        ),
                        2000
                    );
                })
                .catch((err) => {
                    setTimeout(
                        notifyAlert(
                            "Error processing your request",
                            "bottom",
                            "Error"
                        ),
                        2000
                    );
                });
        }

        function pushValue(res) {
            customerLeads.value = res.data;
            popUp.value = false;
        }

        const v$ = useVuelidate(rules, CustomerInfo);

        function submit() {
            // this.v$.$validate();
            // if (this.v$.$error) {
            //     return;
            // }
            loading.value = true;
            axios
                .put(`/admin/customers/${customer.id}`, CustomerInfo)
                .then((res) => {
                    loading.value = false;
                    setTimeout(
                        notifyAlert(
                            "Details updated successfully",
                            "top",
                            "Success"
                        ),
                        2000
                    );

                    // setTimeout(onClickTop, 2000);
                })
                .catch((error) => {
                    loading.value = false;
                    setTimeout(
                        notifyAlert(
                            "Error processing your request",
                            "bottom",
                            "Error"
                        ),
                        2000
                    );
                });
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
            customer,
            selectedCountry,
            selectedState,
            selectedDob,
            pushValue,
            addTag,
            customerLeads,
            custkey,
            selectedTags,
        };
    },
};
</script>

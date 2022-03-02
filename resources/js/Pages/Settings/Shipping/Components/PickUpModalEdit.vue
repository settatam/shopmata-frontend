<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed z-10 inset-0 overflow-y-auto "
            @close="closeModal"
        >
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6"
                    >
                        <div>
                            <div class="flex justify-between ">
                                <div>
                                    <p class="text-2xl font-bold">
                                        Pickup Address
                                    </p>
                                    <p class="text-gray-400 text-sm mt-4">
                                        Your pickup address will be used for all
                                        pickup orders
                                    </p>
                                </div>
                                <x-icon
                                    class="h-6 w-6 cursor-pointer"
                                    @click="closeModal"
                                />
                            </div>
                            <div class="mt-3 sm:mt-5">
                                <div class=" required w-full mb-4">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Location Name
                                    </label>
                                    <input
                                        :class="{
                                            'border-red-600': v$.name.$error,
                                            'border-gray-300': !v$.name.$error
                                        }"
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="local_pickup.name"
                                        required
                                    />
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.name.$error"
                                    >
                                        {{ v$.name.$errors[0].$message }}
                                    </p>
                                </div>

                                <div class="flex required  mb-4">
                                    <div class="mr-2 w-full">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                            for="country_id"
                                        >
                                            Country
                                        </label>
                                        <select
                                            :class="{
                                                'border-red-600':
                                                    v$.country_id.$error,
                                                'border-gray-300': !v$
                                                    .country_id.$error
                                            }"
                                            id="country_id"
                                            name="country_id"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            placeholder=""
                                            v-model="local_pickup.country_id"
                                        >
                                            <option value=""
                                                >Choose Country</option
                                            >
                                            <option
                                                :value="country.id"
                                                v-for="country in countries"
                                                :key="country.id"
                                                >{{ country.name }}
                                                {{ country.iso_code_2 }}</option
                                            >
                                        </select>

                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.country_id.$error"
                                        >
                                            {{
                                                v$.country_id.$errors[0]
                                                    .$message
                                            }}
                                        </p>
                                    </div>

                                    <div class="ml-2 w-full">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                        >
                                            State
                                        </label>
                                        <select
                                            :class="{
                                                'border-red-600':
                                                    v$.state_id.$error,
                                                'border-gray-300': !v$.state_id
                                                    .$error
                                            }"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            v-model="local_pickup.state_id"
                                            required
                                        >
                                            <option value=""
                                                >Choose a State</option
                                            >
                                            <option
                                                v-for="(state,
                                                index) in country_state"
                                                :key="index"
                                                :value="state.id"
                                                >{{ state.name }}</option
                                            >
                                        </select>
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.state_id.$error"
                                        >
                                            {{ v$.state_id.$errors[0].$message }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex required  mb-4">
                                    <div class="mr-2 w-full">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                        >
                                            City
                                        </label>
                                        <input
                                            :class="{
                                                'border-red-600':
                                                    v$.city.$error,
                                                'border-gray-300': !v$.city
                                                    .$error
                                            }"
                                            type="text"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            v-model="local_pickup.city"
                                            required
                                        />

                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.city.$error"
                                        >
                                            {{ v$.city.$errors[0].$message }}
                                        </p>
                                    </div>

                                    <div class="ml-2 w-full">
                                        <label
                                            class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                        >
                                            Postal Code
                                        </label>
                                        <input
                                            :class="{
                                                'border-red-600':
                                                    v$.postal_code.$error,
                                                'border-gray-300': !v$
                                                    .postal_code.$error
                                            }"
                                            type="text"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            v-model="local_pickup.postal_code"
                                            required
                                        />
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.postal_code.$error"
                                        >
                                            {{
                                                v$.postal_code.$errors[0]
                                                    .$message
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <div class=" required w-full mb-4">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Address
                                    </label>
                                    <input
                                        :class="{
                                            'border-red-600': v$.address.$error,
                                            'border-gray-300': !v$.address
                                                .$error
                                        }"
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="local_pickup.address"
                                        required
                                    />
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.address.$error"
                                    >
                                        {{ v$.address.$errors[0].$message }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class=" flex justify-end">
                            <button
                                type="button"
                                class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                @click="closeModal"
                            >
                                Cancel
                            </button>
                            <button
                                type="button"
                                class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                @click="submit"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, reactive, computed } from 'vue'
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/solid'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
import useVuelidate from '@vuelidate/core'
import { required, helpers, numeric, minValue } from '@vuelidate/validators'

export default {
    emits: ['close'],
    props: ['location'],

    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        XIcon,
        TransitionRoot
    },
    data () {
        return {
            countries: '',
            country_state: {}
        }
    },
    methods: {
        closeModal () {
            this.open = false
            this.$emit('close')
        }
    },
    mounted () {
        axios.get('/api/countries').then(res => {
            this.countries = res.data.data
        })
    },
    watch: {
        'local_pickup.country_id' (newVal, oldVal) {
            axios.get(`/api/states?country_id=${newVal}`).then(res => {
                this.country_state = res.data.data
            })
        }
    },
    setup (props) {
        const open = ref(true)
        const location = props.location

        const local_pickup = reactive({
            name: location.name,
            address: location.address,
            country_id: location.country_id,
            state_id: location.state_id,
            postal_code: location.postal_code,
            city: location.city
        })

        const rules = computed(() => {
            return {
                name: {
                    required: helpers.withMessage('Enter a location', required)
                },
                country_id: {
                    required: helpers.withMessage('Select a country', required)
                },
                state_id: {
                    required: helpers.withMessage('Select a state', required)
                },
                address: {
                    required: helpers.withMessage('Enter an address', required)
                },
                city: {
                    required: helpers.withMessage('Enter a city name', required)
                },
                postal_code: {
                    required: helpers.withMessage(
                        'Enter a zip/postal code',
                        required
                    ),
                    numeric
                }
            }
        })

        const v$ = useVuelidate(rules, local_pickup)

        function submit () {
            this.v$.$validate()
            if (local_pickup.address.length < 1) {
                return
            } else {
                axios
                    .post('/settings/store-locations', local_pickup)
                    .then(res => {
                        //console.log(res.data)
                        this.open = false
                        Inertia.visit('/settings/shipping-and-delivery')
                    })
            }
        }

        return {
            open,
            local_pickup,
            submit,
            v$
        }
    }
}
</script>

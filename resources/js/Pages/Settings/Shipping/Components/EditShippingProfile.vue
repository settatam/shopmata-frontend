<template>
    <app-layout>
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
            <!-- Breadcrumb -->
            <div class="flex-shrink-0 mb-3 px-6 flex items-center">
                <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a
                                href="/dashboard"
                                class="text-gray-400 hover:text-gray-500"
                            >
                                <HomeIcon
                                    class="flex-shrink-0 h-5 w-5"
                                    aria-hidden="true"
                                />
                                <span class="sr-only">Settings</span>
                            </a>
                        </div>
                    </li>
                    <li v-for="page in pages" :key="page.name">
                        <div class="flex items-center">
                            <ChevronRightIcon
                                class="flex-shrink-0 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            <a
                                :href="page.href"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                :aria-current="
                                    page.current ? 'page' : undefined
                                "
                                >{{ page.name }}</a
                            >
                        </div>
                    </li>
                </ol>
            </nav>
            <div
                class="flex-1 flex flex-col xl:overflow-hidden lg:flex-row mt-5 px-4 lg:px-0"
            >
                <!-- Secondary sidebar -->
                <Nav page="Shipping"></Nav>
                <!-- Main content -->
                <div
                    class="flex-1 max-h-screen xl:overflow-y-auto overflow-x-scroll"
                >
                    <div class="w-auto  lg:ml-7 lg:mr-2">
                        <div class="mb-6">
                            <div class="px-4 md:px-8 pb-8 pt-6  mb-6 bg-white">
                                <h1 class="text-2xl font-semibold">
                                    Edit Shipping Rate
                                </h1>
                                <p class=" text-gray-500">
                                    Select a state and the cities within that
                                    state you can deliver to. Set a delivery
                                    rate and how long it will take to deliver
                                    items.
                                    <a
                                        class="text-indigo-700 underline cursor-pointer"
                                        @click="this.videoPop = true"
                                        >Watch a demo</a
                                    >
                                </p>
                                <demo-video-modal
                                    @close="this.videoPop = false"
                                    v-if="this.videoPop"
                                />

                                <div class="w-auto relative">
                                    <label
                                        class="block mt-4 mb-2 bg-transparent text-lg"
                                    >
                                        Rate Name
                                    </label>
                                    <input
                                        :class="{
                                            'border-red-600': v$.name.$error,
                                            'border-gray-300': !v$.name.$error
                                        }"
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="rates.name"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-8 right-0"
                                        v-show="bodyError && !rates.name.length"
                                    />
                                </div>

                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.name.$error"
                                    >
                                        {{ v$.name.$errors[0].$message }}
                                    </p>
                                </div>

                                <div class="w-auto relative">
                                    <label
                                        class="block mt-4 mb-2 bg-transparent text-lg"
                                    >
                                        Price
                                    </label>
                                    <input
                                        :class="{
                                            'border-red-600': v$.price.$error,
                                            'border-gray-300': !v$.price.$error
                                        }"
                                        type="number"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="rates.price"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-8 right-0"
                                        v-show="
                                            bodyError && !rates.price.length
                                        "
                                    />
                                </div>

                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.price.$error"
                                    >
                                        {{ v$.price.$errors[0].$message }}
                                    </p>
                                </div>

                                <div class="w-full mt-4 ">
                                    <p
                                        class="block text-gray-600 font-semibold text-lg mb-2 bg-transparent"
                                    >
                                        Rate for
                                    </p>

                                    <div class=" items-center">
                                        <input
                                            type="radio"
                                            value="0"
                                            class="mr-2"
                                            v-model="rates.is_domestic"
                                            name="domestic"
                                        />
                                        <label
                                            for="domestic"
                                            @click="rates.is_domestic = '0'"
                                            class="cursor-pointer"
                                        >
                                            Domestic</label
                                        >
                                    </div>

                                    <div class=" items-center mt-2">
                                        <input
                                            type="radio"
                                            class="mr-2"
                                            value="1"
                                            v-model="rates.is_domestic"
                                            name="international"
                                        />
                                        <label
                                            for="international"
                                            @click="rates.is_domestic = '1'"
                                            class="cursor-pointer"
                                        >
                                            International</label
                                        >
                                    </div>

                                    <div class="mt-1">
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.is_domestic.$error"
                                        >
                                            {{
                                                v$.is_domestic.$errors[0]
                                                    .$message
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <p class="font-semibold mt-6 text-lg">
                                    Orders must match
                                </p>
                                <div class="flex mt-4">
                                    <div class=" items-center">
                                        <input
                                            type="radio"
                                            value="0"
                                            class="mr-2"
                                            v-model="rates.match_all_condition"
                                            name="all_condition"
                                        />
                                        <label
                                            for="all_condition"
                                            @click="
                                                rates.match_all_condition = '0'
                                            "
                                            class="cursor-pointer"
                                        >
                                            All Conditions</label
                                        >
                                    </div>

                                    <div class=" items-center ml-10">
                                        <input
                                            type="radio"
                                            class="mr-2"
                                            value="1"
                                            v-model="rates.match_all_condition"
                                            name="any_condition"
                                        />
                                        <label
                                            for="any_condition"
                                            @click="
                                                rates.match_all_condition = '1'
                                            "
                                            class="cursor-pointer"
                                        >
                                            Any Condition</label
                                        >
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p
                                        class="text-red-600 text-xs"
                                        v-if="v$.match_all_condition.$error"
                                    >
                                        {{
                                            v$.match_all_condition.$errors[0]
                                                .$message
                                        }}
                                    </p>
                                </div>

                                <template
                                    v-for="(datum,
                                    index) in rateStore.conditions"
                                    :key="index"
                                >
                                    <div
                                        class="flex flex-wrap justify-between lg:flex-row lg:justify-between mt-4"
                                    >
                                        <div class="w-4.5/10 lg:w-3/10">
                                            <select
                                                name="options"
                                                id=""
                                                class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none mb-2 lg:mb-0"
                                                v-model="datum.tag"
                                            >
                                                <option
                                                    v-for="(option,
                                                    index) in rate"
                                                    :key="index"
                                                    :value="option.title"
                                                >
                                                    {{ option.title }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="w-4.5/10 lg:w-3/10">
                                            <select
                                                name="conditions"
                                                id=""
                                                class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none"
                                                v-model="datum.condition"
                                            >
                                                <option
                                                    v-for="(condition,
                                                    index) in conditions"
                                                    :key="index"
                                                    :value="condition.title"
                                                >
                                                    {{ condition.title }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="w-8.5/10 lg:w-3/10 mb-2">
                                            <select
                                                name="state"
                                                id=""
                                                class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 w-full hover:bg-gray-50 focus:outline-none"
                                                v-if="datum.tag == 'State'"
                                                v-model="datum.value"
                                            >
                                                <option
                                                    v-for="(state,
                                                    index) in states"
                                                    :key="index"
                                                    :value="state.id"
                                                >
                                                    {{ state.name }}
                                                </option>
                                            </select>
                                            <input
                                                type="number"
                                                class="w-full text-xs py-2 sm:text-sm rounded-md border-gray-300"
                                                v-else
                                                v-model="datum.value"
                                            />
                                        </div>
                                        <TrashIcon
                                            v-if="
                                                conditions.length > 1 &&
                                                    index != 0
                                            "
                                            class="w-5 h-5 text-red-500 my-auto cursor-pointer"
                                            @click="removeCondition(index)"
                                        />
                                        <TrashIcon
                                            v-else
                                            class="w-5 h-5 invisible"
                                        />
                                    </div>

                                    <div
                                        class="mt-1"
                                        v-for="error in v$.conditions.$each
                                            .$response.$errors[index].value"
                                        :key="error"
                                    >
                                        <p
                                            class="text-red-600 text-xs"
                                            v-if="v$.conditions.$error"
                                        >
                                            {{ error.$message }}
                                        </p>
                                    </div>
                                </template>
                                <button
                                    class="text-indigo-700 sm:text-sm text-xs font-semibold mt-4 "
                                    @click="add()"
                                >
                                    Add New Condition
                                </button>

                                <div class="flex mt-4">
                                    <div class="mr-2 w-full mb-3 relative">
                                        <label
                                            class="block font-semibold mb-2 bg-transparent"
                                        >
                                            Description
                                        </label>
                                        <textarea
                                            :class="{
                                                'border-red-600':
                                                    v$.description.$error,
                                                'border-gray-300': !v$
                                                    .description.$error
                                            }"
                                            class="shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder="Write a delivery note ......."
                                            v-model="rates.description"
                                        >
                                        </textarea>
                                        <span
                                            class="text-gray-400 absolute bottom-1 right-3 "
                                            >{{ rates.description.length }}/50
                                        </span>
                                    </div>
                                </div>

                                <div class="flex justify-between">
                                    <inertia-link
                                        href="/settings/shipping-and-delivery"
                                    >
                                        <button
                                            class="text-gray-500 bg-transparent border border-gray-500 rounded-md px-8 py-2 font-normal text-base  my-5"
                                        >
                                            Cancel
                                        </button>
                                    </inertia-link>

                                    <button
                                        v-if="!v$.$error"
                                        :disabled="v$.$error"
                                        :class="{
                                            disabled: loading,
                                            'opacity-25 cursor-not-allowed': loading
                                        }"
                                        class="text-white bg-indigo-700 rounded-md px-4 py-3 my-5 ml-5 w-1/6 flex justify-center"
                                        @click="submit"
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
                                        Save
                                    </button>

                                    <button
                                        v-else
                                        class="text-white bg-indigo-700 rounded-md px-8 py-3 my-5 ml-5 w-1/6"
                                        @click="submit"
                                    >
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../../../Layouts/AppLayout.vue'
import Nav from '../../Nav'
import {
    LocationMarkerIcon,
    ChevronRightIcon,
    HomeIcon,
    DotsHorizontalIcon,
    XIcon,
    TrashIcon
} from '@heroicons/vue/outline'
import { onBeforeMount, reactive, ref, computed } from 'vue'
import Button from '../../../../Jetstream/Button.vue'
import { Inertia } from '@inertiajs/inertia'
import ErrorIcon from '../../../ErrorIcon.vue'
import DemoVideoModal from './DemoVideoModal.vue'
import useVuelidate from '@vuelidate/core'
import { required, maxLength, helpers, integer } from '@vuelidate/validators'

const pages = [
    { name: 'Settings', href: '/settings', current: false },
    {
        name: 'Shipping and Delivery',
        href: '/settings/shipping-and-delivery',
        current: false
    },
    {
        name: 'Shipping Profile',
        href: '/settings/shipping-and-delivery/shipping-profile',
        current: true
    }
]
export default {
    props: ['rate_options', 'condition_options', 'store', 'rate'],
    components: {
        Nav,
        AppLayout,
        LocationMarkerIcon,
        ChevronRightIcon,
        HomeIcon,
        Button,
        DotsHorizontalIcon,
        ErrorIcon,
        XIcon,
        DemoVideoModal,
        TrashIcon
    },
    data () {
        return {
            open: false,
            location_id: '',
            videoPop: false
        }
    },
    methods: {},
    setup (props) {
        const loading = ref(false)
        const store = props.store
        const rateStore = props.rate
        const states = ref([])
        const conditions = props.condition_options
        const rate = props.rate_options
        const data = ref([
            { condition: 'is equal to', tag: 'State', value: '' }
        ])
        const rates = reactive({
            name: rateStore.name,
            description: rateStore.description,
            price: rateStore.price,
            is_domestic: rateStore.is_domestic,
            is_international: rateStore.is_international,
            match_all_condition: rateStore.match_all_condition,
            rate_id: rateStore.id,
            conditions: rateStore.conditions
        })
        const bodyError = ref(false)

        const removeCondition = id => {
            rates.conditions.splice(id, 1)
        }
        const add = () => {
            rateStore.conditions.push({
                condition: 'is equal to',
                tag: 'State',
                value: ''
            })
        }

        onBeforeMount(() => {
            axios
                .get(`/api/states?country_id=${props.store.country_id}`)
                .then(res => {
                    states.value = res.data.data
                })
        })

        const rules = computed(() => {
            return {
                name: {
                    required: helpers.withMessage(
                        'Enter a shipping rate name',
                        required
                    )
                },
                description: {
                    required: helpers.withMessage(
                        'Enter a shipping rate description',
                        required
                    ),
                    maxValue: helpers.withMessage(
                        'This field allows a maximum of 50 characters',
                        maxLength(50)
                    )
                },
                price: {
                    required: helpers.withMessage(
                        'Enter a shipping rate price',
                        required
                    )
                },
                match_all_condition: {
                    required: helpers.withMessage(
                        'Select an order condition',
                        required
                    )
                },
                is_domestic: {
                    required: helpers.withMessage(
                        'Select an order rate',
                        required
                    )
                },
                conditions: {
                    $each: helpers.forEach({
                        value: {
                            required: helpers.withMessage(
                                'Select or Enter a condition value',
                                required
                            )
                        }
                    })
                }
            }
        })

        const v$ = useVuelidate(rules, rates)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            Inertia.patch(`/settings/shipping-rates/${rateStore.id}/`, rates)
        }

        return {
            store,
            pages,
            rate,
            rates,
            data,
            conditions,
            add,
            states,
            submit,
            bodyError,
            removeCondition,
            rateStore,
            v$,
            rules,
            loading
        }
    }
}
</script>

<style></style>

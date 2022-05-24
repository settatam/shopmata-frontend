<template>
    <div
        id="container"
        class="bg-white flex w-full flex-col py-6 mt-6 px-10 space-y-6 rounded"
    >
        <!-- row 1 start -->
        <div class="flex flex-col lg:flex-row justify-around">
            <div class="flex flex-col">
                <label for="daterange">
                    Date Range
                </label>
                <Datepicker
                    id="daterange"
                    name="daterange"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-96 sm:text-sm border-gray-300 rounded-md"
                    v-model="filterValues.date"
                    range
                ></Datepicker>
            </div>

            <div class="flex flex-col">
                <label for="offices">
                    Offices
                </label>
                <select
                    name="offices"
                    v-model="filterValues.offices"
                    id=""
                    class="mt-1 w-full md:w-96 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="ashburn">Ashburn</option>
                </select>
            </div>
        </div>
        <!-- row 1 ends-->

        <!-- row 2 start -->
        <div class="flex flex-col lg:flex-row justify-around">
            <div class="flex flex-col">
                <label for="businesssource">
                    Source of Business
                </label>
                <select
                    name="businesssource"
                    v-model="filterValues.businesssource"
                    id="businesssource"
                    class="mt-1 block w-full md:w-96 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="All Sources of Business"
                        >All Sources of Business</option
                    >
                </select>
            </div>

            <div class="flex flex-col">
                <label for="governors">
                    Governors
                </label>
                <select
                    name="governors"
                    v-model="filterValues.governors"
                    id="governors"
                    class="mt-1 block w-full md:w-96 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="Reconnciled stats only"
                        >Reconnciled stats only</option
                    >
                </select>
            </div>
        </div>
        <!-- row 2 ends-->

        <!-- row 3 starts -->
        <div class="flex flex-col lg:flex-row justify-around">
            <div class="flex flex-col">
                <label for="systems">
                    Systems
                </label>
                <select
                    name="systems"
                    v-model="filterValues.systems"
                    id="systems"
                    class="mt-1 block w-full md:w-96 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="All Systems">All Systems</option>
                </select>
            </div>

            <div class="w-96"></div>
        </div>
        <!-- row 3 ends-->

        <div class="flex flex-row justify-around">
            <div>
                <button
                    class=" rounded-md border border-indigo-600 mr-4 shadow-sm px-4 py-3  text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm bg-indigo-600 hover:bg-indigo-700 justify-centre flex"
                @click="submitFilters()">
                    <AdjustmentsIcon class="h-5 w-5" /> Apply Filters
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { AdjustmentsIcon } from '@heroicons/vue/outline'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    components: {
        AdjustmentsIcon,
        Datepicker
    },
    emits: ['getFilters'],
    setup (props, { emit }) {
        const filterValues = reactive({
            date: '',
            offices: '',
            businesssource: '',
            governors: '',
            systems: ''
        })

        function submitFilters(){
            emit('getFilters', filterValues)
        }

        return {
            filterValues,
            submitFilters
        }
    }
}
</script>

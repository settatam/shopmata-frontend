<template>
    <div
        id="container"
        class="bg-white flex w-full flex-col py-6 mt-6 px-4 space-y-6 rounded "
    >
        <!-- row 1 start -->
        <div class="flex flex-col lg:flex-row  justify-between space-x-0 md:space-x-6">
            <div class="flex flex-col mt-2 p-0 m-0 w-auto justify-center ">
                <label for="daterange ">
                    Date Range
                </label>
                <div class="flex flex-row ">
                    <Datepicker
                        id="daterange"
                        name="daterange"
                        class=" w-full  block py-2 mr-2 text-base border-indigo-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        v-model="filterValues.dateOne"
                    ></Datepicker>

                    <span class="pt-3"> - </span>

                    <Datepicker
                        id="daterange"
                        name="daterange"
                        class="tesoooooot w-full ml-2 block py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        v-model="filterValues.dateTwo"
                    ></Datepicker>
                </div>
            </div>

            <div class="flex flex-col justify-center content-center w-full lg:w-1/3">
                <label for="status">
                    Status
                </label>
                <select
                    name="status"
                    v-model="filterValues.status"
                    id="status"
                    class="h-9 mt-1.5 w-full  block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="null">Select Status</option>
                </select>
            </div>

            <div class="flex flex-col w-full lg:w-1/3 justify-center content-center">
                <label for="store">
                    Store
                </label>
                <select
                    name="store"
                    v-model="filterValues.store"
                    id="store"
                    class=" h-9 mt-1.5  block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="null"
                        >Select Store </option
                    >
                </select>
            </div>
        </div>
        <!-- row 1 ends-->

        <div class="flex flex-row  w-1/2">
            <div class="flex flex-row">
                <button
                    class=" rounded-md border border-indigo-600 mr-4 shadow-sm px-4 py-3  text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm bg-indigo-600 hover:bg-indigo-700 justify-centre flex"
                    @click="submitFilters()"
                >
                    <AdjustmentsIcon class="h-5 w-5" /> Apply Filters
                </button>

                <button
                    class=" rounded-md border border-indigo-600 mr-4 shadow-sm px-4 py-3  text-base font-medium text-black-900 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm bg-white hover:bg-indigo-700 justify-centre flex"
                    @click="submitFilters()"
                >
                    Cancel
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
            dateOne: '',
            dateTwo: '',
            store: '',
            status: ''
        })

        function submitFilters () {
            emit('getFilters', filterValues)
        }

        return {
            filterValues,
            submitFilters
        }
    }
}
</script>


<style scoped>

.tesoooooot{
    border:none;
    color: green !important;
}

</style>
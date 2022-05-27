<template>
    <div
        id="container"
        class="bg-white flex w-full flex-col py-6 mt-6 px-4 space-y-6 rounded "
    >
        <!-- row 1 start -->
        <div
            class="flex flex-col lg:flex-row  justify-between space-x-0 lg:space-x-6 space-y-3 lg:space-y-0"
        >
            <div class="flex flex-col mt-2 w-auto justify-end ">
                <label for="daterange ">
                    Date Range
                </label>
                <div class="flex flex-row">
                    <flatPickr
                        :style="{
                            '--vdp-hover-bg-color':
                                'rgba(79, 70, 229, var(--tw-bg-opacity))',
                            '--vdp-selected-bg-color':
                                'rgba(79, 70, 229, var(--tw-bg-opacity))'
                        }"
                        id="daterange"
                        name="daterange"
                        class="text-start border-r-0 rounded-r-none w-full py-2  text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        v-model="filterValues.dateOne"
                        :lowerLimit="filterValues.dateOne"
                    ></flatPickr>

                    <span
                        class="py-2 border-l-0 border-r-0 rounded-r-none rounded-l-none border text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    >
                        -
                    </span>

                    <flatPickr
                        :style="{
                            '--vdp-hover-bg-color':
                                'rgba(79, 70, 229, var(--tw-bg-opacity))',
                            '--vdp-selected-bg-color':
                                'rgba(79, 70, 229, var(--tw-bg-opacity))'
                        }"
                        id="daterange"
                        name="daterange"
                        class="border-l-0 w-full rounded-l-none py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        v-model="filterValues.dateTwo"
                        :lowerLimit="filterValues.dateOne"
                    ></flatPickr>
                </div>
            </div>

            <div
                class="flex flex-col justify-center content-center w-full lg:w-1/3"
            >
                <label for="status">
                    Status
                </label>
                <select
                    name="status"
                    v-model="filterValues.status"
                    id="status"
                    class=" mt-1.5 w-full  block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="null">Select Status</option>
                </select>
            </div>

            <div
                class="flex flex-col w-full lg:w-1/3 justify-center content-center"
            >
                <label for="store">
                    Store
                </label>
                <select
                    name="store"
                    v-model="filterValues.store"
                    id="store"
                    class="  mt-1.5  block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                >
                    <option value="null">Select Store </option>
                </select>
            </div>
        </div>
        <!-- row 1 ends-->



        <div class="flex flex-row  w-1/2">
            <div class="flex flex-row">
                <button
                    class=" rounded-md border border-indigo-600 mr-4 shadow-sm px-4 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm bg-indigo-600 hover:bg-indigo-700 justify-centre flex"
                    @click="submitFilters()"
                >
                    <AdjustmentsIcon class="h-5 w-5" /> Apply Filters
                </button>

                <div>
                    <p
                        class="py-3 cursor-pointer hover:underline text-normal hover:text-indigo-700" @click="toggleFilter()"
                    >
                        Cancel
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { AdjustmentsIcon } from '@heroicons/vue/outline'
import flatPickr from 'vue-flatpickr-component'; 
import 'flatpickr/dist/flatpickr.css';


export default {
    components: {
        AdjustmentsIcon,
        flatPickr
    },
    emits: ['getFilters'],
    setup (props, { emit }) {
        const filterValues = reactive({
            dateOne: new Date(),
            dateTwo: new Date(),
            store: null,
            status: null
        })
        const showFilter = ref(true)

        function submitFilters () {
            emit('getFilters', filterValues)
        }

        function toggleFilter(){
            showFilter.value = false
            emit('switchToggle', showFilter)
        }

        return {
            filterValues,
            submitFilters,
            showFilter,
            toggleFilter
        }
    }
}
</script>

<style scoped>
.test {
    border-top-style: solid;
    border-left-style: solid;
}
</style>

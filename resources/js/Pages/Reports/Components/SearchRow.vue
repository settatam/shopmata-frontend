<template>
    <div class="grid grid-cols-2 gap-2 my-4 md:px-0 md:grid-cols-7 rounded bg-transparent">
        <!-- <div class="flex flex-row my-4 md:px-0 rounded bg-transparent space-x-6 flex-wrap"> -->
        <!-- <button type="button"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-purple-darken py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-purple-darken focus:ring-offset-2 sm:w-auto"
            @click="filterToggle">
            Filter by:
        </button> -->

        <!-- <div class="">
            <input type="date" name=""
                class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200" id="" />
        </div>

        <div class="">
            <input type="date" name=""
                class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200" id="" />
        </div> -->

        <!-- <div class="flex flex-col">
            <select name="Status" id=""
                class="rounded text-gray-500 text-xm md:text-base w-full bg-white border border-gray-200">
                <option value="">Date Kit Requested</option>
            </select>
        </div>
        <div class="flex flex-col">
            <div class="flex">
                <select name="Tag" id=""
                    class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200">
                    <option value="active">BuyMyGold.com</option>
                </select>
            </div>
        </div>


            <button
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-purple-darken py-2 px-2 text-sm font-medium text-white shadow-sm hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-purple-darken focus:ring-offset-2 sm:w-auto"
                type="submit">
                Apply
            </button>

            <button
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-purple-darken py-2 px-2 text-sm font-medium text-white shadow-sm hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-purple-darken focus:ring-offset-2 sm:w-auto"
                type="submit">
                New Customer
            </button> -->

    </div>

    <!-- <Filter class="my-3" v-if="displayFilter" @switchToggle="filterToggle" @getFilters="sendFilters" /> -->
</template>

<script>
import { ref } from "vue";

export default {
    components: {
        // Filter,
    },
    setup() {
        const displayFilter = ref(false);
        function filterToggle() {
            displayFilter.value = !displayFilter.value;
        }

        function sendFilters(res){
            console.log(res)
        }

        return { displayFilter, filterToggle, sendFilters };
    },
};
</script>

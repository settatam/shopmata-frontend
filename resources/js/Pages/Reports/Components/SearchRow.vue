<template>
    <!-- <div
    class="grid grid-cols-2 gap-2 my-4 md:px-0 md:grid-cols-6 rounded bg-transparent"
> -->

    <div class="lg:flex lg:flex-row lg:justify-between lg:space-x-1 my-6 w-full grid grid-cols-2 gap-2">
        <div class="w-full">
            <div
                class="relative w-full text-gray-400 focus-within:text-gray-600"
            >
                <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none"
                    aria-hidden="true"
                >
                    <SearchIcon class="h-5 w-5 ml-5" aria-hidden="true" />
                </div>
                <input
                    id="search-field"
                    name="search-field"
                    class="rounded text-xm md:text-base text-gray-500 w-full md:search-field md:w-full pl-12 pr-2 bg-white border border-gray-200 placeholder-gray-500 placehol"
                    placeholder="Search Reports"
                    type="search"
                />
            </div>
        </div>

        <div class="w-full">
            <input
                type="date"
                name=""
                class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200"
                id=""
            />
        </div>

        <div class="w-full">
            <input
                type="date"
                name=""
                class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200"
                id=""
            />
        </div>

        <div class="flex flex-col w-full">
            <select
                name="Status"
                id=""
                class="rounded text-gray-500 text-xm md:text-base w-full bg-white border border-gray-200"
            >
                <option value="">Date Kit Requested</option>
            </select>
        </div>

        <div class="flex flex-col w-full">
            <div class="flex">
                <select
                    name="Tag"
                    id=""
                    class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200"
                >
                    <option value="active">BuyMyGold.com</option>
                </select>
            </div>
        </div>

        <div class="flex w-1/2">
            <div class="flex flex-row space-x-2">
                <button
                    class="bg-purple-darken px-6 py-1 border border-transparent rounded-sm shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                    type="submit"
                >
                    Apply Now
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>

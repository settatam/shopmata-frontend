<template>
    <div
        class="grid grid-cols-2 gap-2 my-4 w-full md:grid-cols-5"
    >
        <div class="mt-2 relative w-full text-black">
            <p class="ml-4 font-medium text-xl">Search Messages</p>
        </div>

        <div class="flex flex-col">
            <select
                name="Status"
                id=""
                class="rounded text-gray-500 text-xm md:text-base w-full bg-white border border-gray-200"
            >
                <option value="">All</option>
            </select>
        </div>
        <div class="flex flex-col">
            <div class="flex">
                <select
                    name="Tag"
                    id=""
                    class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200"
                >
                    <option value="active">All</option>
                </select>
            </div>
        </div>

        <div class="">
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
                    placeholder="Search by order_id"
                    type="search"
                />
            </div>
        </div>


        <div class="flex">
            <div class="flex flex-row space-x-2">
                <button
                    class="bg-purple-darken px-5 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                    type="submit"
                >
                    Search
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>

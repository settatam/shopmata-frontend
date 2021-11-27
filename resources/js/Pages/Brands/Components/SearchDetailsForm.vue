<template>
    <div class="w-full my-10 xl:px-28 px-6">
        <div class="my-10">
            <p class="text-black font-semibold text-lg">Search details</p>
            <p class="text-gray-300">This information is used to provide accurate search results</p>
        </div>
        <div class="">
            <div class="flex flex-wrap mb-10">
                <div class="w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="meta_title">
                        Meta Title
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="search.meta_title">
                </div>
            </div>
            <div class="flex flex-wrap mb-10">
                <div class="w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="meta_keyword">
                        Meta Keywords
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="search.meta_keyword">
                </div>
            </div>
            <div class="flex flex-wrap mb-10">
                <div class="w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="search_keywords">
                        Search Keywords
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="search.search_keywords">
                </div>
            </div>
            <div class="flex flex-wrap mb-10">
                <div class="w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="meta_description">
                        Meta Description
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="search.meta_description">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'search-details-form',
    props: ['search']
}
</script>
<template>
<div class="bg-white pt-7 pb-1 mb-10 px-8">
    <div class="flex justify-between">
        <div class="cursor-pointer" @click="expandForm"><p class="text-black font-semibold text-lg mb-6">Search engine listing preview</p>
            <p class="text-black text-sm mb-6">Add a title and description to see how this product might appear in a search engine listing</p></div>
            <span><angle-up-icon></angle-up-icon></span>
        </div>
    <div v-if="expand">
    <div class="my-6">
        <label class="block text-black mb-2 bg-transparent" for="page-title">
            Page title
        </label>
        <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="Short sleeve t-shirt" v-model="search.page_title">
        <p class="text-gray-600">{{pageTitleLength}} of 70 characters used</p>
    </div>
    <div class="mb-6">
        <label class="block text-black mb-2 bg-transparent" for="search_engine_desc">
            Description
        </label>
        <textarea name="w3review" rows="6" cols="50" class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="" v-model="search.search_engine_desc"/>
        <p class="text-gray-600">{{searchEngDescLength}} of 320 characters used</p>
    </div>
    <div class="mb-6">
        <label class="block text-black mb-2 bg-transparent" for="url_handle">
            URL and handle
        </label>
        <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="https://www.shopmata.com/products/" v-model="search.url_handle">
    </div>
    </div>
</div>
</template>

<script>
import AngleUpIcon from '../../../../assets/AngleUpIcon'
export default {
    name: 'search-engine-form',
    props: ['search'],
    components: {
        AngleUpIcon
    },
    data() {
        return {
            expand: true
        }
    },
    methods: {
        expandForm() {
            this.expand = !this.expand;
        }
    },
    computed: {
        searchEngDescLength() {
            return this.search.search_engine_desc?.length || 0;
        },
        pageTitleLength() {
            return this.search.page_title?.length || 0;
        },
        showUrlHandleError () {
            return this.search.url_handle.length <= 0;
        },
    },
    mounted() {
        console.log(this.search)
    }
}
</script>

<style scoped>

</style>

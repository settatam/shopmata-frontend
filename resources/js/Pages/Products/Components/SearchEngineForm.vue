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
        <span v-if="v$.search.page_title.$error" class="text-red-400">
            {{v$.search.page_title.$errors[0].$message}}
        </span>
        <p class="text-gray-600">{{pageTitleLength}} of 70 characters used</p>
    </div>
    <div class="mb-6">
        <label class="block text-black mb-2 bg-transparent" for="search_engine_desc">
            Description
        </label>
        <textarea name="w3review" rows="6" cols="50" class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="" v-model="search.search_engine_desc"/>
        <span v-if="v$.search.search_engine_desc.$error" class="text-red-400">
            {{v$.search.search_engine_desc.$errors[0].$message}}
        </span>
        <p class="text-gray-600">{{searchEngDescLength}} of 320 characters used</p>
    </div>
    <div class="mb-6">
        <label class="block text-black mb-2 bg-transparent" for="url_handle">
            URL and handle
        </label>
        <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="https://www.shopmata.com/products/" v-model="search.url_handle">
         <span v-if="v$.search.url_handle.$error" class="text-red-400">
            {{v$.search.url_handle.$errors[0].$message}}
        </span>
    </div>
    </div>
</div>
</template>

<script>
import AngleUpIcon from '../../../../assets/AngleUpIcon'
import useVuelidate from '@vuelidate/core'
import { required, maxLength,url,helpers } from '@vuelidate/validators'

export default {
    name: 'search-engine-form',
    props: ['search'],
    components: {
        AngleUpIcon
    },
    data() {
        return {
            v$: useVuelidate(),
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
    validations(){
        return{
            search: {
                page_title: {required:helpers.withMessage('This field cannot be empty', required),maxLength:maxLength(70)},
                search_engine_desc: {required:helpers.withMessage('This field cannot be empty', required),maxLength:maxLength(320)},
                url_handle: {required:helpers.withMessage('This field cannot be empty', required),url},
            },
        }
    },
    mounted() {
        console.log(this.search)
    }
}
</script>

<style scoped>
</style>

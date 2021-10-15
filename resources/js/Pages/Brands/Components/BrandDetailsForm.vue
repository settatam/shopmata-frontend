<template>
    <div class="w-full border-b border-gray-200 xl:px-28 px-6">
        <div class="my-12">
            <p class="text-black font-semibold text-lg">Brand details</p>
            <p class="text-gray-300">This information will be used to contact you</p>
        </div>
        <div>
            <div class="flex flex-wrap mb-10">
                <div class="form-group required w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="name">
                        Brand Name
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="brand.name">
                    <!-- <span class="text-red-darker" v-if="errors.name">{{errors.name}}</span> -->
                </div>
            </div>
            <div class="flex flex-wrap mb-10">
                <div class="w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="description">
                        Description
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="brand.description">
                    <!-- <span class="text-red-darker" v-if="errors.description">{{errors.descriptopm}}</span> -->
                </div>
            </div>
            <div class="flex flex-wrap mb-10">
                <div class="w-full mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="page_title">
                        Page Title
                    </label>
                    <input class="appearance-none border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="" v-model="brand.page_title">
                    <!-- <span class="text-red-darker" v-if="errors.page_title">{{errors.page_title}}</span> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'brand-details-form',
    props: ['brand', 'errors']
}
</script>
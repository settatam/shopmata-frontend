<template>
    <div class="flex justify-center items-center py-4 border-t-2 border-gray-100"  @click="emitEdit">
        <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 md:px-10 lg:px-10 xl:px-10 min-w-full">
            <div class="mt-2 col-span-1 hidden md:block lg:block xl:block">
                <input v-model="selected" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="product" @click="emitUncheckParentBox">
            </div>
            <div class="mt-2 col-span-1 hidden md:block lg:block xl:block cursor-pointer">
                <img :src="product.images[0].image_url || '' " class="w-12 h-12 bg-gray-300 "/>
            </div>
            <div class="mt-2 flex col-span-3 mr-2 cursor-pointer">
                <input v-model="selected" type="checkbox" class="mx-4 block md:hidden lg:hidden xl:hidden form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="product" @click="emitUncheckParentBox">
               <img :src="product.images[0].image_url || '' " class=" mx-4 block md:hidden lg:hidden xl:hidden w-8 h-8 bg-gray-300 "/> {{ product.title }}
            </div>
            <div class="mt-2 col-span-1 cursor-pointer">
                 <div v-if="product.status === 'active'">
                    <div class="px-2 py inline-flex leading-5 bg-lightGreen text-green-dark">Active</div>
                </div>
                <div v-else>
                    <div class="px-2 py inline-flex leading-5 red-color text-green-dark">Inactive</div>
                </div>
            </div>
            <div class="cursor-pointer mt-2 col-span-1 hidden md:block lg:block xl:block">
                <p>{{product.stock || 1}} in stock for {{product.has_variants || 1}} variant</p>
            </div>
            <div class="cursor-pointer mt-2 col-span-1 hidden md:block lg:block xl:block">
                {{ product.type }}
            </div>
            <div class="cursor-pointer mt-2 col-span-2 hidden md:block lg:block xl:block" v-html="product.description">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product', 'edit', 'selected', 'uncheckParentBox'],
    data() {
        return {
            rowSelected: this.selected
        }
    },
    methods: {
        emitEdit() {
            this.$emit('edit', this.product)
        },
        emitUncheckParentBox() {
            this.$emit('uncheckParentBox', this.product)
        }
    }
}
</script>
<style scoped>
    .red-color{
        background: #ff00004d
    }
</style>
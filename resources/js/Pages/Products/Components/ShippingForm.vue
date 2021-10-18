<template>
    <div class="bg-white pt-7 pb-1 mb-10 px-8">
        <div class="flex justify-between cursor-pointer" @click="expandForm">
            <p class="text-black font-semibold text-lg mb-6">Shipping</p>
            <span><angle-up-icon></angle-up-icon></span>
        </div>
    <div v-if="expand">
        <div class="flex flex-wrap mb-6">
            <div class="mb-6">
                <div class="flex items-center">
                    <input v-model="shipping.physical_product" type="checkbox" id="physical_product" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                    <label for="physical_product" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                        This is a physical product
                    </label>
                </div>
            </div>
        </div>
        <p class="text-black font-semibold text-lg mb-3">Weight</p>
        <p class="text-gray-600 pb-4">Used to calculate shipping rates at checkout and label prices during fulfillment.</p>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-4/5 px-3 mb-6 md:mb-0">
                <label class="block text-black font-semibold mb-2 bg-transparent" for="weight">
                    Weight
                </label>
                <div class="relative">
                    <span class="absolute top-2 left-3 text-gray-400">$</span>
                    <input class="data-focus-visible-added appearance-none border border-border bg-transparent w-full py-2 px-10 text-black leading-tight focus:outline-none " type="number" step=".01" placeholder="0.0" v-model="shipping.weight">
                    <span class="absolute top-2 right-3 text-gray-400">lb</span>
                </div>
                    <span v-if="v$.shipping.weight.$error" class="text-red-400">
                            {{v$.shipping.weight.$errors[0].$message}}
                        </span>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import AngleUpIcon from '../../../../assets/AngleUpIcon'
import useVuelidate from '@vuelidate/core'
import { required,helpers } from '@vuelidate/validators'

export default {
    name: 'shipping-form',
    props: ['shipping'],
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
    validations(){
        return{
            shipping: {
                weight: {required:helpers.withMessage('This field cannot be empty', required)},
            }
        }
    }
}
</script>

<style scoped>
</style>

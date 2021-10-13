<template>
	<app-layout>
        <div class="overflow-hidden xl:w-3/5 w-9/10 m-auto">
            <div class="m-10 mx-auto w-4/5 lg:w-1/2 md:w-1/2">
            </div>
            <div class="overflow-auto border-gray-100 my-10 mx-auto mt-32 md:ml-56">
                <form @submit.prevent="submit">
                    <div class="bg-white mb-10 pt-7">
                        <div class="bg-white flex justify-between px-8 cursor-pointer">
                            <p class="text-black text-2xl font-semilbold mb-6">Add Custom Domain</p>
                        </div>
                        <div class="bg-white px-8 pb-6 mb-6">
                            <!-- <p class="text-black text-2xl font-semilbold mb-6">Update Product</p> -->
                            <div>
                                <label class="block text-black font-semibold mb-2 bg-transparent" for="title">
                                    Domain Name
                                </label>
                                <input class="appearance-none border bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none" type="text" placeholder="www.yourdomain.com" v-model="domain.name">
                            </div>

                            <div class="flex justify-between">
                                <t-button class="bg-transparent border-gray-400 focus:outline-none active:bg-transparent font-medium border border-transparent px-11 py-3.5 focus:outline-none" href="/store/domains">Cancel</t-button>
                                <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent px-11 py-3.5 disabled:opacity-75 focus:outline-none" @click="submit">Add Domain</t-button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="text-center bg-white pt-6 pb-6 mb-6">
                        <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent px-11 py-3.5" @click="submit">Add Domain</t-button>
                    </div> -->
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
	import AppLayout from './../../Layouts/AppLayout'
    import {setup, reactive, ref} from 'vue';
    import { Inertia } from '@inertiajs/inertia'

    
    export default {
		props: {

        },
		components: {
            AppLayout,
        },

        setup() {
            const domain = reactive({
                name: ''
            })

            function submit() {
                this.$inertia.post('/store/domains', domain)
            }

            return  {
                domain,
                submit
            }
        }
    }
</script>

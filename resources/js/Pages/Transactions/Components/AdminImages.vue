<template>
    <div class=" rounded-md bg-white mt-8 px-8 lg:mx-2">
        <div class="my-4">
            <h1 class="font-bold text-2xl my-8">
                Admin Images
            </h1>

            <div
                id="flexcontainer"
                class="flex pb-8 px-8 flex-col lg:flex-row lg:space-x-2 space-x-0"
            >
                <div class="lg:w-10/12 sm:w-full">
                    <div
                        class="border-b border-gray-300"
                        v-if="transaction.images.length && media_open"
                    >
                        <li class="flex text-gray-700 justify-between">
                            <p class="w-3/10">Image</p>
                            <p
                                class="w-5/10 border-r border-l border-gray-300 px-6"
                            >
                                Description
                            </p>
                            <p class="w-2/10 px-2">Thumbnail</p>
                        </li>
                    </div>
                    <div class="" v-if="media_open">
                        <images-list 
                        :images="transaction.images"
                        v-if="transaction.images.length"
                        @delete_img="delete_img" />
                        <Dropzone @add-image="onAddImage" class="" />
                    </div>
                    <!-- <label
                        class="flex justify-center h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                    >
                        <span class="flex items-center space-x-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                />
                            </svg>
                            <span class="font-medium text-gray-600">
                                Drop files to Attach, or
                                <span class="text-blue-600 underline"
                                    >browse</span
                                >
                            </span>
                        </span>
                        <input type="file" name="file_upload" class="hidden" />
                    </label> -->
                </div>

                <div
                    class="flex lg:flex-col justify-around mt-4 lg:mt-0 lg:space-y-2  lg:w-1/6 space-x-3 lg:space-x-0 ml-8"
                >
                    <button
                        class="bg-purple-darken w-40 px-4 md: py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                        type="submit"
                    >
                        Return Label
                    </button>
                    <!-- </div> -->

                    <!-- <div class=""> -->
                    <button
                        class="bg-purple-darken w-40 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                        type="submit"
                    >
                        Reject Offer
                    </button>
                    <!-- </div>7 -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, computed } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Dropzone from './Dropzone'
import ImagesList from './ImagesList'
import { notify } from 'notiwind'

export default {
    components: { AppLayout, Dropzone, ImagesList },
    setup () {
        const media_open = ref(true)
        const transaction = reactive({
            images: []
            })
        function delete_img (image) {
            transaction.images = image;
        }

        function onAddImage (response) {
            console.log(response)
            // for (let i = 0; i < response.data.length; i++) {
            //     transaction.images.push({
            //         ...response.data[i],
            //         alt: '',
            //         is_default: false
            //     })
            // }
            response.data.map(item=>{
                transaction.images.push({
                    ...item,
                    alt: '',
                    is_default: false
                })
            })

        }
        return { delete_img, onAddImage, media_open, transaction }
    }
}
</script>

<template>
    <div class=" rounded-md bg-white px-8 lg:mx-2">
        <div class="">
            <h1 class="font-bold text-2xl py-8">
                Customer Images
            </h1>

            <div
                id="flexcontainer"
                class="flex pb-8 px-8 flex-col lg:flex-row lg:space-x-2 space-x-0"
            >
                <div class="w-full">
                    <div
                        class="border-b border-gray-300"
                        v-if="images.length && media_open"
                    >
                        <li class="flex text-gray-700 justify-between">
                            <p class="w-3/10">Image</p>
                          
                            <p class="w-2/10 px-2">Thumbnail</p>
                        </li>
                    </div>

                    <div class="" >
                        <images-list 
                            :images="images"
                            v-if="images.length"
                            @image-deleted="delete_img" 
                        />

                        <Dropzone :transaction="root" @add-image="onAddImage" class="" />
                    </div>
                    
                </div>

                
            </div>
        </div>
    </div>
</template>

<script>
import {  ref } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Dropzone from './Dropzone'
import ImagesList from './ImagesList'

export default {
    components: { AppLayout, Dropzone, ImagesList },
    props: ['root'],
    setup (props) {
        let note_images = [];
        console.log(props.root)
        const display = ref("")
        const media_open = ref(true)
        const images  = ref(note_images)

        function delete_img (index) {
            images.value.splice(index)
        }

        function onAddImage (response) {
            images.value = response.data
        }
        return { delete_img, onAddImage, media_open, images, display }
    }
}
</script>
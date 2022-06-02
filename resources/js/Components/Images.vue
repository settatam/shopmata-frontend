<template>
    <div class="rounded-md bg-white px-8 lg:mx-2">
        <div class="">
            <h1 class="font-bold text-2xl py-8">Images</h1>

            <div
                id="flexcontainer"
                class="flex pb-8 px-8 flex-col lg:flex-row lg:space-x-2 space-x-0"
            >
                <div class="w-full">
                    <div
                        class="border-b border-gray-300"
                        v-if="images.length && media_open"
                    >
                        <div class="flex text-gray-700 justify-between">
                            <p class="w-3/10">Image</p>

                            <p class="w-2/10 px-2">Thumbnail</p>
                        </div>
                    </div>

                    <div class="">
                        <images-list
                            :images="images"
                            v-if="imgs.length"
                            @image-deleted="delete_img"
                        />

                        <Dropzone
                            @add-image="onAddImage"
                            class=""
                            :payload="payload"
                            :values="values"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import AppLayout from "../Layouts/AppLayout.vue";
import Dropzone from "./Dropzone";
import ImagesList from "./ImageList.vue";

export default {
    components: { AppLayout, Dropzone, ImagesList },
    props: ["imgs", "payload", "values"],
    setup(props, { emit }) {
        const display = ref("");
        const media_open = ref(true);
        const images = ref(props.imgs);

        const params = props.payload;
        function delete_img(index) {
            images.value.splice(index, 1);
        }

        function onAddImage(response) {
            images.value = response.data;
            emit("image-uploaded", response);
        }

        return { delete_img, onAddImage, media_open, images, display, params };
    },
};
</script>

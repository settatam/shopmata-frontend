<template>
    <!-- image modal start -->
    <ImageModal
        :enlargedImage="images[selected].url"
        @close="popUp = false"
        v-if="popUp"
    />
    <!-- image modal ends -->
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="(image, index) in images"
            :key="image.id"
            class="flex justify-between border-b border-gray-300"
            :id="'image_' + image.id"
        >
            <div class="w-3/10 py-3">
                <img
                    @click="popModal(index)"
                    class="h-10 w-10 cursor-pointer"
                    :src="image.url"
                    alt=""
                />
            </div>
            <div class="flex-grow w-5/10">
                <!-- <div class="border-r border-l px-6 py-3 border-gray-300">
                    <input
                        type="text"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-2"
                        placeholder="Write a description"
                        v-model="image.alt"
                    />
                </div> -->
            </div>
            <div class="flex items-center px-2 py-3 justify-around w-2/10">
                <LoadingSpinner
                    v-if="loading == index"
                    class="w-6 h-6 ml-8 text-purple-background"
                />

                <TrashIcon
                    v-else
                    class="w-6 h-6 text-red-500 cursor-pointer"
                    :id="image.id"
                    @click="deleteImg(image.id, index)"
                />
            </div>
        </li>
    </ul>
</template>

<script>
import { TrashIcon } from "@heroicons/vue/outline";
import { ref, reactive } from "vue";
import axios from "axios";
import LoadingSpinner from "./LoadingSpinner.vue";
import ImageModal from "./ImageModal.vue";
import notification from "../Utils/notification";

export default {
    components: {
        TrashIcon,
        LoadingSpinner,
        ImageModal,
    },
    props: ["images"],
    emits: ["image-deleted"],
    setup(props, { emit }) {
        const { onClickTop, onClickBot } = notification();
        const popUp = ref(false);
        const selected = ref(null);
        const message = ref("");
        const popModal = (index) => {
            selected.value = index;
            popUp.value = true;
        };

        const loading = ref(null);

        function deleteImg(id, index) {
            loading.value = index;
            console.log(index);
            axios
                .post("/admin/image/delete", { image_id: id })
                .then((res) => {
                    emit("image-deleted", index);
                    loading.value = null;
                    message.value = "Image deleted";
                    setTimeout(onClickTop, 2000);
                })
                .catch((error) => {
                    console.log(error);
                    loading.value = false;
                    message.value = "Error processing your request";
                    setTimeout(onClickBot, 2000);
                });
        }

        return {
            deleteImg,
            loading,
            popUp,
            popModal,
            selected,
        };
    },
};
</script>

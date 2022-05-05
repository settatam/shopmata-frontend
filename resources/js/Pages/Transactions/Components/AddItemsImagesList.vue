<template>
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            :key="image.index"
            class="flex justify-between border-b border-gray-300"
            :id="'image_' + index"
        >
            <div class="w-3/10 py-3">
                <img
                    class="h-10 w-10 cursor-pointer"
                    :src="image"
                    alt=""
                />
            </div>

            <div class="flex items-center px-2 py-3 justify-around w-2/10">
                <LoadingSpinner
                    v-if="loading == index"
                    class="w-6 h-6 ml-8 text-purple-background"
                />

                <TrashIcon
                    v-else
                    class="w-6 h-6 text-red-500 cursor-pointer"
                    :id="image.index"
                    @click="deleteImg(image, index)"
                />
            </div>
        </li>
    </ul>
</template>

<script>
import { TrashIcon } from '@heroicons/vue/outline'
import { ref } from 'vue'
import LoadingSpinner from '../../../Components/LoadingSpinner.vue'
import fileUploader from '../../../Utils/fileUploader'

export default {
    components: {
        TrashIcon,
        LoadingSpinner
    },
    props: [
        'image',
        'index'
    ],
    emits: ['image-delete'],
    setup (props, { emit }) {
        const loading = ref(null)
        const  { deleteImage } = fileUploader();
        const  message = ref('')

        function deleteImg (image, index) {
            let image_id = null;
            let image_url = image
            let images = []
            const url = `/admin/images/delete`;
            deleteImage({
              image_id, image_url, index, loading, url , message, images
            }).then( () => {
                emit('image-delete', index);
                document.getElementById('image_' + index).remove()
            })
        }

        return {
            deleteImg,
            loading,
        }
    }
}
</script>

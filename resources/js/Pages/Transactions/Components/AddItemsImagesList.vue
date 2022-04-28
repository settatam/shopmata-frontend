<template>
    <!-- <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="image in images"
            :key="image.id"
            class="flex justify-between "
            :id="'image_' + image.id"
        >
                <img
                    class="h-10 w-10 cursor-pointer"
                    :src="image[0].thumb"
                    alt=""
                /> 
        </li>
    </ul> -->

    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="(image, index) in images"
            :key="image.id"
            class="flex justify-between border-b border-gray-300"
            :id="'image_' + image.id"
        >
            <div class="w-3/10 py-3">
                <img
                    class="h-10 w-10 cursor-pointer"
                    :src="image[0].thumb"
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
                    :id="image.id"
                    @click="deleteExisting(index)"
                />
            </div>
        </li>
    </ul>
</template>

<script>
import { TrashIcon } from '@heroicons/vue/outline'
import { notify } from 'notiwind'
import { ref, reactive } from 'vue'
import axios from 'axios'
import LoadingSpinner from '../../../Components/LoadingSpinner.vue'
export default {
    components: {
        TrashIcon,
        LoadingSpinner
    },
    props: {
        images: Array
    },
    emits: ['delete_img'],
    setup (props, { emit }) {
        const successMessage = ref('')
        const loading = ref(null)

        function deleteExisting (index) {
            loading.value = index
            emit('delete_img', index)
        }

        // notification
        function onClickTop () {
            notify(
                {
                    group: 'top',
                    title: 'Success',
                    text: successMessage.value
                },
                4000
            )
        }
        function onClickBot () {
            notify(
                {
                    group: 'bottom',
                    title: 'Error',
                    text: successMessage.value
                },
                4000
            )
        }
        // notification ends

        return {
            deleteExisting,
            onClickTop,
            onClickBot,
            loading
        }
    }
}
</script>

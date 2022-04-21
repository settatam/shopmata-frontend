<template>
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <!-- existing -->
        <div v-if="existingImages">
            <li
                v-for="image in existingImages.images"
                :key="image.id"
                class="flex justify-between border-b border-gray-300"
            >
                <div class="w-3/10 py-3">
                    <img class="h-10 w-10" :src="image.url" alt="" />
                </div>
                <div class="flex-grow w-5/10">
                    <div class="border-r border-l px-6 py-3 border-gray-300">
                        <input
                            type="text"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-2"
                            placeholder="Write a description"
                            v-model="image.alt"
                        />
                    </div>
                </div>
                <div class="flex items-center px-2 py-3 justify-around w-2/10">
                    <input
                        type="checkbox"
                        v-model="image.id"
                        name="image"
                        id=""
                        class="w-5 h-5"
                        value="true"
                    />
                    <TrashIcon
                        v-if="!loading"
                        class="w-6 h-6 text-red-500"
                        @click="deleteExisting(image.id)"
                    />

                    <LoadingSpinner v-else class="w-6 h-6 text-purple-background" />
                </div>
            </li>
        </div>
        <!-- existing ends -->
        <li
            v-for="image in imagesList"
            :key="image.id"
            class="flex justify-between border-b border-gray-300"
        >
            <div class="w-3/10 py-3">
                <img class="h-10 w-10" :src="image.url" alt="" />
            </div>
            <div class="flex-grow w-5/10">
                <div class="border-r border-l px-6 py-3 border-gray-300">
                    <input
                        type="text"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-2"
                        placeholder="Write a description"
                        v-model="image.alt"
                    />
                </div>
            </div>
            <div class="flex items-center px-2 py-3 justify-around w-2/10">
                <input
                    type="checkbox"
                    v-model="image.id"
                    name="image"
                    id=""
                    class="w-5 h-5"
                    value="true"
                />
                <TrashIcon
                    v-if="!loading"
                    class="w-6 h-6 text-red-500"
                    @click="delete_image(image.id)"
                />

                <LoadingSpinner v-else class="w-6 h-6 text-purple-background" />
            </div>
        </li>
    </ul>
</template>

<script>
import { TrashIcon } from '@heroicons/vue/outline'
import { notify } from 'notiwind'
import { ref } from 'vue'
import axios from 'axios'
import LoadingSpinner from '../../../Components/LoadingSpinner.vue'
export default {
    components: {
        TrashIcon,
        LoadingSpinner
    },
    props: {
        images: Array,
        existingImages: Object
    },
    emits: ['delete_img'],
    setup ({ images }, { emit }) {
        const imagesList = ref(images)
        const loading = ref(false)
        const list = ref([])

        function deleteExisting (id) {
            loading.value = true
            axios
                .post('/transaction/image/delete', { image_id: id })
                .then(res => {
                    if (res.status == 200) {
                        loading.value = false
                        successMessage.value = 'Image deleted'
                        setTimeout(onClickTop, 2000)
                    } else if (res.status == 422) {
                        loading.value = false
                        successMessage.value = res.data.notification.message
                        setTimeout(onClickBot, 2000)
                        setTimeout(errorFn, 3000)
                    }
                })
                .catch(error => {
                    loading.value = false
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                    setTimeout(errorFn, 3000)
                })
        }

        const delete_image = num => {
            list.value = imagesList.value.filter(img => num !== img.id)
            imagesList.value = list.value
            emit('delete_img', imagesList.value)
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
            imagesList,
            delete_image,
            list,
            deleteExisting,
            onClickTop,
            onClickBot,
            loading
        }
    }
}
</script>

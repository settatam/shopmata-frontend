<template>
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="(image, index) in images"
            :key="image.id"
            class="flex justify-between border-b border-gray-300"
            :id="'image_' + image.id"
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

                <LoadingSpinner
                    v-if="loading == index"
                    class="w-6 h-6 ml-8 text-purple-background"
                />

                <TrashIcon
                    v-else
                    class="w-6 h-6 text-red-500"
                    :id="image.id"
                    @click="deleteExisting(image.id, index)"
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
        const loading = ref(null)
        const successMessage = ref('')

        function deleteExisting (id, index) {
            loading.value = index

            axios
                .post('/admin/transaction/image/delete', { image_id: id })
                .then(res => {
                    document.getElementById('image_' + id).remove()
                    loading.value = null
                    successMessage.value = 'Image deleted'
                    setTimeout(onClickTop, 2000)
                })
                .catch(error => {
                    loading.value = false
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                    //setTimeout(errorFn, 3000)
                })
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

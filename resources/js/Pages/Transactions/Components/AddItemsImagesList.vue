<template>
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="image in images"
            :key="image.id"
            class="flex justify-between border-b border-gray-300"
            :id="'image_' + image.id"
        >
            <div class="flex justify-center flex-row flex-wrap py-3">
                <img
                    class="h-10 w-10 cursor-pointer"
                    :src="image.thumb"
                    alt=""
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
    setup (props) {
        const successMessage = ref('')

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
            onClickTop,
            onClickBot,
            loading,
            selected
        }
    }
}
</script>

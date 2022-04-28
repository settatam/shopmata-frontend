<template>
    <ul role="list" class="divide-y divide-gray-200 w-100">
        <li
            v-for="image in images"
            :key="image.id"
            class="flex justify-between "
            :id="'image_' + image.id"
        >
                <img
                    class="h-10 w-10 cursor-pointer"
                    :src="image.thumb"
                    alt=""
                />
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
        }
    }
}
</script>

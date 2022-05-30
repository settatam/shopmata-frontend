<template>
    <button
        type="submit"
        @click="sendResponse"
        class="inline-flex cursor-pointer items-center justify-center rounded-md border border-transparent bg-purple-darken px-4 py-3 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
    >
        <LoadingSpinner v-if="loadingAnimation" />
        <span> {{ buttonName }} </span>
    </button>
</template>

<script>
import { ref } from 'vue'
import LoadingSpinner from './LoadingSpinner.vue'
export default {
    props: ['buttonName', 'loadingAnimation'],
    emits: ['sendResponse'],
    components: {
        LoadingSpinner
    },
    setup (props, { emit }) {
        function sendResponse (e) {
            emit('sendResponse', e)
        }

        return { sendResponse, }
    }
}
</script>

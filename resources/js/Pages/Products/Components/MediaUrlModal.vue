<template>
    <custom-modal>
        <template v-slot:header>
            Add Media From URL
        </template>
        <template v-slot:body>
            <div>
                <label class="block text-black font-semibold mb-2 bg-transparent" for="url">
                    Enter URL
                </label>
                <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="https://www.url.com" v-model="media.url">
            </div>
        </template>

        <template v-slot:trigger>
            <p class="underline mr-12">Add Media From URL</p>
        </template>
    </custom-modal>
</template>

<script>
import CustomModal from '../../../Components/CustomModal.vue'
export default {
  components: { CustomModal },
    props: ['media']
}
</script>
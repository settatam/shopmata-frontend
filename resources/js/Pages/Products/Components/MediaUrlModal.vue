<template>
    <custom-modal :styles="styles">
        <template v-slot:header>
            Add Media From URL
        </template>
        <template v-slot:body>
            <div>
                <label class="block text-black font-semibold mb-2 bg-transparent" for="url">
                    Enter URL
                </label>
                <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" placeholder="https://www.url.com" v-model="media.url">
                <span v-if="v$.media.url.$error" class="text-red-400">
                            {{v$.media.url.$errors[0].$message}}
                </span>
            </div>
        </template>

        <template v-slot:trigger>
            <p class="underline mr-12">Add Media From URL</p>
        </template>
    </custom-modal>
</template>

<script>
import CustomModal from '../../../Components/CustomModal.vue'
import useVuelidate from '@vuelidate/core'
import { required,url,helpers } from '@vuelidate/validators'

export default {
  components: { CustomModal },
    props: ['media'],
    data() {
        return {
            v$: useVuelidate(),
            styles: {
                header: ""
            }
        }
    },
    validations(){
        return{
            media: {
                url: {required:helpers.withMessage('This field cannot be empty', required),url},
            },
        }
    },
}
</script>
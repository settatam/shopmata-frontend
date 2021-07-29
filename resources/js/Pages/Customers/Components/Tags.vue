<template>
    <div class="px-6 pt-4 pb-6 my-4 bg-white">
        <div class="flex justify-between mb-4">
            <p class="text-lg">Tags</p>
            <p class="text-purple-darker cursor-pointer">View all tags</p>
        </div>
        <multiselect v-model="allTags" tag-placeholder="" placeholder="Pick a tag" label="label" track-by="value" :options="options" :multiple="true" class="text-xs text-black font-semibold"></multiselect>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
// import {countries} from '../../../constants/countries'
export default {
    props: ['tags'],
    data() {
        return {
            allTags: this.tags,
            options: [], //countries
        }
    },
    components: {
        Multiselect
    },
    methods: {
        addTag (newTag) {
            // const tag = {
            //     name: newTag.value,
            //     label: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            // }
            // this.options.push(newTag)
            this.allTags.push(newTag)
        }
    }

}
</script>
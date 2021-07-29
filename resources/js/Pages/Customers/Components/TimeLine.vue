<template>
    <div>
        <div class="flex justify-between items-center py-2 border-b-2 border-gray-300 p-6 mb-6">
            <p class="text-black font-semibold text-lg">Timeline</p>
            <div class="flex">
                <input type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="show_comments" v-model="timeline.show_comments">
                <label for="show_comments" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                    Show comments
                </label>
            </div>
        </div>
        <div class="flex ml-1 px-6">
            <span class="bg-purple-darker rounded-1/2 py-2 px-2.5 text-white text-lg">{{initials}}</span>
            <div class="relative w-full ml-1">
                <input class="appearance-none bg-transparent w-full py-3 pl-3 pr-20 text-gray-500 leading-tight focus:outline-none bg-white" type="text" placeholder="Leave a comment" v-model="input">
                <span class="absolute items-center flex top-3.5 right-24">
                        <span 
                            class="mx-2" 
                            @click="togglePicker"
                        >
                        <VEmojiPicker @select="selectEmoji" v-if="showEmojiKeyboard"/>
                            <img src="../../../../assets/emoji.svg" />
                        </span>
                    <span class="mx-2"><img src="../../../../assets/aticon.svg" /></span>
                    <span class="mx-2"><img src="../../../../assets/hashicon.svg" /></span>
                </span>
                <t-button class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent px-7 py-1 absolute -ml-23 mt-1.5" type="submit">Post</t-button>
            </div>
        </div>
        <div class="px-8">
            <p class="text-gray-400 text-right ml-4 border-l-4 border-gray-400 mt-2">Only you and other staff can see comments</p>
            <customer-activity v-for="(activity, index) of 10" :key="index"></customer-activity>
        </div>
    </div>
</template>
<script>
import CustomerActivity from './CustomerActivity.vue'
// import {getInitials} from '../../../utils/helper';
export default {
    components: { CustomerActivity },
    props: ['timeline', 'customer', 'activities'],
    data() {
        return {
            search: '',
            input: this.timeline.comment || "",
            showEmojiKeyboard: false
        }
    },
    computed: {
        initials() {
            return getInitials(`${this.customer.first_name} ${this.customer.last_name}`);
        }
    },
    directives: {
        focus: {
        inserted(el) {
            el.focus()
        },
        },
    },
    methods: {
        append(emoji) {
            this.input += emoji
        },
        selectEmoji(emoji) {
            console.log(emoji.data);
            this.input = this.input + emoji.data
        },
        togglePicker() {
            this.showEmojiKeyboard = !this.showEmojiKeyboard
        }
    }
}
</script>
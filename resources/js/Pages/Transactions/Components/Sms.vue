<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <div class="text-xl px-4 rounded-t-md w-full font-bold flex justify-center text-black">
            <h1>SMS</h1>
        </div>

        <!-- sms chatbox starts -->
        <div>
            <div class="px-1 space-y-2 h-48 overflow-y-auto">
                <template class="bg-gray-lightest p-4 " v-for="(sms, index) in transaction.slice().reverse()"
                    :key="sms.index">
                    <div class="flex items-end justify-end" v-if="sms.is_coming">
                        <div class="flex flex-col w-1/2 max-w-xs mx-2 order-1 items-end">
                            <div class="px-4 py-2 rounded-lg inline-block p-2 bg-blue-600 text-white ">
                                <p class="text-xs py-2">
                                    {{ formattedTimes[index] }}
                                </p>
                                <span>{{ sms.message }}</span>
                            </div>
                        </div>
                    </div>

                    <div v-else class="bg-gray-300  mx-4 my-2 w-3/4 p-2 rounded-lg flex flex-col justify-start">
                        <p class="text-xs py-2">{{ formattedTimes[index] }}</p>
                        <p>{{ sms.message }}</p>
                    </div>
                </template>
            </div>

            <div class="mt-3 mx-1">
                <div class="flex justify-center">
                    <h1 class="text-black font-bold text-xl pt-4">Send SMS</h1>
                </div>

                <form action="#" class="relative">
                    <div
                        class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                        <!-- <label for="title" class="sr-only">Title</label>
                        <input type="text" name="title" id="title"
                            class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0"
                            placeholder="Title" /> -->
                        <label for="description" class="sr-only">Description</label>
                        <textarea rows="2" name="description" id="description"
                            class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm"
                            placeholder="Write a description..." />

                        <!-- Spacer element to match the height of the toolbar -->
                        <div aria-hidden="true">
                            <div class="py-2">
                                <div class="h-9" />
                            </div>
                            <div class="h-px" />
                            <div class="py-2">
                                <div class="py-px">
                                    <div class="h-9" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-0 inset-x-px">
                        <!-- Actions: These are just examples to demonstrate the concept, replace/wire these up however makes sense for your project. -->
                        <div class="flex flexwrap justify-end py-2 px-2 space-x-2 sm:px-3">
                            

                            
                        </div>
                        <div
                            class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
                            <div class="flex">
                                <button type="button"
                                    class="-ml-2 -my-2 rounded-full px-3 py-2 inline-flex items-center text-left text-gray-400 group">
                                    <PaperClipIcon class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500"
                                        aria-hidden="true" />
                                </button>
                            </div>
                            <!-- <div class="flex-shrink-0">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">send
                                    Message</button>
                            </div> -->
                        </div>
                    </div>
                </form>
            </div>


            <div class="flex justify-center">
                <Button class="my-6" @sendResponse="addMessage" :loadingAnimation="loadingAnimation"
                    :buttonName="buttonName" />
            </div>
        </div>
    </div>
</template>

<script>
import { computed } from '@vue/runtime-core'
import AppLayout from '../../../Layouts/AppLayout.vue'
import { ref, reactive } from 'vue'
import Button from '../../../Components/Button.vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CalendarIcon, PaperClipIcon, TagIcon, UserCircleIcon } from '@heroicons/vue/solid'

export default {
    components: { AppLayout, Button, Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions, CalendarIcon, PaperClipIcon, TagIcon, UserCircleIcon },
    props: ['transaction', 'id'],
    setup(props) {
        const smsTimes = props.transaction
        let smsMessage = ref('');
        const buttonName = ref('Send Message')
        const loadingAnimation = ref(false)

        // test
        const assignees = [
            { name: 'Unassigned', value: null },
            {
                name: 'Wade Cooper',
                value: 'wade-cooper',
                avatar:
                    'https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
            },
            // More items...
        ]
        const labels = [
            { name: 'Unlabelled', value: null },
            { name: 'Engineering', value: 'engineering' },
            // More items...
        ]
        const dueDates = [
            { name: 'No due date', value: null },
            { name: 'Today', value: 'today' },
            // More items...
        ]

        const assigned = ref(assignees[0])
        const labelled = ref(labels[0])
        const dated = ref(dueDates[0])


        // test

        function formatDate(date) {
            var hours = date.getHours()
            var minutes = date.getMinutes()
            var ampm = hours >= 12 ? 'pm' : 'am'
            hours = hours % 12
            hours = hours ? hours : 12 // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes
            var strTime = hours + ':' + minutes + ' ' + ampm
            return date.getMonth() + 1 + '/' + date.getDate() + '  ' + strTime
        }

        function addMessage() {
            loadingAnimation.value = true
            axios.post('/admin/transactions/' + props.id + '/sms', {
                message: smsMessage.value
            }).then(res => {
                loadingAnimation.value = false
            })
        }

        const formattedTimes = computed(() => {
            return smsTimes.map(item => {
                let d = new Date(Date.parse(item.created_at))
                return formatDate(d)
            })
        })
        return { smsTimes, formatDate, formattedTimes, smsMessage, addMessage, buttonName, loadingAnimation, assignees, dueDates, labels, assigned, labelled, dated }
    }
}
</script>

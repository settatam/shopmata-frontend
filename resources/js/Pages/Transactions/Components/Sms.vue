<template>
    <div class=" rounded-md bg-white lg:mx-2">
        <div
            class="text-xl px-4 rounded-t-md w-full font-bold flex justify-center text-black"
        >
            <h1>SMS</h1>
        </div>

        <!-- sms chatbox starts -->
        <div>
            <div class="px-1 space-y-2 h-48 overflow-y-auto">
                <template
                    class="bg-gray-lightest p-4 "
                    v-for="(sms, index) in transaction.slice().reverse()"
                    :key="sms.index"
                >
                    <div
                        class="flex items-end justify-end"
                        v-if="sms.is_coming"
                    >
                        <div
                            class="flex flex-col w-1/2 max-w-xs mx-2 order-1 items-end"
                        >
                            <div class="px-4 py-2 rounded-lg inline-block p-2 bg-purple-darken text-white ">
                                <p class="text-xs py-2">{{formattedTimes[index]}}</p>
                                <span
                                    
                                    >{{ sms.message }}</span
                                >
                            </div>
                        </div>
                    </div>

                    <div
                        v-else
                        class="bg-gray-300  mx-4 my-2 w-3/4 p-2 rounded-lg flex flex-col justify-start"
                    >
                    <p class="text-xs py-2">{{formattedTimes[index]}}</p>
                        <p>{{ sms.message }}</p>
                    </div>
                </template>
            </div>

            <div class="mt-3 mx-1">
                <div class="flex justify-center">
                    <h1 class="text-black font-bold text-xl pt-4">Send SMS</h1>
                </div>

                <textarea
                    class="shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md "
                    placeholder="Write a delivery note ......."
                    name=""
                    id=""
                    rows="10"
                ></textarea>
            </div>

            <div class="flex flex-row justify-center py-4">
                <button
                    class="bg-purple-darken px-4 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken lg:w-1/2"
                    type="submit"
                >
                    Send Message
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { computed } from '@vue/runtime-core'
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout },
    props: ['transaction'],
    setup (props) {
        const smsTimes = props.transaction

        function formatDate (date) {
            var hours = date.getHours()
            var minutes = date.getMinutes()
            var ampm = hours >= 12 ? 'pm' : 'am'
            hours = hours % 12
            hours = hours ? hours : 12 // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes
            var strTime = hours + ':' + minutes + ' ' + ampm
            return (
                date.getMonth() +
                1 +
                '/' +
                date.getDate() +
                '  ' +
                strTime
            )
        }

        const formattedTimes = computed(() => {
            return smsTimes.map((item)=>{
                let d = new Date(Date.parse(item.created_at));
                return formatDate(d)
            })

            
        })
        return {smsTimes, formatDate, formattedTimes }
    }
}
</script>

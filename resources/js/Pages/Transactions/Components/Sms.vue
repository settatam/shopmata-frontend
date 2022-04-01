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
                    v-for="sms in transaction"
                    :key="sms.index"
                >

                    <div
                        class="flex items-end justify-end"
                        v-if="sms.is_coming"
                    >
                        <div
                            class="flex flex-col  max-w-xs mx-2 order-1 items-end"
                        >
                            <div>
                                <span
                                    class="px-4 py-2 rounded-lg inline-block p-2 bg-purple-darken text-white "
                                    >{{ sms.message }}</span
                                >
                            </div>
                        </div>
                    </div>

                    <div
                        v-else
                        class="bg-gray-300  mx-4 my-2 w-3/4 p-2 rounded-lg flex justify-start"
                    >
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
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout },
    props: ['transaction'],
    setup () {
        return {}
    }
}
</script>

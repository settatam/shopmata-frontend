<template>
    <div class=" rounded-md bg-white ml-3 mr-3">
        <div class="rounded-t-md w-full bg-purple-darken py-4 pl-4 text-white">
            <h1>SMS</h1>
        </div>

        <div class="p-4 space-y-2">
            <div class="bg-gray-background p-4">
                lorem ipsum etc
            </div>

            <div class="bg-gray-background p-4">
                lorem ipsum etc
            </div>

            <div class="my-2 mx-1">
                <textarea
                    class="shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md "
                    placeholder="Write a delivery note ......."
                    name=""
                    id=""
                    rows="10"
                ></textarea>
            </div>

            <div class="flex flex-row justify-center mx-6 py-4">
                <button
                    class="bg-purple-darken px-6 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken w-1/2"
                    type="submit"
                >
                    Send SMS
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout },
    setup () {
        return {}
    }
}
</script>

<template>
    <div class="flex flex-row justify-between mx-4">
        <div class="flex flex-row space-x-2">
            <div class=" text-purple-darken">
                <h1 class="text-2xl">Reports 0</h1>
            </div>

            <div class="text-xxs mt-4">
                <p>
                    Last updated 45 minutes ago
                    <span class="text-purple-darken">[Refresh]</span>
                </p>
            </div>
        </div>

        <!-- button -->
        <div>
            <button
                class="bg-purple-darken px-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                type="submit"
            > <PlusCircleIcon class="h-5 w-5 mr-1"/>
                New Customer
            </button>
        </div>
    </div>
</template>

<script>

import { PlusCircleIcon } from '@heroicons/vue/outline'

export default {
    components:{
        PlusCircleIcon
    }
}
</script>

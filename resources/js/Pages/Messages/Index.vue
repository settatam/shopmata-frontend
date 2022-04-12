<template>
    <app-layout>
        <!-- Page header -->
        <div id="container" class="flex flex-col mx-3 space-y-1">
            <div>
                <SearchRow />
            </div>

            <div>
                <MessagesTable :messages="messages"/>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import { SearchIcon, PlusIcon } from '@heroicons/vue/solid'
import { Inertia } from '@inertiajs/inertia'
import SearchRow from './Components/SearchRow.vue'
import MessagesTable from './Components/MessagesTable.vue'

export default {
    components: {
        AppLayout,
        SearchIcon,
        SearchRow,
        MessagesTable
    },
    props: ['messages']
}
</script>

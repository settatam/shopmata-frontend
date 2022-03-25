<template>
    <app-layout>
        <!-- Page header -->
        <div id="container" class="flex flex-col mx-3 space-y-1">
            <div>
                <SearchRow />
            </div>

            <div>
                <TransactionTable />
            </div>

            <div>
                <TransactionTable />
            </div>

            <h2 class="text-xs mx-3 my-3">FILTER BY: </h2>

            <div>
                <FilterBy/>
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
import TransactionTable from './Components/TransactionTable.vue'
import FilterBy from './Components/FilterBy.vue'

export default {
    components: {
        AppLayout,
        SearchIcon,
        SearchRow,
        TransactionTable,
        FilterBy
    },
    props: {
        notifications: Array,
        transactions: Object
    }
}
</script>

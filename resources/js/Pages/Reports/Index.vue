<template>
    <app-layout>
        <!-- Page header -->
        <div id="container" class="flex flex-col mx-3 space-y-1">
            <div class="mt-4">
                <TopRow />
            </div>

            <div class="mx-2">
                <SearchRow />
            </div>

            <div>
                <ReportLayout />
            </div>

            <!-- <div>
                <TransactionTable />
            </div> -->

            

            <div>
                <FilterBy/>
            </div>

            <div>
                <Entries/>
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
import TopRow from './Components/TopRow.vue'
import SearchRow from './Components/SearchRow.vue'
import TransactionTable from './Components/TransactionTable.vue'
import FilterBy from './Components/FilterBy.vue'
import Entries from './Components/Entries.vue'
import ReportLayout from './Components/ReportLayout.vue'


export default {
    components: {
        AppLayout,
        SearchIcon,
        SearchRow,
        TransactionTable,
        FilterBy,
        Entries,
        TopRow,
        ReportLayout
    },
    props: {
        notifications: Array,
        transactions: Object
    }
}
</script>

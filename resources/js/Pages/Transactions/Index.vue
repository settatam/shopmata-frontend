<template>
    <!-- Page header -->
    <app-layout :navigation="navigation">
        <div id="container" class="flex flex-col mx-3">

            <Table :filters="filters"/>
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive, computed, onMounted } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import { SearchIcon, PlusIcon } from '@heroicons/vue/solid'
import { MailIcon, PhoneIcon } from '@heroicons/vue/outline'
import Pagination from '../../Components/Pagination.vue'
import { Inertia } from '@inertiajs/inertia'
import DeleteModal from '../../Components/DeleteModal.vue'
import notification from '../../Utils/notification'
import Table from "../Widgets/Table";

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

const filters = {
    type: 'TransactionsTable',
    // status: 60
}

export default {
    components: {
        AppLayout,
        SearchIcon,
        MailIcon,
        PlusIcon,
        PhoneIcon,
        Pagination,
        DeleteModal,
        Table
    },
    props: {
        notifications: Array,
        transactions: Object,
        navigation: Array
    },
    setup ({ navigation, transactions }) {
        const { onClickTop, onClickBot } = notification()
        const imageExists = ref(true)
        const loading = false
        const isChecked = ref(false)
        const notifications = notifications
        const pagination = ref(transactions)
        const filterLists = ref(transactions.data)
        const massActionChoice = ref('choose')
        const isDelete = ref(false)
        const filterNumber = ref('choose')
        const deleteProps = reactive({
            url: '/admin/transactions/delete',
            item: 'Transactions'
        })
        const checkedTransactions = ref([])

        onMounted(() => {
            // this.$emit('doNavigation', navigation)
        })

        function success (list, page) {
            filterLists.value = list
            pagination.value = page
            loading.value = false
        }

        function checkAll () {
            isChecked.value = !isChecked.value
        }

        function sendAction () {
            let data = {
                transactions: checkedTransactions.value,
                action: massActionChoice.value
            }
            switch (massActionChoice.value) {
                case 'delete':
                    isDelete.value = true
                    break
                case 'label_to':
                case 'label_from':
                case 'barcode':
                    Inertia.post(
                        '/admin/transactions/bulk-actions/barcode',
                        data
                    )
                    break
            }
        }

        function close () {
            isDelete.value = false
            Inertia.visit('/admin/transactions', {
                method: 'get'
            })
        }

        function filterTransactions () {
            switch(filterNumber.value){
                case 'choose':
                    break
                default:
                        Inertia.visit(`/admin/transactions?per_page=${filterNumber.value}`, {
                method: 'get'
            })
            }
        }

        return {
            loading,
            transactions,
            statusStyles,
            pagination,
            filterLists,
            imageExists,
            isChecked,
            checkAll,
            massActionChoice,
            sendAction,
            isDelete,
            deleteProps,
            close,
            checkedTransactions,
            filterNumber,
            filterTransactions,
            filters
        }
    }
}
</script>

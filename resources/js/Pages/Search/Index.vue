<template>
    <!-- Page header -->
    <app-layout :navigation="navigation">
        <div id="container" class="flex flex-col mx-3">
            <shopmata-table :filters="filters" />
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
import ShopmataTable from "../Widgets/ShopmataTable";

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
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
        ShopmataTable
    },
    props: {
        notifications: Array,
        transactions: Object,
        navigation: Array,
        filters: Object
    },
    setup ({ navigation, transactions }) {
        const { onClickTop, onClickBot } = notification()
        const imageExists = ref(true)
        const loading = false
        const isChecked = ref(false)
        const notifications = notifications
        const massActionChoice = ref('choose')
        const isDelete = ref(false)
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

        return {
            loading,
        }
    }
}
</script>

<template>
    <!-- Page header -->
    <app-layout :navigation="navigation">
        <div id="container" class="flex flex-col mx-3 mt-4">
            <ConfirmationModal
                :open="openConfirmationModal"
                @close="closeConfirmationModal"
            >
                <template #header>
                    {{ confirmationHeader }}
                </template>
                <template #body>
                    {{ confirmationBody }}
                </template>
            </ConfirmationModal>

            <div class="mt-4 sm:mt-0  sm:flex-none">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    @click="filterToggle()"
                >
                    Filter by:
                </button>
            </div>

            <BinLocation
                @send="sendPayload"
                @close="toggleModal"
                v-if="displayModal"
            />

            <Filter
                v-if="filterToggleStatus"
                @getFilters="filterValues"
                @switchToggle="filterToggle"
            />
            <shopmata-table :filters="tableFilters" @action="doAction" />
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive, computed, onMounted } from 'vue'
import Filter from '../../Components/Filter.vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import { SearchIcon, PlusIcon } from '@heroicons/vue/solid'
import { MailIcon, PhoneIcon } from '@heroicons/vue/outline'
import Pagination from '../../Components/Pagination.vue'
import { Inertia } from '@inertiajs/inertia'
import DeleteModal from '../../Components/DeleteModal.vue'
import notification from '../../Utils/notification'
import ShopmataTable from '../Widgets/ShopmataTable'
import ConfirmationModal from '../../Components/ConfirmationModal'
import * as api from '../../api'
import urls from '../../api/urls'
import BinLocation from '../../Components/BinLocation.vue'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: {
        ConfirmationModal,
        AppLayout,
        SearchIcon,
        MailIcon,
        PlusIcon,
        PhoneIcon,
        Pagination,
        DeleteModal,
        ShopmataTable,
        Filter,
        BinLocation
    },
    props: {
        notifications: Array,
        transactions: Object,
        navigation: Array,
        filters: Object
    },
    emits: ['switchToggle'],
    setup (props, { navigation, transactions, emit }) {
        const { onClickTop, onClickBot } = notification()
        const imageExists = ref(true)
        const loading = false
        const isChecked = ref(false)
        const notifications = notifications
        const massActionChoice = ref('choose')
        const isDelete = ref(false)
        const filterNumber = ref('choose')
        const deleteProps = reactive({
            url: '/admin/transactions/delete',
            item: 'Transactions'
        })
        const checkedTransactions = ref([])
        const openConfirmationModal = ref(false)
        const confirmationHeader = ref('')
        const confirmationBody = ref('')
        const selectedTransactions = ref([])
        const confirmationFor = ref({})
        const tableFilters = ref(props.filters)
        const filterToggleStatus = ref(false)
        const displayModal = ref(false)
        const bin_location = ref('')

        function filterToggle () {
            filterToggleStatus.value = !filterToggleStatus.value
        }

        function filterValues (res) {
            console.log(res)
        }

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

        function toggleModal () {
            displayModal.value = !displayModal.value
        }

        // function sendAction () {
        //     let data = {
        //         transactions: checkedTransactions.value,
        //         action: massActionChoice.value
        //     }
        //     switch (massActionChoice.value) {
        //         case 'delete':
        //             isDelete.value = true
        //             confirmationBody.value = 'Are you sure you want to delete these transactions?'
        //             confirmationHeader.value = 'Delete Transactions'
        //             openConfirmationModal.value = true;
        //             break
        //         case 'label_to':
        //         case 'label_from':
        //         case 'barcode':
        //             Inertia.post(
        //                 '/admin/transactions/bulk-actions/barcode',
        //                 data
        //             )
        //             break
        //     }
        // }

        function close () {
            isDelete.value = false
            Inertia.visit('/admin/transactions', {
                method: 'get'
            })
        }

        function filterTransactions () {
            switch (filterNumber.value) {
                case 'choose':
                    break
                default:
                    Inertia.visit(
                        `/admin/transactions?per_page=${filterNumber.value}`,
                        {
                            method: 'get'
                        }
                    )
            }
        }

        function doAction (action, selectedItems) {
            let name = action.formGroups[0].field.attributes.name
            let value = action.formGroups[0].field.attributes.value
            selectedTransactions.value = selectedItems.map(t => t.data)
            if (name == 'status') {
                sendAction(name, value)
            } else if (name == 'actions') {
                if (value == 'Delete') {
                    confirmationBody.value =
                        'Are you sure you want to delete these transactions?'
                    confirmationHeader.value = 'Delete Transactions'
                    openConfirmationModal.value = true
                    confirmationFor.value = {
                        name: 'actions',
                        value: 'Delete'
                    }
                } else if (value == 'Bin Location') {
                    displayModal.value = true
                    confirmationFor.value = {
                        name: 'actions',
                        value: 'Bin Location'
                    }
                } else {
                    sendAction(name, value)
                }
            }
        }

        function closeConfirmationModal (confirmation) {
            openConfirmationModal.value = false
            if (confirmation)
                sendAction(
                    confirmationFor.value.name,
                    confirmationFor.value.value
                )
        }

        function sendPayload (res) {
            bin_location.value = res
            sendAction(confirmationFor.value.name,
                    confirmationFor.value.value)
        }

        function sendAction (action, value) {
            let data = {
                transactions: selectedTransactions.value,
                action: value
            }
            switch (action) {
                case 'status':
                    console.log('This is the status')
                    break
                case 'actions':
                    switch (value) {
                        case 'Delete':
                            alert(
                                'this is the part where we actually delete the item'
                            )
                            break
                        case 'Send Message':
                            Inertia.get(
                                '/admin/transactions/bulk/messages',
                                data,
                                {
                                    replace: true
                                }
                            )
                            break
                        case 'Create Barcodes':
                        case 'Rejected By Admin':
                        case 'Create Shipping Label':
                            Inertia.post(
                                urls.transactions.bulkAction('barcode'),
                                { ...data, ...props.filters }
                            )
                            break
                        case 'Bin Location':
                            let url = urls.transactions.bin_location(selectedTransactions.value[0])
                            console.log(url)
                            axios.post(url, {bin_location:bin_location.value})
                            break
                    }

                default:
                    Inertia.post(
                        urls.transactions.bulkAction('status'),
                        { ...data, ...props.filters },
                        {
                            replace: false,
                            onSuccess: () => {
                                tableFilters.value.refreshToken = Math.random()
                                console.log(tableFilters.value)
                                Inertia.reload()
                            }
                        }
                    )
                    break
            }

            confirmationFor.value = ''
        }

        return {
            loading,
            filterToggleStatus,
            transactions,
            statusStyles,
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
            doAction,
            openConfirmationModal,
            confirmationBody,
            confirmationHeader,
            closeConfirmationModal,
            tableFilters,
            filterToggle,
            filterValues,
            displayModal,
            selectedTransactions,
            toggleModal,
            sendPayload,
            bin_location
        }
    }
}
</script>

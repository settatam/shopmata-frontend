<template>
    <!-- Page header -->
    <app-layout :navigation="navigation">
        <div id="container" class="flex flex-col mx-3">
            <div class="mx-3 flex flex-col lg:flex-row justify-center md:justify-between space-y-4 lg:space-y-0 lg:space-x-0">
                <div class="">
                    <div class="sm:flex sm:items-center">
                      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <button type="button" @click="sendAction"
                                class="inline-flex
                                items-center
                                justify-center
                                rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Print Labels
                        </button>
                      </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                  <div class="-my-2 -mx-4 overflow-x-auto">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                      <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="w-full divide-y divide-gray-300">
                          <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Transaction</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Type</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Count</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                              </th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="transaction in filterLists" :key="transaction.id">
                              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                <div class="flex items-center">
                                  <div class="h-10 w-10 flex-shrink-0">
                                    {{ transaction.id }}
                                  </div>
                                </div>
                              </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div>
                                        <select id="direction" name="direction" v-model="transaction.direction">
                                            <option v-for="option in options" :value="option.value">
                                                {{ option.text }}
                                            </option>
                                        </select>
                                    </div>
                              </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div> <input type="number" v-model="transaction.qty"> </div>
                              </td>
                              <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>
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
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

const options =  [
        { text: 'To', value: 'to' },
        { text: 'From', value: 'from' },
];

export default {
    components: {
        AppLayout,
        SearchIcon,
        MailIcon,
        PlusIcon,
        PhoneIcon,
        Pagination,
        DeleteModal
    },
    props: {
        notifications: Array,
        transactions: Object,
        navigation: Array
    },
    setup ({ navigation, transactions }) {
        const imageExists = ref(true)
        const loading = false
        const isChecked = ref(false)
        const notifications = notifications
        const pagination = ref(transactions)
        const filterLists = ref(transactions)
        const massActionChoice = ref('')
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
            let params = {
                transactions: JSON.stringify(filterLists.value),
                action: 'label',
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            let form  = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', '/admin/transactions/bulk-print-action');
            for (let key in params) {
                if (params.hasOwnProperty(key)) {
                    let hiddenField = document.createElement('input');
                    hiddenField.setAttribute('type', 'hidden');
                    hiddenField.setAttribute('name', key);
                    hiddenField.setAttribute('value', params[key]);
                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }

        function close () {
            isDelete.value = false
        }

        return {
            loading,
            transactions,
            statusStyles,
            pagination,
            filterLists,
            sendAction,
            options
        }
    }
}
</script>

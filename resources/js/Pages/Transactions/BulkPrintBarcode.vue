<template>
  <!-- Page header -->
  <app-layout :navigation="navigation">
    <div id="container" class="flex flex-col mx-3">

      <div class="mt-2">
        <h1 class="my-3 font-bold text-xl">Print Barcodes</h1>
      </div>


      <div class="flex w-full flex-row pb-8 justify-end">
        <button type="button" @click="sendAction"
          class="inline-flex items-center justify-center rounded-md border border-transparent bg-purple-darken px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
          Print Barcodes
        </button>
      </div>



      <table class="w-full rounded-t-lg divide-gray-300">

        <thead class="bg-purple-darken rounded-t-lg w-full divide-x divide-white">
          <tr>
            <th scope="col" class=" px-4 py-4 w-1/2 text-left text-normal font-bold text-white">
              Name</th>
            <th scope="col" class=" px-4 py-4 w-1/2 text-left  text-normal font-bold text-white">Title</th>
            <!-- <th scope="col" class="w-1/2 text-sm font-semibold text-gray-900">
                <span class="sr-only">Edit</span>
              </th> -->
          </tr>
        </thead>


        <tbody class="divide-gray-200 bg-white divide-x divide-y ">
          <tr v-for="transaction in filterLists" :key="transaction.id">
            <td class="whitespace-nowrap py-4 pl-4 px-3 text-left text-sm sm:pl-6">
              {{ transaction.id }}
            </td>
            <td class="whitespace-nowrap py-4 px-3 text-left text-sm font-medium">
              <input
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                type="number" v-model="transaction.qty">
            </td>
            <!-- <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
              </td> -->
          </tr>
        </tbody>

      </table>
    </div>
  </app-layout>
</template>




<script>
import { ref, reactive, computed, onMounted } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800'
}
export default {
  components: {
    AppLayout,
  },
  props: {
    notifications: Array,
    transactions: Object,
    navigation: Array
  },
  setup({ navigation, transactions }) {
    const loading = false
    const notifications = notifications
    const filterLists = ref(transactions)

    function postAsNativeForm(action, params) {

    }

    function sendAction() {
      let params = {
        transactions: JSON.stringify(filterLists.value),
        action: 'barcode',
        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }

      postAsNativeForm('/admin/transactions/bulk-print-action', params);
    }


    return {
      loading,
      transactions,
      statusStyles,
      pagination,
      filterLists,
      sendAction
    }
  }
}
</script>

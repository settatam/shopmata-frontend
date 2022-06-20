<template>
  <!-- Page header -->
  <app-layout :navigation="navigation">
    <div id="container" class="flex flex-col mx-3">

      <!-- nav start -->
      <nav class="flex pt-8" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-4">
          <li>
            <div>
              <a href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
                <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                <span class="sr-only">Settings</span>
              </a>
            </div>
          </li>
          <li v-for="page in pages" :key="page.name">
            <div class="flex items-center">
              <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
              <a :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="
                page.current ? 'page' : undefined
              ">{{ page.name }}</a>
            </div>
          </li>
        </ol>
      </nav>

      <!-- nav end -->

      <div>
        <p class="mt-2">Click <a href="/admin/transactions?status=60"
            class="text-purple-darken font-bold underline text-xl">HERE</a> to go back to the transactions page</p>
      </div>

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
import { ChevronRightIcon, HomeIcon } from "@heroicons/vue/solid";
import { Inertia } from '@inertiajs/inertia'
const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800'
}
const pages = [
  { name: "Transactions", href: "/admin/transactions?status=60", current: false },
  {
    name: "Bulk Print Barcode",
    href: "#",
    current: true,
  },
];
export default {
  components: {
    AppLayout,
    ChevronRightIcon,
    HomeIcon
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
      pages,
      loading,
      transactions,
      statusStyles,
      filterLists,
      sendAction,
    }
  }
}
</script>

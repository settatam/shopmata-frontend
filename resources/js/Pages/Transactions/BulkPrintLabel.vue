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
        <h1 class="my-3 font-bold text-xl">Print Shipping Labels</h1>
      </div>

      <div class="flex w-full flex-row space-x-2 pb-3 justify-end">

        <div class="flex flex-col">
          <label class="text-center font-semibold">
            Choose Date:
          </label>

          <flatPickr :style="{
            '--vdp-hover-bg-color':
              'rgba(79, 70, 229, var(--tw-bg-opacity))',
            '--vdp-selected-bg-color':
              'rgba(79, 70, 229, var(--tw-bg-opacity))'
          }" id="daterange" name="daterange"
            class="text-start border  py-2 text-center text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            v-model="shipDate" :lowerLimit="shipDate"></flatPickr>
        </div>

        <div class=" flex flex-col-reverse">
          <button type="button" @click="sendAction"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-purple-darken px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
            Print Labels
          </button>
        </div>

      </div>

      <div class="bg-red-500 py-3" v-if="trans != null || store_without_address">
        <ul>
          <li v-if="store_without_address">
            <span class=" py-1 my-1 px-3 text-white">This store does not
              have an address, click <a class="underline cursor-pointer" href="/admin/settings">here</a> to fix </span>
          </li>

          <li v-if="trans == !null">
            <p class=" py-1 my-1 px-3 text-white">The following customers do not have an address, click on them to fix
            </p>

            <a v-for="tran in trans" :key="tran.index" :href="'admin/customers/' + tran.customer.id">/{{
                tran.customer.id
            }}</a>
          </li>
        </ul>
      </div>



      <table class="w-full divide-y mt-2 divide-gray-300" v-if="!store_without_address">

        <thead class="bg-purple-darken rounded-t-lg w-full divide-x divide-white">
          <tr>
            <th scope="col" class=" px-4 py-4 w-1/3 text-left text-normal font-bold text-white">
              Transaction</th>
            <th scope="col" class=" px-4 py-4 w-1/3 text-left text-normal font-bold text-white">Type
            </th>
            <th scope="col" class=" px-4 py-4 w-1/3 text-left text-normal font-bold text-white">Count</th>
            <!-- <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
            </th> -->
          </tr>
        </thead>

        <tbody class="divide-gray-200 bg-white divide-x divide-y ">
          <tr v-for="transaction in filterLists" :key="transaction.id">
            <td class="whitespace-nowrap py-4 pl-4 px-3 text-left text-sm ">
              {{ transaction.id }}
            </td>

            <td class="whitespace-nowrap py-4 pl-4 px-3 text-left text-sm ">
              <select
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                v-model="transaction.direction">
                <option v-for="option in options" :value="option.value" :key="option.index">
                  {{ option.text }}
                </option>
              </select>
            </td>

            <td class="whitespace-nowrap py-4 pl-4 px-3 text-left text-sm">
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
import { ChevronRightIcon, HomeIcon } from "@heroicons/vue/solid";
import { postAsNativeForm } from "../../api";
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import moment from 'moment'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800'
}

const pages = [
  { name: "Transactions", href: "/admin/transactions?status=60", current: false },
  {
    name: "Bulk Print Label",
    href: "#",
    current: true,
  },
];

const options = [
  { text: 'To', value: 'to' },
  { text: 'From', value: 'from' },
];

export default {
  created: function () {
    this.moment = moment
  },
  components: {
    AppLayout,
    flatPickr,
    ChevronRightIcon,
    HomeIcon
  },
  props: {
    notifications: Array,
    transactions: Object,
    navigation: Array,
    trans: Array,
    store_without_address: Object,
  },
  setup({ navigation, transactions }) {
    const loading = false
    const notifications = notifications
    const filterLists = ref(transactions)
    const shipDate = ref(moment(new Date()).format('YYYY-MM-DD'))
    console.log(true);


    function sendAction() {
      let params = {
        shipping_date: shipDate.value,
        transactions: JSON.stringify(filterLists.value),
        action: 'label',
        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
      let action = '/admin/transactions/bulk-print-action';
      postAsNativeForm(action, params);

      // let form  = document.createElement('form');
      // form.setAttribute('method', 'post');
      // form.setAttribute('action', '/admin/transactions/bulk-print-action');
      // for (let key in params) {
      //     if (params.hasOwnProperty(key)) {
      //         let hiddenField = document.createElement('input');
      //         hiddenField.setAttribute('type', 'hidden');
      //         hiddenField.setAttribute('name', key);
      //         hiddenField.setAttribute('value', params[key]);
      //         form.appendChild(hiddenField);
      //     }
      // }
      //
      // document.body.appendChild(form);
      // form.submit();
    }


    return {
      loading,
      transactions,
      statusStyles,
      filterLists,
      sendAction,
      options,
      shipDate,
      pages
    }
  }
}
</script>

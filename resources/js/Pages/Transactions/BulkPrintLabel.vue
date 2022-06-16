<template>
  <!-- Page header -->
  <app-layout :navigation="navigation">

    <div id="container" class="flex flex-col mx-3">
      
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

      <div class="bg-red-700">
          <h5></h5>
          <ul>
            <li>
                <a class="py-1 my-1 px-3 flex justify-between text-white" href="/admin/transactions?status=60"><span>Pending Kit Request</span></a>
            </li>
            <li>
                <a class="py-1 my-1 px-3 flex justify-between " href="/admin/transactions?status=60"><span>Pending Kit Request</span></a>
            </li>

          </ul>
      </div>



      <table class="w-full divide-y mt-2 divide-gray-300">

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
import { postAsNativeForm } from "../../api";
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import moment from 'moment'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800'
}

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
    flatPickr
  },
  props: {
    notifications: Array,
    transactions: Object,
    navigation: Array,
    trans: Array
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
      shipDate
    }
  }
}
</script>

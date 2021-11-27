<template>
  <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <p class="text-2xl font-semibold text-blue-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                      <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                      <span class="sr-only">Settings</span>
                    </a>
                  </div>
                </li>
                <li v-for="page in pages" :key="page.name">
                  <div class="flex items-center">
                    <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                    <a :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="page.current ? 'page' : undefined">{{ page.name }}</a>
                  </div>
                </li>
              </ol>
            </nav>
             <div class="flex-1 flex flex-col xl:overflow-hidden lg:flex-row mt-5 px-4 lg:px-0">
            <!-- Secondary sidebar -->
            <Nav page="Remittance"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto overflow-x-scroll">
                <div class="w-auto  lg:ml-7 lg:mr-2">
                    <div class="p-4 md:p-8 pb-20 bg-white rounded-md mb-6 w-max md:w-full">
                        <h2 class="font-bold">Bank Information</h2>
                        <p class="text-gray-600">Enter your bank account details to receive your remittance via transfer.</p>
                        <div class="flex flex-col items-center" v-if="account_detail.length==0">
                            <p class="mt-8 mb-6 text-gray-600" >No bank details added yet  </p>
                            <button type="button" class=" h-12 rounded-md border border-transparent shadow-sm px-8 py-3 bg-indigo-600 text-base text-white hover:bg-indigo-700  sm:text-sm" @click="this.popModal=true">Add Account Details</button>
                        </div>
                        <div v-else class="mt-9">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="">
                                <tr>
                                    <th scope="col" class="pr-2 py-1 w-1/4 text-left font-normal text-base  text-gray-500  tracking-wider">
                                    Bank Name
                                    </th>
                                    <th scope="col" class="px-2 py-1 w-1/4 text-left font-normal text-base  text-gray-500  tracking-wider">
                                    Account Number
                                    </th>
                                    <th scope="col" class="px-2 py-1 w-1/4 text-left font-normal text-base  text-gray-500  tracking-wider">
                                    Account Name
                                    </th>
                                    
                                    <th scope="col" class="relative px-2 py-1">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(account) in account_detail" :key="account.email" class="bg-white">
                                    <td class="pr-2 py-1 w-1/4 font-semibold">
                                    {{ account.name }}
                                    </td>
                                    <td class="px-2 py-1 w-1/4 font-semibold ">
                                    {{ account.title }}
                                    </td>
                                    <td class="px-2 py-1 w-1/4 font-semibold ">
                                    {{ account.email }}
                                    </td>
                                    <td class="px-2 py-1">
                                        <div class="flex"> 
                                            <pencil-icon class="h-8 w-8 p-2 mr-6 text-indigo-600 cursor-pointer"/>
                                            <trash-icon class="h-8 w-8 p-2 text-red-500 cursor-pointer"/>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <remittance-modal @close="this.popModal = false"  v-if="this.popModal"/>
            </div>
      </div>
  </app-layout>
</template>

<script>

import AppLayout from '../../../Layouts/AppLayout.vue'
import Nav from '../Nav';
import { ChevronLeftIcon,ChevronRightIcon, } from '@heroicons/vue/solid'
import {QuestionMarkCircleIcon,ChevronDownIcon,ChevronUpIcon,HomeIcon,PencilIcon,TrashIcon} from '@heroicons/vue/outline'
import RemittanceModal from './Components/RemittanceModal.vue'
import { reactive, ref } from '@vue/reactivity';
const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Remittance', href: '/settings/remittance', current: true },
]
export default {
    components:{
         Nav,
        AppLayout,
        HomeIcon,
        ChevronLeftIcon, 
        ChevronDownIcon,
        ChevronUpIcon,
        ChevronRightIcon,
        RemittanceModal ,
        PencilIcon,
        TrashIcon
    },
    data(){
        return{
            popModal:false
        }
    },
    
    setup(){
        const account_detail = [
            { name: 'Access Bank', title: '01000434236', email: 'Opeyemi John' },
        ]
        //const account_detail = reactive({bank_name:'Access Bank', account_number:'01000434236',account_name:'Opeyemi John'})
        return{
            pages,
            //people,
            account_detail
        }
    }
}
</script>


<style>
</style>
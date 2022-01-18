<template>
  <!-- FONT AWESOME LINK -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <!-- FONT AWESOME LINK --> 
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
                      <div>
                <div class="flex justify-between ">
                    <div>
                        <p class="text-2xl font-bold">Bank Information</p>
                        <p class="text-gray-400 text-sm mt-4">Enter your bank account details to receive payments via transfer</p>
                    </div>
                    <inertia-link href="remittance">
                      <x-icon class="h-6 w-6 cursor-pointer"/>
                    </inertia-link>
                </div>
                <div class="mt-3 sm:mt-5">
                  <div class=" required w-full mb-4 relative">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Bank Name
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.bank_name" required/>
                      <error-icon class="absolute top-11 right-2.5" v-show="bank_name_error"/>
                    </div>
                  <div class=" required w-full mb-4 relative">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Account Name
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.account_name" required/>
                      <error-icon class="absolute top-11 right-2.5" v-show="account_name_error"/>
                    </div>
                  <div class=" required w-full mb-4 relative">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Account Number
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.account_number" required/>
                      <error-icon class="absolute top-11 right-2.5" v-show="account_number_error"/>
                  </div>
                  <div class=" required w-full mb-4 relative">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Routing Number
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.routing_number" required/>
                      <error-icon class="absolute top-11 right-2.5" v-show="routing_error"/>
                  </div>
                  <div class="required w-1/3 mb-4">
                     <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Payment Frequency
                      </label>
                    <div class="flex items-center justify-between">
                        <div class=" items-center">
                            <input type="radio" value="0"  class="mr-3" v-model="payment.payout_schedule" name="daily">
                            <label for="daily" @click="payment.payout_schedule ='0'" class="cursor-pointer"> Daily</label>
                        </div>
                        
                        <div class=" items-center">
                            <input type="radio" class="mr-3" value="1" v-model="payment.payout_schedule" name="weekly">
                            <label for="weekly" @click="payment.payout_schedule='1'" class="cursor-pointer"> Weekly</label>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex justify-between">
                  <div></div>
                  <button type="button" class="rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base disabled:bg-gray-400 font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" :disabled='loading' @click="submit">
                    <i class="fas fa-spinner fa-pulse text-white m-1" v-if="loading"></i>{{edit}}
                  </button>
                <NotificationGroup group="top" position="top" >
                <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                    <div class="w-full max-w-sm">
                    <Notification
                        v-slot="{ notifications, close }"
                        enter="transform ease-out duration-300 transition"
                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                        leave="transition ease-in duration-500"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                        move="transition duration-500"
                        move-delay="delay-300"
                    >
                        <div
                        class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                        v-for="notification in notifications"
                        :key="notification.id"
                        >
                        <div class="p-4">
                            <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="font-semibold text-gray-800">{{ notification.title }}</p>
                                <p class="text-sm font-semibold text-gray-500">{{ notification.text }}</p>
                            </div>
                            <div class="flex flex-shrink-0 ml-4">
                                <button @click="close(notification.id)" class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </Notification>
                    </div>
                </div>
                </NotificationGroup>

                <NotificationGroup group="bottom" position="top">
                <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                    <div class="w-full max-w-sm">
                    <Notification
                        v-slot="{ notifications }"
                        enter="transform ease-out duration-300 transition"
                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                        leave="transition ease-in duration-500"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                        move="transition duration-500"
                        move-delay="delay-300"
                    >
                        <div
                        class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
                        v-for="notification in notifications"
                        :key="notification.id"
                        >
                        <div class="flex items-center justify-center w-12 bg-red-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"
                            ></path>
                            </svg>
                        </div>

                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                            <span class="font-semibold text-red-500">{{notification.title}}</span>
                            <p class="text-sm text-gray-600">{{notification.text}}</p>
                            </div>
                        </div>
                        </div>
                    </Notification>
                    </div>
                </div>
                </NotificationGroup>
              </div>
              </div>
                 </div>
               </div>
             </div>
          </div>

  </app-layout>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'
import Nav from '../Nav';
import { ChevronLeftIcon,ChevronRightIcon, } from '@heroicons/vue/solid'
import {QuestionMarkCircleIcon,ChevronDownIcon,ChevronUpIcon,HomeIcon,PencilIcon,TrashIcon} from '@heroicons/vue/outline'
import { ref, reactive, onBeforeMount } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import{XIcon} from '@heroicons/vue/solid'
import axios from 'axios'
//import { Inertia } from '@inertiajs/inertia'
import ErrorIcon from '../../../../assets/ErrorIcon.vue'
import { hrefToUrl } from '@inertiajs/inertia'
import { notify } from "notiwind"

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Remittance', href: '/settings/remittance', current: true },
]
export default {
  emits:['close'],
    props:{
      store:Object,
      remittance:Object
    },
  components: {
    AppLayout,
    Dialog,
    DialogOverlay,
           Nav,
        HomeIcon,
        ChevronLeftIcon, 
        ChevronDownIcon,
        ChevronUpIcon,
        ChevronRightIcon,
    DialogTitle,
    TransitionChild,
    XIcon,
    TransitionRoot,
    ErrorIcon,
  },
  setup({store,remittance},{emit}) {
    const open = ref(true)
    const payment = reactive({
          account_name:remittance.account_name,
          bank_name:remittance.bank_name,
          account_number:remittance.account_number,
          routing_number:remittance.routing_number,
          payout_schedule:remittance.payout_schedule,
    })
    const bank_name_error=ref(false)
    const account_name_error=ref(false)
    const account_number_error=ref(false)
    const routing_error=ref(false)
    const successMessage = ref('')
    const edit = ref('Save Changes')
    const loading=ref(false)
    const loadingFn =()=>{
      loading.value = false
      edit.value = "Save Changes"
      closeModal()
      window.location.href = '/settings/remittance'
    }
    function errorFn() {
      edit.value='Save Changes';
      loading.value=false;
    }

    function onClickTop() {
      notify({
          group: "top",
          title: "Success",
          text: successMessage.value
      }, 4000)
    }
    function onClickBot() {
      notify({
        group: "bottom",
        title: "Error",
        text: successMessage.value
      }, 4000)
    }
    
    const submit=()=>{
      //validation
      edit.value = 'Saving Changes'
      loading.value=true
      if(!payment.account_name.length){
        setTimeout(account_name_error.value=true,2500)
        setTimeout(errorFn(),3000)
      }
      if(!payment.bank_name.length){
        setTimeout(bank_name_error.value=true,2500)
        setTimeout(errorFn(),3000)
      }
      if (!payment.account_number) {
        setTimeout(account_number_error.value=true,2500)
        setTimeout(errorFn(),3000)
      }
      if (!payment.routing_number.length&&store.country_id==1){
        setTimeout(routing_error.value=true,2500)
        setTimeout(errorFn(),3000)
      }
      else{
        axios.patch(`/settings/remittance/${remittance.id}`,payment).then((res)=>{
          if(res.status==200){
            successMessage.value=res.data.message
            onClickTop()
            setTimeout(loadingFn,3000)
          }else if(res.status == 422 ){
            successMessage.value=res.data.message
            onClickBot()
            setTimeout(errorFn(),3000)
          }else{
            successMessage.value="Database Error"
            onClickBot()
            setTimeout(errorFn(),3000)
          }
          
        })   
      }
    }
    const closeModal=()=>{
      open.value=false
      emit('close')
    }

    return {
      open,
      payment,
      closeModal,
      submit,
      loading,
      successMessage,
      account_name_error,
      account_number_error,
      bank_name_error,
      routing_error,
      pages,
      edit,
      onClickTop,
      onClickBot

    }
  }
}
</script>

<style>
</style>

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
                      <div>
                <div class="flex justify-between ">
                    <div>
                        <p class="text-2xl font-bold">Bank Information</p>
                        <p class="text-gray-400 text-sm mt-4">Enter your bank account details to receive payments via transfer</p>
                    </div>
                    <x-icon class="h-6 w-6 cursor-pointer" @click="closeModal"/>
                </div>
                <error v-if="error" :msg="successMessage" class=" w-full z-30" />
                <success v-if="success" :msg="successMessage" class="w-full z-30"/>
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
                  <button type="button" class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" :disabled='loading' @click="submit">
                    <i class="fas fa-spinner fa-pulse text-white m-1" v-if="loading"></i>{{edit}}
                  </button>
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
import Success from '../../../Components/Success.vue'
import Error from '../../../Components/Error.vue'
import ErrorIcon from '../../../../assets/ErrorIcon.vue'
import { hrefToUrl } from '@inertiajs/inertia'
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
    Success,
    Error,
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
    const success = ref(false)
    const error = ref(false)
    const bank_name_error=ref(false)
    const account_name_error=ref(false)
    const account_number_error=ref(false)
    const routing_error=ref(false)
    const successMessage = ref('')
    const edit = ref('Edit Changes')
    const loading=ref(false)
    const loadingFn =()=>{
      loading.value = false
      success.value= false
      edit.value = "Edit Changes"
      closeModal()
      window.location.href = '/settings/remittance'
    }
    function errorFn() {
      console.log("errofn");
      edit.value='Edit Changes';
      loading.value=false;
      error.value=false;
    }
    const saving=()=>{
      success.value = true
    }
    const submit=()=>{
      //validation
      edit.value = 'Editing Changes'
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
        console.log("object")
        axios.patch(`/settings/remittance/${remittance.id}`,payment).then((res)=>{
          console.log(res.status)
          if(res.status==200){
            successMessage.value=res.data.message
            setTimeout(saving, 2000)
            setTimeout(loadingFn,3000)
          }else if(res.status == 422 ){
            console.log('F off')
            successMessage.value=res.data.message
            setTimeout(error.value= true,2000)
            setTimeout(errorFn(),3000)
          }else{
            successMessage.value="Database Error"
            setTimeout(error.value = true,2000)
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
      success,
      successMessage,
      error,
      account_name_error,
      account_number_error,
      bank_name_error,
      routing_error,
      pages,
      edit

    }
  }
}
</script>

<style>
</style>

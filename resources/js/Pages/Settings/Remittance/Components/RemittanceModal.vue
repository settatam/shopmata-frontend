<template>
<!-- FONT AWESOME LINK -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <!-- FONT AWESOME LINK -->
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto " @close="closeModal()">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-2 sm:align-middle sm:max-w-xl sm:w-full sm:p-6">
              <div>
                <div class="flex justify-between ">
                    <div>
                        <p class="text-2xl font-bold">Add Account Details</p>
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
              <div class=" flex justify-between">
                <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                  Cancel
                </button>
                <button type="button" class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" :disabled='loading' @click="submit">
                  <i class="fas fa-spinner fa-pulse text-white m-1" v-if="loading"></i>{{save}}
                </button>
              </div>
            </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref, reactive, onBeforeMount } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import{XIcon} from '@heroicons/vue/solid'
import axios from 'axios'
//import { Inertia } from '@inertiajs/inertia'
import Success from '../../../../Components/Success.vue'
import Error from '../../../../Components/Error.vue'
import ErrorIcon from '../../../../../assets/ErrorIcon.vue'
import { hrefToUrl } from '@inertiajs/inertia'

export default {
    emits:['close'],
    props:{
      store:Object
    },
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    XIcon,
    TransitionRoot,
    Success,
    Error,
    ErrorIcon
  },
  setup(props,{emit}) {
    const open = ref(true)
    const payment = reactive({
          account_name:"",
          bank_name:"",
          account_number:"",
          routing_number:"",
          payout_schedule:"1",
    })
    const success = ref(false)
    const error = ref(false)
    const bank_name_error=ref(false)
    const account_name_error=ref(false)
    const account_number_error=ref(false)
    const routing_error=ref(false)
    const successMessage = ref('')
    const save = ref('Save')
    const loading=ref(false)
    const loadingFn =()=>{
      loading.value = false
      success.value= false
      save.value = "Save"
      closeModal()
      window.location.href = '/settings/remittance'
    }
    const errorFn =()=>{
      loading.value = false
      error.value= false
      save.value = "Save"
    }
    const saving=()=>{
      success.value = true
    }
    const submit=()=>{
      //validation
      save.value = "Saving"
      loading.value=true
      if(!payment.account_name.length){
        setTimeout(account_name_error.value=true,2500)
        setTimeout(errorFn,3000)
      }
      if(!payment.bank_name.length){
        setTimeout(bank_name_error.value=true,2500)
        setTimeout(errorFn,3000)
      }
      if (!payment.account_number) {
        setTimeout(account_number_error.value=true,2500)
        setTimeout(errorFn,3000)
      }
      if (!payment.routing_number.length&&store.country_id==1){
        setTimeout(routing_error.value=true,2500)
        setTimeout(errorFn,3000)
      }
      else{
        axios.post('',payment).then((res)=>{
          if(res.status==200){
            successMessage.value=res.data.message
            setTimeout(saving, 2000)
            setTimeout(loadingFn,3000)
          }else if(res.status==422){
            successMessage.value=res.data.message
            setTimeout(error.value= true,2000)
            setTimeout(errorFn,3000)
          }else{
            successMessage.value="Database Error"
            setTimeout(error.value = true,2000)
            setTimeout(errorFn,3000)
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
      save,
      success,
      successMessage,
      error,
      account_name_error,
      account_number_error,
      bank_name_error,
      routing_error

    }
  }
}
</script>
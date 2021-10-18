<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto " @close="open = false">
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
                <div class="mt-3 sm:mt-5">
                  <div class=" required w-full mb-4">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Bank Name
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.bank_name" required/>
                    </div>
                  <div class=" required w-full mb-4">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Account Name
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.account_name" required/>
                    </div>
                  <div class=" required w-full mb-4">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Account Number
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="payment.account_number" required/>
                    </div>
                </div>
              </div>
              <div class=" flex justify-between">
                <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                  Cancel
                </button>
                <button type="button" class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                  Save
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


export default {
    emits:['close'],
    
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    XIcon,
    TransitionRoot,
  },
  data(){
    
  },
  methods:{
      closeModal(){
          this.open = false
           this.$emit('close')
      },
      
  },
  mounted(){
   
  },
  setup() {
    const open = ref(true)
    
    const payment = reactive({
          account_name:"",
          bank_name:"",
          account_number:"",
      })

    return {
      open,
      payment,
      
    }
  }
}
</script>
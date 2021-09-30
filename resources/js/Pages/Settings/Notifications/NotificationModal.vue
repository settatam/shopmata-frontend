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
          <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6">
            <div>
              <div class="flex justify-between ">
                  <div>
                      <p class="text-2xl font-bold">Notification</p>
                      <p class="text-gray-400 text-sm mt-4">Set Notification Messages</p>
                  </div>
                  <x-icon class="h-6 w-6 cursor-pointer" @click="closeModal"/>
              </div>
              <div class="mt-3 sm:mt-5">
                <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-bold mb-2 bg-transparent">
                      {{modalTitle}}
                    </label>
                    <textarea type="text" placeholder="Type your notification message here" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md" v-model="modalContent" required/>
                  </div>
              </div>
            </div>
            <div class=" flex justify-end">
              <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                Cancel
              </button>
              <button type="button" class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="submit">
                Send
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { reactive, ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import{XIcon} from '@heroicons/vue/solid'
//import { Inertia } from '@inertiajs/inertia'


export default {
    emits:['close'],
    props:['modalTitle','modalContent'],
    
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    XIcon,
    TransitionRoot,
  },
  methods:{
      closeModal(){
           this.$emit('close')
      }
  },
  setup() {
    const open = ref(true)
    return {
      open
    }
  }
}
</script>
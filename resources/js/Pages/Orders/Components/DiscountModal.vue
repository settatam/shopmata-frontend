<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" auto-reopen="true" class="fixed z-10 inset-0 overflow-y-auto" @close="emitClose()">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xlg sm:w-full sm:p-6">
           <div>
                <div class="flex justify-between">
                    <h2>Add Discount</h2>
                    <XIcon class="w-5 h-5 cursor-pointer" @click="emitClose()"/>
                </div>
              <div class=" mt-3 -mx-6"></div>
              <div>
                <p class="">Discount this order by</p>
                <div class="flex justify-between mt-2">
                  <button class="h-10 w-14 border border-gray-300 rounded" @click="openCash">$</button>
                  <button class="h-10 w-14 border border-gray-300 rounded" @click="openPercent">%</button>
                  <input type="text" name="" placeholder="$" class="border border-gray-300 rounded w-7/10" v-if="inputCash">
                  <input type="text" name="" placeholder="%" class="border border-gray-300 rounded w-7/10" v-else>
                </div>
              </div>
              <div class="mt-6">
                <p>Reason</p>
                <input type="text" name="" class="w-full border border-gray-300 rounded  mt-2" placeholder="damged goods, black friday......">
              </div>
            </div>
              <div class=" mt-3 -mx-6"></div>
            <div class="mt-5 flex justify-between">
              <button type="button" class="mt-3 w-20 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="emitClose()" ref="cancelButtonRef">
                Close
              </button>
              <button type="button" class="inline-flex w-20 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="open = false">
                Apply
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'

export default {
  emits: ['emitClose'],
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XIcon,
  },
  data(){
    return{
      inputCash:true,
    }
  },
  methods:{
    emitClose(){
      this.open = false
      this.$emit('emitClose')
    },
    openCash(){
      this.inputCash=true
    },
    openPercent(){
      this.inputCash=false
    }
  },
  setup() {
    const open = ref(true)

    return {
      open,
    }
  },
}
</script>
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" auto-reopen="true" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg px-9 pt-8 pb-4  overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  sm:w-4.5/10">
            <div>
              <div class="mx-auto flex  justify-between">
                  <p class="text-xl">Select Products</p>
                  <XIcon class="w-4 h-4 cursor-pointer" @click="open=false"/>
              </div>
              <div class="-mr-9 mt-4 -ml-9 border-b-2 border-gray-200"></div>
              <div class="mt-7">
                <p class="font-semibold mt-0.5 text-left">You haven’t added any products yet.</p>
                <div class="mt-2">
                  <p class="text-left text-gray-400">
                   <span class="text-cyan-500 cursor-pointer" @click="Hi">Add a product</span> to ShopMata before creating an order
                  </p>
                </div>
              </div>
            </div>
            <div class=" mt-64 sm:mt-72">
              <button type="button" class="inline-flex justify-center rounded-md border border-cyan-500 shadow-sm px-4 py-2 bg-transparent text-cyan-500 sm:text-sm" @click="open = false">
                Add to Order
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
import { CheckIcon,XIcon } from '@heroicons/vue/outline'

export default {
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    CheckIcon,
    XIcon
  },
  setup() {
    const open = ref(true)

    return {
      open,
    }
  },
}
</script>
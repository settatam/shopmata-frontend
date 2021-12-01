<!-- This example requires Tailwind CSS v2.0+ -->
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
                      <p class="text-2xl font-bold">{{title}}</p>
                  </div>
                  <x-icon class="h-6 w-6 cursor-pointer" @click="closeModal"/>
              </div>
              <div class="border-t border-gray-300 mt-1.5 mb-6 -mx-6"></div>
                <div class="mt-3 sm:mt-5">
                  <div class="w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Menu Title
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="enter a menu title" v-model="menu.name" required/>
                  </div>
                  <div class="w-full mb-4 mt-6">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Handle 
                    </label>
                    <div class="relative">
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="menu.handle" required/>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                      <QuestionMarkCircleIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                    </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-6 flex justify-end">
              <button type="button" class="items-centerrounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-700 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="submit">
                {{buttonMsg}}
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref, reactive } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import{XIcon} from '@heroicons/vue/solid'
import { QuestionMarkCircleIcon } from '@heroicons/vue/outline';
import { Inertia } from '@inertiajs/inertia'


export default {
    emits:['close'],
    props:['title','buttonMsg'],
  
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    QuestionMarkCircleIcon,
    XIcon,
    TransitionRoot,
  },
  methods:{
      closeModal(){
          this.open = false
          this.$emit('close')
      }
  },
  setup(props, context) {
    const open = ref(true)
    const menu = {
          name:"",
          handle: "",
          // is_ajax: 1
    }

    function submit() {
         try {
        Inertia.post('/online-store/navigation', menu)
        context.emit('close')
        
      } catch (error) {
        console.log(error)
        
      }
      }

    return {
      open,
      menu,
      submit
    }
  }
}
</script>
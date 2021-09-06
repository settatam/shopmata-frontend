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
          <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xlg sm:w-full sm:p-6">
            <div>
                <div class="flex justify-between">
                    <h2>Add Shipping</h2>
                    <XIcon class="w-5 h-5" @click="emitClose()"/>
                </div>
              <div class=" mt-3 -mx-6"></div>
              <RadioGroup v-model="selected">
                <RadioGroupLabel class="sr-only">
                  Privacy setting
                </RadioGroupLabel>
                <div class="bg-white rounded-md -space-y-px">
                  <RadioGroupOption as="template" v-for="(setting, settingIdx) in settings" :key="setting.name" :value="setting" v-slot="{ checked, active }">
                    <div :class="[settingIdx === 0 ? 'rounded-tl-md rounded-tr-md' : '', settingIdx === settings.length - 1 ? 'rounded-bl-md rounded-br-md' : '', checked ? ' border-indigo-200 z-10' :'', 'relative  p-4 flex cursor-pointer focus:outline-none']">
                      <span :class="[checked ? 'bg-indigo-600 border-transparent' : 'bg-white border-gray-300', active ? 'ring-2 ring-offset-2 ring-indigo-500' : '', 'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center']" aria-hidden="true">
                        <span class="rounded-full bg-white w-1.5 h-1.5" />
                      </span>
                      <div class="ml-3 flex flex-col">
                        <RadioGroupLabel as="span" :class="[checked ? 'text-indigo-900' : 'text-gray-900', 'block text-sm font-medium']">
                          {{ setting.name }}
                        </RadioGroupLabel>
                        <RadioGroupDescription as="span" :class="[checked ? 'text-indigo-700' : 'text-gray-500', 'block text-sm']">
                          {{ setting.description }}
                        </RadioGroupDescription>
                      </div>
                    </div>
                  </RadioGroupOption>
              </div>
              </RadioGroup>
            </div>
            <div class="flex justify-between">
              <input type="text" name="" v-model="text" class="w-6.5/10 border border-gray-300 rounded text-xs" placeholder="custom rate name">
              <input type="text" name="" class="w-3/10 border border-gray-300 rounded text-xs" placeholder="$ 0">
            </div>
            <div class="mt-5 flex justify-between">
              <button type="button" class="inline-flex w-20 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="open = false">
                Apply
              </button>
              <button type="button" class="mt-3 w-20 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="emitClose()" ref="cancelButtonRef">
                Close
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
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot, RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'

const settings = [
  { name: 'Free Shipping', description: '' },
  { name: 'Custom', description: '' },
]

export default {
  props:['selected'],
  emits: ['emitClose'],
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XIcon,
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
  },
  data(){
    return{
      text:''
    }
  },
  methods:{
    emitClose(){
      this.open = false
      this.$emit('emitClose')
    }
  },
  setup() {
    const open = ref(true)
    const selected = ref(settings[0])
    return {
      open,
      settings,
      selected,
    }
  },
}
</script>
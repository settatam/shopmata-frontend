<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0  " @close="closeModal()">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6">
            <div>
              <div class="flex justify-between ">
                  <div>
                      <p class="text-2xl font-bold">{{title}}
                        <Tooltip v-show="title=='Invite Staff'" :tooltipText="'Create new role or change existing role'">
                            <question-mark-circle-icon class="w-5 h-5 ml-1 cursor-pointer" />
                        </Tooltip>
                      </p>
                      <p class="text-gray-400 text-sm mt-4" v-show="title=='Invite Staff'">Give people access to this site and assign them roles.</p>
                  </div>
                  <x-icon class="h-6 w-6 cursor-pointer" @click="closeModal"/>
              </div>
              <div class="border-t border-gray-300 mt-6 mb-6 -mx-6"></div>
              <div class="mt-3 sm:mt-5">
                <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Email <span class="text-red-500">*</span>
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="jason@shopmata.com" v-model="invite.email" required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      User Roles <span class="text-red-500">*</span>
                    </label>
                    <select  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  v-model="invite.role_id" required>
                      <option v-for="(role,index) in groups" :key="index" :value="role.id">{{role.name}}</option>
                    </select>
                  </div>
                
              </div>
            </div>
            <div class="mt-5 sm:mt-6">
              <button type="button" class="flex justify-center align-middle items-centerrounded-md border border-transparent shadow-sm mx-auto px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="submit(this.user_id)">
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
import { reactive, ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import{XIcon} from '@heroicons/vue/solid'
import { Inertia } from '@inertiajs/inertia'
import {QuestionMarkCircleIcon} from '@heroicons/vue/outline'
import axios from 'axios'
import Tooltip from "../../../../Components/Tooltip/Components/Tooltip.vue";


export default {
    emits:['close'],
    props:['groups','title','buttonMsg','user_id','user_email'],
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    XIcon,
    TransitionRoot,
    Tooltip,
    QuestionMarkCircleIcon
  },
  methods:{
      submit(id){
        if(this.title=='Invite Staff'){
          Inertia.post('plan-and-permissions/staffs/invite',this.invite)
          this.$emit('close')
          this.open = false
        }else{
          console.log(id)
          axios.patch(`/settings/store-users/${id}`)
          this.$emit('close')
          this.open = false
        }

      },
      closeModal(){
          this.open = false
           this.$emit('close')
      }
  },
  setup(props) {
    const open = ref(true)
    const invite = reactive({email:props.user_email,role_id:1})
    return {
      open,
      invite
    }
  }
}
</script>
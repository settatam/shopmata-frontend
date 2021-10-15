<template>
    <app-layout>
      <!-- Breadcrumb -->
       <div class="flex-shrink-0 px-8 py-4 flex items-center">
          <p class="text-2xl font-semibold text-blue-gray-900">Online Store</p>
       </div>
        <nav class="flex px-8" aria-label="Breadcrumb">
          <ol role="list" class="flex items-center space-x-4">
            <li>
              <div>
                <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                  <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                  <span class="sr-only">Online Store</span>
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
  
        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
            <div class="flex items-center justify-center flex-1 xl:overflow-y-auto">
              <div class="w-2/3 mt-5 bg-white card">
                <div class="p-8">
                  <div class="flex justify-between">
                    <h1 class="text-2xl font-semibold mb-4.5">Menu Lists</h1>
                    <div class="text-indigo-600 cursor-pointer">
                      <p @click="addMenu" class="underline flex cursor-pointer"><span class="pl-3"><PlusIcon class="w-5 h-5" /></span>Add Menu</p>
                    </div>
                  </div>
                    <p> In this section, you can create your menu and adjust your menu settings to reflect your design, tap the button below to begin. You can ( Create menu)  or Edit menu</p>
                    <div class="w-full mt-6">
                      <table class="w-full divide-y divide-gray-200 table-fixed">
                        <thead class="">
                          <tr> 
                            <th scope="col" class="text-left text-sm font-medium text-gray-500 tracking-wider">
                                Menu Title
                            </th>
                            <th scope="col" class="text-left text-sm font-medium text-gray-500 tracking-wider">
                                Menu Items
                            </th>
                            <th scope="col" class="relative py-3">
                              <span class="sr-only"></span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" v-if="menu.length">
                          <tr class="bg-white" v-for="m in menu" :key="m.id">
                            <inertia-link :href="'/online-store/navigation/'+m.id" class="">
                              <td class="py-4 text-right whitespace-pre-wrap text-sm text-gray-500">
                                  <p class="text-indigo-700 text-left text-sm font-semibold "> {{ m.name }} </p>  
                              </td>
                            </inertia-link>
                              <td class="py-4 whitespace-pre-wrap text-sm text-gray-500" >
                                <span v-for="item in m.items" :key="item.id" class="text-gray-800 text-left "> {{ item.name }}, </span>  
                              </td>
                        
                            <td class="px-6 py-4 text-right text-sm text-gray-500 relative">                              
                              <DotsHorizontalIcon class="w-6 h-6 cursor-pointer relative ml-auto" @click="openSubMenu(m.id)"/>
                              <div class="absolute top-12 -right-8 z-10 w-56  rounded-sm border border-gray-50 bg-white shadow-2xl px-7 py-5" v-show="currentRow==m.id && openSub">
                                <div class="text-gray-900 group flex items-center px-4 py-2 text-sm align-middle cursor-pointer" @click="editRow(m.name)">
                                  <p class="text-gray-600">Rename Title</p>
                                </div>
                                <div href="#" class="text-gray-900 group flex items-center px-4 py-2 text-sm align-middle cursor-pointer" @click="deleteRow(m.id)">
                                  <p class="text-red-600">Delete Menu</p>
                                </div>
                              </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                     <div v-if="menu.length === 0">
                        <p class="ml-1 flex-shrink-0 font-normal text-gray-500">No menu items yet</p>
                      </div>
                  </div>
                  
                <div class="flex justify-center">
                  <button class="text-white bg-indigo-700 rounded-md px-8 py-3" @click="addMenu">Add Menu</button>
                   <add-menu-modal v-if="popModal" @close="this.popModal=false" :login="login" :title="title" :buttonMsg="buttonMsg" />
                </div>

                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->
    </app-layout>
</template>

<style>
 .card {
   min-height: 70vh;
 }
</style>

<script>

import { ref, reactive } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import SortableList from '../../../Components/SortableList.vue'
import SortableItem from '../../../Components/SortableItem.vue'
import AddMenuModal from './Components/AddMenuModal.vue'
import Search from '../../Search.vue'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronRightIcon, DotsHorizontalIcon } from '@heroicons/vue/solid';
import { PlusIcon } from '@heroicons/vue/solid';
import { HomeIcon } from '@heroicons/vue/outline';
import { Inertia } from '@inertiajs/inertia'

const pages = [
  { name: 'Online Store', href: '/online-store', current: false },
  { name: 'Navigation', href: '/online-store/navigation', current: true },
];

export default {
   props: {
    menu: Array
  },
   components: {
    AppLayout,
    Dialog, 
    DialogOverlay, 
    TransitionChild, 
    TransitionRoot, 
    ChevronRightIcon,
    DotsHorizontalIcon,
    PlusIcon,
    HomeIcon,
    SortableList,
    SortableItem,
    AddMenuModal
  },

   emits:['close'],
  data(){
      return{
        pages,
        openSub: false,
      }
  },

  methods: {
    openSubMenu(id){
      this.currentRow = id
      if (this.openSub==true) {
          this.openSub =false
      }else{
          this.openSub=true
      }
    },
    editRow(){
      this.popModal=true
      this.title = 'Rename Menu Title',
      this.buttonMsg='Save Changes'
    },
    deleteRow(id){
      this.deleteConfirmation = true
      this.open = true
      console.log(id)
    },
    emitClose(){
      this.openSub=false
      this.deleteConfirmation = false
    }
  },
  
  setup() {
    const open = ref(false)
    const popModal= ref(false)
    const selectAll = ref(false)
    const selected = ref([])
    const currentRow = ref(0)
    const buttonMsg = ref('Add New Menu List')

    const menu = {
      title: '',
      handle: '',
    }

    function addMenu() {
      popModal.value=true
      title.value = 'Add Menu'
      buttonMsg.value='Save Menu'
    }
    
    function submit() {
      Inertia.post('/online-store/navigation', menu);
    }

    return {
      // menu
      open,
      popModal,
      selectAll,
      selected,
      currentRow,
      buttonMsg,
      submit,
      addMenu
    }
  },

}
</script>


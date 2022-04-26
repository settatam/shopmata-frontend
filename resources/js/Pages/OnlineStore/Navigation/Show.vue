<template>
    <app-layout :navigation="navigation">
     <!-- Breadcrumb -->
       <div class="flex-shrink-0 px-8 py-4 flex items-center">
          <p class="text-2xl font-semibold text-gray-900">Online Store</p>
       </div>
        <nav class="flex px-8" aria-label="Breadcrumb">
          <ol role="list" class="flex items-center space-x-4">
            <li>
              <div>
                <a href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
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

        <div class="flex justify-between items-center mx-8 mt-8">
          <a href="/admin/online-store/navigation/" class="hover:text-gray-700">
            <div class="flex items-center">
              <ArrowLeftIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
              <h1 class="ml-4 text-2xl font-semibold">{{ menu.name }}</h1>
            </div>
          </a>
          <div class="">
            <button class="text-white bg-indigo-700 rounded-sm px-5 py-2" @click="addMenuItem()">Add Menu Item</button>
              <add-menu-items-modal v-if="openAddMenuItemModal" @close="this.openAddMenuItemModal=false" :groups="groups" :login="login" :title="title" :buttonMsg="buttonMsg" :menu="menu" />
          </div>
        </div>

          <!-- Main content -->
           <div class="flex-1 flex flex-col ">
            <div class="flex items-center justify-center flex-1">
              <div class="w-2/3 ml-7 mt-5">
                <div class="p-8 bg-white mb-4">
                  <h2 class="text-2xl font-semibold">Menu Title</h2>
                  <div class="flex items-center mt-2 mb-2 p-2 bg-white border sm:rounded-sm">
                    <h3 class="text-lg font-medium text-gray-500">{{ menu.name }}</h3>
                  </div>
                </div>
                <div>
                  <div class="w-full mb-4" v-if="menu.items.length">
                    <!-- <inertia-link href="/online-store/navigation/create">Create Another Menu List</inertia-link> -->
                    <div class="bg-white shadow sm:rounded-sm p-6">
                      <div class="flex items-center mb-3.5">
                        <h2 class="text-lg text-indigo-700 font-semibold mr-2">Menu Items</h2>
                        <QuestionMarkCircleIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                      </div>
                      <div>
                        <ul role="list" class="">
                          <li v-for="m in menu.items" :key="m.id">
                          <div class="flex items-center justify-between mt-1 mb-2 p-2 bg-white border sm:rounded-sm">
                            <inertia-link :href="'/admin/online-store/navigation/'+menu.id" class="block hover:bg-gray-50">
                              <div class="flex justify-between truncate">
                                <div class="flex text-sm">
                                  <p class="text-indigo-600 text-sm truncate">{{ m.name }}</p>
                                  <!-- <p class="font-normal text-gray-500">{{ m.link }}</p> -->
                                </div>
                              </div>
                            </inertia-link>
                            <div class="text-right relative text-gray-500">
                              <DotsHorizontalIcon class="relative w-6 h-6 cursor-pointer" @click="openSubMenu(m.id)" />
                              <div class="absolute top-12 -right-8 z-10 w-56 rounded-sm border border-gray-50 bg-white shadow-2xl px-7 py-2" v-show="currentRow==m.id && openSub">
                                <div href="#" class="text-gray-900 group flex items-center px-4 text-sm align-middle cursor-pointer" @click="deleteRow(m.id)">
                                  <p class="text-red-600">Delete Menu</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          </li>
                        </ul>
                        </div>
                      </div>

                  </div>
                  <div class="mb-4 text-center" v-else>
                    <h3>You do not have any menu items created.</h3>
                  </div>

                </div>
                </div>
            </div>
            </div>
    </app-layout>
</template>

<script>

import { ref, reactive } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronRightIcon, ArrowLeftIcon, DotsHorizontalIcon } from '@heroicons/vue/solid';
import { HomeIcon, QuestionMarkCircleIcon } from '@heroicons/vue/outline';
import { Inertia } from '@inertiajs/inertia'
import AddMenuItemsModal from './Components/AddMenuItemsModal.vue'

const pages = [
  { name: 'Online Store', href: '/admin/online-store', current: false },
  { name: 'Navigation', href: '/admin/online-store/navigation', current: false },
];

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
   props: {
       menu: Object,
       navigation: Array
  },

  components: {
    AddMenuItemsModal,
    AppLayout,
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    ArrowLeftIcon,
    ChevronRightIcon,
    DotsHorizontalIcon,
    HomeIcon,
    QuestionMarkCircleIcon
  },

  emits:['close'],

  data(){
      return{
        pages,
        openSub: false,
        currentRow: null,
        openAddMenuItemModal: false,
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
    addMenuItem(){
      this.openAddMenuItemModal=true
    },
    editRow(){
      this.popModal=true
      this.title = 'Rename Item',
      this.buttonMsg='Delete Menu'
    },
    deleteRow(id){
      this.deleteConfirmation = true
      this.open = true
      console.log(id)
    },
    emitClose(){
      this.openSub=false
      this.openAddMenuItemModal=false
      this.deleteConfirmation = false
    }
  },

  setup(props) {
    const open = ref(false)
    const list = {
      name: '',
      link: ''
    }
    const m = props.menu;

    pages.push(
      { name: m.name, href: (`/admin/online-store/navigation/${m.name}`), current: true },
    )

    function submit() {
      console.log("jnn")
      Inertia.post(`/admin/online-store/navigation/${m.id}`, list);
    }

    return {
      pages,
      // popModal,
      statusStyles,
      list,
      submit
    }
  },

}
</script>


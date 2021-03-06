<template>
        <button class="mb-4 border-r border-gray-200 text-gray-400 lg:hidden" @click="sidebarOpen = !sidebarOpen">
          <span class="sr-only">Open sidebar</span>
          <MenuAlt1Icon class="h-6 w-6" aria-hidden="true" />
        </button>
  <nav aria-label="Sections" v-if="sidebarOpen" class=" flex-shrink-0 w-full bg-white border-r mb-4 border-blue-gray-200">
      <div class="flex-1 min-h-0 overflow-y-auto">
          <inertia-link v-for="item in subNavigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-100 hover:bg-opacity-50', 'flex p-6 border-b border-blue-gray-200']" :aria-current="item.current ? 'page' : undefined">
            <component :is="item.icon" class="flex-shrink-0  h-6 w-6 text-indigo-700 my-auto" aria-hidden="true" />
              <div class="ml-3 text-sm">
                <p class="font-semibold text-gray-900 text-lg">{{ item.name }}</p>
                <p class="mt-1 text-gray-500">{{ item.description }}</p>
              </div>
            </inertia-link>
        </div>
    </nav>
    <nav aria-label="Sections" class="hidden flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 lg:w-80 xl:w-96 lg:flex lg:flex-col">
      <div class="flex-1 min-h-0 overflow-y-auto">
          <inertia-link v-for="item in subNavigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-100 hover:bg-opacity-50', 'flex p-6 border-b border-blue-gray-200']" :aria-current="item.current ? 'page' : undefined">
            <component :is="item.icon" class="flex-shrink-0  h-6 w-6 text-indigo-700 my-auto" aria-hidden="true" />
              <div class="ml-3 text-sm">
                <p class="font-semibold text-gray-900 text-lg">{{ item.name }}</p>
                <p class="mt-1 text-gray-500">{{ item.description }}</p>
              </div>
            </inertia-link>
        </div>
    </nav>
</template>

<script>

import { ref } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import axios from "axios"

import {
  BellIcon,
  BookmarkAltIcon,
  CashIcon,
  CogIcon,
  FireIcon,
  HomeIcon,
  InboxIcon,
  KeyIcon,
  MenuIcon,
  PhotographIcon,
  SearchCircleIcon,
  UserIcon,
  ViewGridAddIcon,
  XIcon,
  MenuAlt1Icon
} from '@heroicons/vue/outline'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon,InboxInIcon } from '@heroicons/vue/solid'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
  props: {
    page: String
  },

  components: {
    AppLayout,
    BellIcon,
    BookmarkAltIcon,
    CashIcon,
    CogIcon,
    FireIcon,
    HomeIcon,
    InboxIcon,
    KeyIcon,
    MenuIcon,
    PhotographIcon,
    SearchCircleIcon,
    UserIcon,
    ViewGridAddIcon,
    XIcon,
    InboxInIcon,
    ChevronLeftIcon,
    MenuAlt1Icon,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot
  },

  data() {
    return {
        subNavigation: [
        {
          name: 'General',
          description: 'View and update store details.',
          href: '/admin/settings/general',
          icon: CogIcon,
          current: this.page == 'General' ? true : false,
        },
        {
          name: 'Plans and Permissions',
          description: 'View plan information and manage what staff can see or do in your store.',
          href: '/admin/settings/plan-and-permissions',
          icon: CashIcon,
          current: this.page == 'Plans' ? true : false,
        },
        {
          name: 'Payments',
          description: 'Enable and manage your store’s payment providers.',
          href: '/admin/settings/payments',
          icon: KeyIcon,
          current: this.page == 'Payments' ? true : false,
        },
        {
          name: 'Remittance',
          description: 'To receive your remittance via transfer.',
          href: '/admin/settings/remittance',
          icon: InboxInIcon,
          current: this.page == 'Remittance' ? true : false,
        },
        {
          name: 'Shipping and Delivery',
          description: 'Manage how you ship orders to customers.',
          href: '/admin/settings/shipping-and-delivery',
          icon: PhotographIcon,
          current: this.page == 'Shipping' ? true : false,
        },
        {
          name: 'Notifications',
          description: 'Manage Notifications sent to you.',
          href: '/admin/settings/notifications',
          icon: BellIcon,
          current: this.page == 'Notifications' ? true : false,
        },
        {
          name: 'Gift Cards',
          description: 'Enable Apple Wallet passes and set gift card expiry dates.',
          href: '/admin/settings/gift-cards',
          icon: CashIcon,
          current: this.page == 'GiftCards' ? true : false,
        },


      ]
    }
  },
  setup() {
    const open = ref(false)
    const sidebarOpen = ref(false)
    return {
      statusStyles,
      sidebarOpen
    }
  },

}
</script>

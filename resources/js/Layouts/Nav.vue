<template>
  <nav aria-label="Sections" class="hidden flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col">
      <div class="flex-shrink-0 h-16 px-6 border-b border-blue-gray-200 flex items-center">
          <p class="text-lg font-medium text-gray-900">Settings</p>
      </div>
      <div class="flex-1 min-h-0 overflow-y-auto">
          <inertia-link v-for="item in subNavigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50', 'flex p-6 border-b border-blue-gray-200']" :aria-current="item.current ? 'page' : undefined">
            <component :is="item.icon" class="flex-shrink-0 -mt-0.5 h-6 w-6 text-blue-gray-400" aria-hidden="true" />
              <div class="ml-3 text-sm">
                <p class="font-medium text-gray-900">{{ item.name }}</p>
                <p class="mt-1 text-blue-gray-500">{{ item.description }}</p>
              </div>
            </inertia-link>
        </div>
    </nav>
</template>

<script>

import { ref } from 'vue'
import AppLayout from './AppLayout.vue'
import Search from '../Pages/Search.vue'
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
} from '@heroicons/vue/outline'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon } from '@heroicons/vue/solid'

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
    ChevronLeftIcon,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot
  },
  
  data() {
    return {
        subNavigation: [
        {
          name: 'General',
          description: 'View and update store details.',
          href: '/settings/general',
          icon: CogIcon,
          current: this.page == 'General' ? true : false,
        },
        {
          name: 'Notifications',
          description: 'Manage notifications sent to you.',
          href: '/settings/notifications',
          icon: BellIcon,
          current: this.page == 'Notifications' ? true : false,
        },
        {
          name: 'Payments',
          description: 'Manage store payment options.',
          href: '/settings/payments',
          icon: KeyIcon,
          current: this.page == 'Payments' ? true : false,
        },
        {
          name: 'Shipping and Delivery',
          description: 'Manage how you ship to customers.',
          href: '/settings/shipping-and-delivery',
          icon: PhotographIcon,
          current: this.page == 'Shipping' ? true : false,
        },
        {
          name: 'Gift Cards',
          description: 'Manage gift card settings.',
          href: '/settings/gift-cards',
          icon: CashIcon,
          current: this.page == 'GiftCards' ? true : false,
        },

      ]
    }
  },
  setup() {
    const open = ref(false)
    return {
      statusStyles,
    }
  },

}
</script>

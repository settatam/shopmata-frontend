<template>
  <nav aria-label="Sections" class="hidden flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col">
      <div class="flex-shrink-0 h-16 px-6 border-b border-blue-gray-200 flex items-center">
          <p class="text-lg font-medium text-blue-gray-900">Settings</p>
      </div>
      <div class="flex-1 min-h-0 overflow-y-auto">
          <inertia-link v-for="item in subNavigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50', 'flex p-6 border-b border-blue-gray-200']" :aria-current="item.current ? 'page' : undefined">
              <div class="ml-3 text-sm">
                <p class="font-medium text-blue-gray-900">{{ item.name }}</p>
              </div>
            </inertia-link>
        </div>
    </nav>
</template>

<script>

import { ref } from 'vue'
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
  ViewListIcon,
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
    ViewListIcon,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot
  },
  
  data() {
    return {
        subNavigation: [
        {
          name: 'General',
          description: 'View and update store details.',
          href: '#general',
          icon: CogIcon,
          current: this.page == 'General' ? true : false,
        },
        {
          name: 'Data',
          description: 'Manage notifications sent to you.',
          href: '#data',
          icon: BellIcon,
          current: this.page == 'Notifications' ? true : false,
        },
        {
          name: 'Images',
          description: 'Manage store payment options.',
          href: '#images',
          icon: PhotographIcon,
          current: this.page == 'Payments' ? true : false,
        },
        {
          name: 'Variants',
          description: 'Manage how you ship to customers.',
          href: '#images',
          icon: ViewListIcon,
          current: this.page == 'Shipping' ? true : false,
        },
        {
          name: 'Shipping',
          description: 'Manage gift card settings.',
          href: '#shipping',
          icon: CashIcon,
          current: this.page == 'GiftCards' ? true : false,
        },
        {
          name: 'Inventory',
          description: 'Manage gift card settings.',
          href: '#inventory',
          icon: CashIcon,
          current: this.page == 'GiftCards' ? true : false,
        },
        {
          name: 'SEO',
          description: 'Enter SEO details for this product.',
          href: '#seo',
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

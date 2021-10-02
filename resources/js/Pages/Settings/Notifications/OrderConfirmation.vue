<template>
  <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
           <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <p class="text-2xl font-semibold text-blue-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                      <CogIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                      <span class="sr-only">Settings</span>
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

            <div class="flex-1 flex xl:overflow-hidden mt-5">
            <!-- Secondary sidebar -->
            <Nav page="Notifications"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                  <div class="flex justify-between items-center">
                    <div class="flex font-semibold items-center">
                        <inertia-link href="/settings/notifications">
                                <arrow-left-icon class="w-5 h-5 mr-5"/>
                        </inertia-link>
                        <p class="text-2xl">Order Confirmation</p>
                    </div>
                    <div class="flex items-center mb-5">
                        <div class="flex text-indigo-700 mr-7" >
                            <EyeIcon class="w-5 h-5 font-semibold mr-2.5"/> <p> Preview </p>
                        </div>
                        <button type="button" class=" rounded-md border border-transparent shadow-sm px-7 py-3  text-base font-medium text-white sm:text-sm" :class="order.subject.length>1 && order.body.length>1 ? 'bg-indigo-600': 'bg-gray-400' " @click="submit" >
                        Save
                        </button>
                    </div>
                  </div>
                  <div class="px-8 pb-8 pt-6  mb-6 bg-white">
                    <h1 class="text-xl font-bold">Email</h1>
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email subject
                            </label>
                            <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Order Confirmation" v-model.trim="order.subject" required/>
                            <error-icon class="absolute top-11 right-2.5" v-show="subjectError &!order.subject.length"/>
                        </div>
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email body (HTML)
                            </label>
                            <textarea  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm  border-gray-300 h-96 rounded-md"  v-model.trim="order.body" required></textarea>
                            <error-icon class="absolute top-1 left-40" v-show="bodyError && !order.body.length "/>
                        </div>
                  </div>
                  <div class=" flex justify-between">
                    <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-5 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none  sm:text-sm" >
                        Back to default 
                    </button>
                    <button type="button" class=" rounded-md border border-transparent shadow-sm px-7 py-3  text-base font-medium text-white focus:outline-none sm:text-sm" :class="order.subject.length>1 && order.body.length>1 ? 'bg-indigo-600': 'bg-gray-400' " @click="submit" >
                        Save
                    </button>
                </div>
              </div>
            </div>
            </div>
      </div>
  </app-layout>
</template>

<script>

import AppLayout from '../../../Layouts/AppLayout.vue'
import Nav from '../Nav'
import { ChevronLeftIcon, ChevronUpIcon,ChevronDownIcon,ChevronRightIcon,CogIcon,ArrowLeftIcon,EyeIcon  } from '@heroicons/vue/solid'
import { reactive, ref } from '@vue/reactivity'
import ErrorIcon from '../../../../assets/ErrorIcon.vue'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Notifications', href: '/settings/notifications', current: false },
  { name: 'Order Confirmation', href: '/settings/notifications/order-confirmation', current: true },
]

export default {
    components:{
        AppLayout,
        ChevronRightIcon,
        CogIcon,
        Nav,
        ArrowLeftIcon,
        EyeIcon,
        ErrorIcon
    },
    setup() {
        const order = reactive({subject:'', body:''});
        const bodyError =ref(false)
        const subjectError =ref(false)
        const submit =()=>{
            if (!order.subject.length && order.body.length) {
                subjectError.value = true
            } else if  (!order.body.length && order.subject.length) {
                bodyError.value = true
            }else if  (!order.body.length && !order.subject.length) {
                bodyError.value = true
                subjectError.value = true
            } else {
                alert("Order confirmation saved")
                
            }
        }
        return {
            pages,
            order,
            bodyError,
            subjectError,
            submit
        }
  },
}
</script>

<style>
</style>
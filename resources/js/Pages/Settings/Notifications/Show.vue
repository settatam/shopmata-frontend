<template>
  <!-- FONT AWESOME LINK -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <!-- FONT AWESOME LINK -->
  <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
           <div class="flex-shrink-0 mb-3 px:3 md:px-6 flex items-center">
              <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-3 md:px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                      <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
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

            <div class="flex-1 flex flex-col px-3 md:px-6 lg:px-0 lg:flex-row xl:overflow-hidden mt-5">
            <!-- Secondary sidebar -->
            <Nav page="Notifications"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                  <div class="flex justify-between items-center mb-2 lg:mb-0 ">
                    <div class="flex font-semibold items-center">
                        <inertia-link href="/settings/notifications">
                          <arrow-left-icon class="w-5 h-5 mr-5"/>
                        </inertia-link>
                        <p class="text-base lg:text-2xl">{{notification.name}}</p>
                    </div>
                    <div class="flex items-center mb-0 lg:mb-5">
                        <div class="text-indigo-700 mr-7 hidden lg:flex" >
                            <EyeIcon class="w-5 h-5 font-semibold mr-2.5"/> <p> Preview </p>
                        </div>
                        <button type="button" class=" rounded-md border border-transparent shadow-sm px-4 lg:px-7 py-3 text-xs  lg:text-base font-medium text-white sm:text-sm" :class="order.subject.length>1 && order.message.length>1 ? 'bg-indigo-600': 'bg-gray-400' " @click="submit" >
                        <i class="fas fa-spinner fa-pulse text-white m-2" v-if="loading"></i>{{save}}
                        </button>
                    </div>
                  </div>
                  <error v-if="error" :msg="successMessage" class="sticky top-20 w-full z-30" />
                  <success v-if="success" :msg="successMessage" class="sticky top-20 w-full z-30"/>
                  <div class="px-4 md:px-8 pb-8 pt-6  mb-6 bg-white">
                    <h1 class="text-xl font-bold">Email</h1>
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email subject
                            </label>
                            <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" :placeholder="order.subject" v-model.trim="order.subject" required/>
                            <error-icon class="absolute top-11 right-2.5" v-show="subjectError"/>
                        </div>
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email body (HTML)
                            </label>
                            <textarea  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm  border-gray-300 h-96 rounded-md"  v-model.trim="order.message" required></textarea>
                            <error-icon class="absolute top-1 left-40" v-show="bodyError "/>
                        </div>
                  </div>
                  <div class=" flex justify-between">
                    <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-3 lg:px-5 py-1.5 lg:py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none  sm:text-sm" >
                        Back to default 
                    </button>
                    <button type="button" class=" rounded-md border border-transparent shadow-sm px-4 lg:px-7 py-3 text-xs  lg:text-base font-medium text-white focus:outline-none sm:text-sm" :class="order.subject.length>1 && order.message.length>1 ? 'bg-indigo-600': 'bg-gray-400' " :disabled='loading' @click="submit" >
                        <i class="fas fa-spinner fa-pulse text-white m-1" v-if="loading"></i>{{save}}
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
import { ChevronLeftIcon, ChevronUpIcon,ChevronDownIcon,ChevronRightIcon,ArrowLeftIcon,EyeIcon  } from '@heroicons/vue/solid'
import { reactive, ref } from '@vue/reactivity'
import ErrorIcon from '../../../../assets/ErrorIcon.vue'
import  {HomeIcon} from '@heroicons/vue/outline'
import axios from 'axios'
import { onBeforeMount } from '@vue/runtime-core'
import Success from '../../../Components/Success.vue';
import Error from '../../../Components/Error.vue';

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Notifications', href: '/settings/notifications', current: false }
]

export default {
    props:{store_notification:Object,notification:Object},
    components:{
        AppLayout,
        ChevronRightIcon,
        HomeIcon,
        Nav,
        ArrowLeftIcon,
        EyeIcon,
        ErrorIcon,
        Success,
        Error
    },
    setup({store_notification,notification}) {
        const order = reactive({subject:'', message:'',store_notification_id:notification.id});
        const bodyError =ref(false)
        const subjectError =ref(false)
        const loading=ref(false)
        const success=ref(false)
        const save =ref('Save')
        const error =ref(false)
        const successMessage = ref('')
        onBeforeMount(()=>{
          store_notification==null ? order.subject=notification.name: order.subject=store_notification.subject;
          store_notification==null ? order.message=notification.content : order.message=store_notification.message;
        }) 
        const loadingFn =()=>{
          loading.value = false
          success.value= false
          save.value = "Save"
          order.message=""
          window.location.href = '/settings/notifications/'
        }
        const errorFn =()=>{
          loading.value = false
          error.value= false
          save.value = "Save"
        }
        const saving=()=>{
          success.value = true
        }
        const submit =()=>{
            if (!order.subject.length && order.message.length) {
                subjectError.value = true
            } else if  (!order.message.length && order.subject.length) {
                bodyError.value = true
            }else if  (!order.message.length && !order.subject.length) {
                bodyError.value = true
                subjectError.value = true
            } else {
              axios.post('store',order).then((res)=>{
                loading.value = true
                  if(res.status==200){
                    successMessage.value=res.data.message
                    setTimeout(saving, 2000)
                    save.value = "Saving"
                    setTimeout(loadingFn,3000)
                  }else if(res.status==422){
                    successMessage.value=res.data.message
                    setTimeout(error.value= true,2000)
                    setTimeout(errorFn,3000)
                  }else{
                    successMessage.value="Database Error"
                    setTimeout(error.value = true,2000)
                    setTimeout(errorFn,3000)
                  }
                })                
            }
        }
        return {
            pages,
            order,
            bodyError,
            subjectError,
            submit,
            loading,
            save,
            success,
            successMessage,
            error
        }
  },
}
</script>

<style>
</style>
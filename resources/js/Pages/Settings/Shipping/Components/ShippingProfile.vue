<template>
  <app-layout >
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
           <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
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
          <div class="flex-1 flex flex-col xl:overflow-hidden lg:flex-row mt-5 px-4 lg:px-0">
            <!-- Secondary sidebar -->
            <Nav page="Shipping"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto overflow-x-scroll">
                <div class="w-auto  lg:ml-7 lg:mr-2">
                    <div class="mb-6">
                         <div class="px-4 md:px-8 pb-8 pt-6  mb-6 bg-white">
                            <h1 class="text-2xl font-semibold">Add Shipping Rate</h1>
                             <p class=" text-gray-500">Select a state and the cities within that state you can deliver to. Set a delivery rate and how long it will take to deliver items. <a class="text-indigo-700 underline cursor-pointer" @click="this.videoPop=true">Watch a demo</a></p>                       
                                <demo-video-modal @close="this.videoPop=false"  v-if="this.videoPop"/>
                                
                                <div class="w-auto relative" >
                                    <label class="block mt-4 mb-2 bg-transparent text-lg">
                                        Rate Name
                                    </label>
                                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="rates.name" required/>
                                    <error-icon class="absolute top-8 right-0" v-show="bodyError && !rates.name.length "/>
                                </div>
                                <div class="w-auto relative">
                                    <label class="block mt-4 mb-2 bg-transparent text-lg">
                                        Price
                                    </label>
                                    <input type="number"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  v-model="rates.price" required/>
                                    <error-icon class="absolute top-8 right-0" v-show="bodyError && !rates.price.length "/>
                                </div>
                                 <div class="w-full mt-4 ">
                                    <p class="block text-gray-600 font-semibold text-lg mb-2 bg-transparent">
                                        Rate for
                                    </p>
                                    <div class=" items-center">
                                        <input type="radio" value="0"  class="mr-2" v-model="rates.is_domestic" name="domestic">
                                        <label for="domestic" @click="rates.is_domestic ='0'" class="cursor-pointer"> Domestic</label>
                                    </div>
                                    
                                    <div class=" items-center mt-2">
                                        <input type="radio" class="mr-2" value="1" v-model="rates.is_domestic" name="international">
                                        <label for="international" @click="rates.is_domestic='1'" class="cursor-pointer"> International</label>
                                    </div>
                                </div>
                                    <p class="font-semibold mt-6 text-lg">Orders must match</p>
                                    <div class="flex mt-4">
                                        <div class=" items-center">
                                            <input type="radio" value="0"  class="mr-2" v-model="rates.match_all_condition" name="all_condition">
                                            <label for="all_condition" @click="rates.match_all_condition ='0'" class="cursor-pointer"> All Conditions</label>
                                        </div>
                                    
                                        <div class=" items-center ml-10">
                                            <input type="radio" class="mr-2" value="1" v-model="rates.match_all_condition" name="any_condition">
                                            <label for="any_condition" @click="rates.match_all_condition='1'" class="cursor-pointer"> Any Condition</label>
                                        </div>
                                    </div>

                                        <template v-for="(datum, index) in data" :key="index" >
                                            <div class="flex flex-wrap justify-between lg:flex-row lg:justify-between mt-4">
                                                <div class="w-4.5/10 lg:w-3/10">
                                                    <select name="options" id="" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none mb-2 lg:mb-0" v-model="datum.tag">
                                                        <option v-for="(option,index) in rate" :key="index" :value="option.title">
                                                            {{option.title}}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="w-4.5/10 lg:w-3/10">  
                                                    <select name="conditions" id=""  class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none" v-model="datum.condition">
                                                        <option v-for="(condition, index) in conditions" :key="index" :value="condition.title">
                                                        {{condition.title}}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="w-8.5/10 lg:w-3/10 mb-2">
                                                    <select name="state" id="" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 w-full hover:bg-gray-50 focus:outline-none" v-if="datum.tag=='State'" v-model="datum.value">
                                                        <option v-for="(state,index) in states" :key="index" :value="state.id">
                                                            {{state.name}}
                                                        </option>
                                                    </select>
                                                    <input type="number" class="w-full text-xs py-2 sm:text-sm rounded-md border-gray-300" v-else v-model="datum.value">
                                                </div>
                                                <TrashIcon v-if="data.length>1 && index !=0" class="w-5 h-5 text-red-500 my-auto cursor-pointer" @click="removeCondition(index)"/>
                                                <TrashIcon v-else class="w-5 h-5 invisible"/>
                                            </div>
                                        </template>
                                            <button class="text-indigo-700 sm:text-sm text-xs font-semibold mt-4 " @click="add()">Add New Condition</button>
                                    <div class="flex mt-4">
                                         <div class="mr-2 w-full mb-3 relative">
                                        <label class="block font-semibold mb-2 bg-transparent">
                                            Description
                                        </label>
                                        <textarea   :class="[rates.description.length>50?'focus:border-red-500 focus:ring-red-500':'focus:border-indigo-500','shadow-sm h-20 block w-full sm:text-sm border-gray-300 rounded-md']" placeholder="Write a delivery note ......." v-model="rates.description" required></textarea>
                                        <span class="text-gray-400 absolute bottom-1 right-3">{{rates.description.length}}/50</span>
                                        </div>
                                    </div>
                                     
                                    <div class="flex justify-between">
                                        <inertia-link href="/settings/shipping-and-delivery">
                                            <button class="text-gray-500 bg-transparent border border-gray-500 rounded-md px-8 py-2 font-normal text-base  my-5">Cancel</button>
                                        </inertia-link>
                                        <button class="text-white bg-indigo-700 rounded-md px-8 py-3 my-5 ml-5" @click="submit" >Save</button>
                                    </div> 
                                 </div>
                            </div>
                </div>
            </div>
         </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../../../Layouts/AppLayout.vue'
import Nav from '../../Nav';
import {LocationMarkerIcon,ChevronRightIcon,HomeIcon,DotsHorizontalIcon,XIcon,TrashIcon} from '@heroicons/vue/outline'
import {onBeforeMount, reactive, ref} from 'vue'
import Button from '../../../../Jetstream/Button.vue';
import { Inertia } from '@inertiajs/inertia';
import ErrorIcon from '../../../ErrorIcon.vue'
import DemoVideoModal from './DemoVideoModal.vue'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Shipping and Delivery', href: '/settings/shipping-and-delivery', current: false },
  { name: 'Shipping Profile', href: '/settings/shipping-and-delivery/shipping-profile', current: true },
]
export default {
    props:['rate_options','condition_options','store'],
     components: {
        Nav,
        AppLayout,
        LocationMarkerIcon,ChevronRightIcon,HomeIcon,
          Button,
          DotsHorizontalIcon, 
          ErrorIcon,
          XIcon,
          DemoVideoModal,
          TrashIcon
    }, 
    data(){
        return{
            open:false,
            location_id:'', 
            videoPop: false,
        }
    },
    methods:{
    },
    setup(props){
        const Modal = ref(false)
        const popModal = () => {
            Modal.value = true
        }
        const states = ref([])
        const conditions = props.condition_options
        const rate = props.rate_options
        const data = ref([{condition:'is equal to',tag:'State',value:''}])
        const rates = ref({name:'',description:'',price:'',is_domestic:'',match_all_condition:''})
        const bodyError = ref(false)

        const removeCondition=(id)=>{
            data.value.splice(id , id+1)
        }
        const add = ()=> {
            data.value.push({
                condition:"is equal to",
                tag:"State",
                value:''
            })
        }
        
        onBeforeMount(()=>{
            axios.get(`/api/states?country_id=${props.store.country_id}`).then(res=>{
                states.value = res.data.data
            }) 
        })

       const submit=()=>{
           if (!rates.value.name || !rates.value.price) {
               bodyError.value = true       
           } else {
               const formData = {
                    name:rates.value.name, 
                    price:rates.value.price,
                    description:rates.value.description,
                    is_domestic:rates.value.is_domestic,
                    is_international:rates.value.is_international,
                    match_all_condition:rates.value.match_all_condition,
                    conditions:data.value 
                }
    
               Inertia.post('/settings/shipping-rates',formData)
               // rates.value=({name:'',description:'',price:'',is_domestic:'',match_all_condition:''})
               // data.value =([{condition:'is equal to',tag:'Total Amount',value:''}])
           }
       }
        return{
            pages,
            Modal,
            popModal, 
            rate,
            rates,
            data,
            conditions,
            add,
            states,
            submit,
            bodyError,
            removeCondition
        }
    }
}
</script>

<style>
</style>
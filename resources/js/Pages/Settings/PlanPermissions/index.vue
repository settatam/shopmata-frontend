<template>
  <app-layout>
        <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
                <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span>Settings</span>
                </inertia-link>
            </div>
        </nav>
        <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <Nav page="Plans"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
                <div class="w-8.5/10 ml-5 max-w-2lg ">
                    <div class="mb-6 mt-4 pt-2">
                        <div class="p-8 mb-6 bg-white">
                            <h2 class="text-xl font-semibold mb-4">Plan and Permissions</h2>
                            <h3 class="text-lg font-semibold">Plan details</h3>
                            <p class="text-sm text-gray-400">View our <span class="text-indigo-700 cursor-pointer">terms of service</span>  and <span class="text-indigo-700 cursor-pointer">privacy policy.</span></p>

                            <div class="px-2  border border-gray-300 mt-5 py-2.5 rounded">
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-hidden">
                                    <div class="py-2 align-middle inline-block min-w-full">
                                        <div class=" overflow-hidden  sm:rounded-lg">
                                        <table class="min-w-full ">
                                            <thead class="">
                                            <tr>
                                                <th scope="col" class="px-3 py-3 text-left  text-gray-500  tracking-wider">
                                                Member Since
                                                </th>
                                                <th scope="col" class="px-3 py-3 text-left  text-gray-500  tracking-wider">
                                                Current Plan
                                                </th>
                                                <th scope="col" class="px-3 py-3 text-left  text-gray-500  tracking-wider">
                                                Status
                                                </th>
                                                <th scope="col" class="px-3 py-3 text-left  text-gray-500  tracking-wider">
                                                Next Payment
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(plan, index) in plans" :key="index">
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-bold text-black">
                                                {{ plan.member_since }}
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-bold text-black">
                                                {{ plan.current_plan}}
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-bold text-black">
                                                {{ plan.status }}
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-bold text-black">
                                                {{ plan.next_payment}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                            <div class="flex justify-between ">
                                <div>
                                    <h2 class="text-xl font-semibold">Plan and Permissions</h2>
                                    <p class="text-sm text-gray-400">Manage what staff can see or do in your store.</p>
                                </div>
                                <PlusCircleIcon class="w-11 h-11 text-indigo-700 cursor-pointer" @click="this.popModal=true"/>
                            <permission-modal v-if="popModal" @close="this.popModal=false"/>
                            </div>
                             <div class="px-5  border border-gray-300 mt-5 py-4 rounded">
                                <h3 class="text-lg font-bold mb-6">Store Owner</h3>
                                    <div v-for="user in storeUsers" :key="user.id">
                                        <div v-if="user.store_group_id==1">
                                            <div class="flex items-center">
                                                <img :src="user.user.profile_photo_url" alt="Profile Photo" class=" rounded-full mr-4">
                                                <div>
                                                    <p class="text-sm text-indigo-700">{{user.user.first_name + '' +user.user.last_name}}</p>
                                                    <p>Last login was {{user.last_login.created_at}} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                             </div>
                             <div class="px-2 border border-gray-300 py-2.5 mt-6 rounded">
                                  <h3 class="text-lg font-bold pl-5 py-5 ">Staff Accounts</h3>
                                  <table class="w-full divide-y divide-gray-200 table-fixed">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" v-model="selectAll" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                        </th> 
                                        <th scope="col" class="w-3/10  px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Names
                                        </th>
                                        <th scope="col" class=" w-3/10 px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Last Login
                                        </th>
                                        <th scope="col" class="w-1/5 px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            Permissions
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only"></span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" v-for="user in storeUsers " :key=" user.id">
                                    <tr class="bg-white">
                                        <td scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" v-model="selected" :value="user.user.first_name" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                        </td> 
                                        <td class="w-3/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                            <p class="text-indigo-700 text-left text-sm font-semibold "> {{user.user.first_name + ' ' +user.user.last_name}}</p>  
                                        </td>
                                        <td class="w-3/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                            <p class="text-gray-800 text-left ">{{moment(user.updated_at).format("YYYY-MM-DD")}}</p>  
                                        </td>
                                        <td class="w-3/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==1">Full Access</p>  
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==2">Edit Access</p>  
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==3">Read/Write Access</p>  
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==4">Read Only Access</p>  
                                        </td>
                                    
                                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">                              
                                            <DotsVerticalIcon/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav';
import {PlusCircleIcon,DotsVerticalIcon} from '@heroicons/vue/solid'
import moment from "moment";
import PermissionModal from './PermissionModal.vue';



const plans = [
  { member_since: 'Jan. 1, 2021', current_plan: 'Shopmata/Monthly', status: 'Active', next_payment: 'on Nov. 31, 2021' },
  
  // More people...
]
export default {
  props: ['user', 'storeUsers', 'groups','login'],
  components: { AppLayout,Nav,PlusCircleIcon,DotsVerticalIcon,PermissionModal },
  data(){
      return{
          popModal:false,
          selectAll:false,
          selected:[],
      }
  },

    setup() {
    return {
      plans,
      moment,
    }
  },
}
</script>


<style>
</style>
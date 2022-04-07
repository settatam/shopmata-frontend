<template>
  <app-layout>
    <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden" >
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
        <div class="flex-1 flex xl:overflow-hidden mt-5 flex-col lg:flex-row px-4 lg:px-0">
            <!-- Secondary sidebar -->
            <Nav page="Plans"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
                <div class="w-auto  lg:ml-7 lg:mr-2">
                    <div class="mb-6">
                        <div class="p-4 lg:p-8 mb-6 bg-white">
                            <h2 class="text-xl font-semibold mb-4">Plan and Permissions</h2>
                            <h3 class="text-lg font-semibold">Plan details</h3>
                            <p class="text-sm text-gray-400">View our
                                <inertia-link href="/settings/terms-of-service">
                                 <span class="text-indigo-700 cursor-pointer" >terms of service</span>
                                </inertia-link>
                                 and
                                <inertia-link href="/settings/privacy-policy">
                                    <span class="text-indigo-700 cursor-pointer" >privacy policy.</span>
                                </inertia-link>
                            </p>

                            <div class="px-2  border border-gray-300 mt-5 py-2.5 rounded">
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-scroll">
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
                            <div class="flex justify-between items-center">
                                <div>
                                    <h2 class="text-xl font-semibold">Plan and Permissions</h2>
                                    <p class="text-sm text-gray-400">Manage what staff can see or do in your store.</p>
                                </div>
                                <PlusCircleIcon class="w-11 h-11  text-indigo-700 cursor-pointer" @click="inviteStaff"/>
                            <permission-modal v-if="popModal" @close="this.popModal=false" :groups="groups" :login="login" :title="title" :buttonMsg="buttonMsg" :user_id="user_id" :user_email="user_email"/>
                            </div>
                             <div class="px-5  border border-gray-300 mt-5 py-4 rounded">
                                <h3 class="text-lg font-bold mb-6 text-center md:text-left">Store Owner</h3>
                                    <div class="flex flex-col md:flex-row  md:justify-start items-center">
                                        <p class="h-10 w-10 rounded-full capitalize bg-blue-400 text-white text-center text-sm py-2.5 font-semibold mr-4">{{user.first_name.charAt(0)}}{{user.last_name.charAt(0)}}</p>
                                        <div>
                                            <p class="text-sm text-indigo-700 font-semibold text-center md:text-left">{{user.first_name + ' ' + user.last_name}}</p>
                                            <p class="text-center md:text-left">Last login was {{formatDate(user.last_login.created_at)}} </p>
                                        </div>
                                    </div>
                             </div>
                             <div class="px-2 border border-gray-300 py-2.5 mt-6 rounded overflow-x-scroll">
                                 <div class="flex justify-between items-center px-5">
                                  <h3 class="text-lg font-bold py-5">Staff Accounts</h3>
                                    <TrashIcon class="w-8 h-8 text-indigo-700 border border-indigo-600 p-1.5 rounded-sm cursor-pointer" v-if="selected.length>0"/>
                                 </div>
                                  <table class="w-full  divide-y divide-gray-200 table-auto">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="w-4/10  px-6 py-3 text-left text-lg font-medium text-gray-500 tracking-wider">
                                            Names
                                        </th>
                                        <th scope="col" class=" w-3/10 px-6 py-3 text-left text-lg font-medium text-gray-500 tracking-wider">
                                            Last Login
                                        </th>
                                        <th scope="col" class="w-1/5 px-6 py-3 text-left text-lg font-medium text-gray-500 tracking-wider ">
                                            <span class="flex items-center"> Roles
                                                <Tooltip :tooltipText="'Create roles for members of your staff e.g Administrator, Store Manager, Member'">
                                                   <question-mark-circle-icon class="w-5 h-5 ml-1 cursor-pointer" />
                                                </Tooltip>
                                            </span>
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only"></span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" v-for="user in storeUsers " :key=" user.id">
                                    <tr class="bg-white">
                                        <td class="w-4/10 px-6 py-4 text-right whitespace-pre-wrap text-sm text-gray-500">
                                            <p class="text-indigo-700 text-left text-sm font-semibold "> {{user.user.first_name + ' ' + user.last_name}}</p>
                                        </td>
                                        <td class="w-3/10 px-6 py-4 text-right whitespace-pre-wrap text-sm text-gray-500">
                                            <p class="text-gray-800 text-left ">{{moment(user.last_login).format("LLLL")}}</p>
                                        </td>
                                        <td class="w-3/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500" >
                                           <p class="text-gray-800 text-left " v-if="user.store_group_id==1">Owner</p>
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==2">Developer</p>
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==3">Guest</p>
                                            <p class="text-gray-800 text-left " v-if="user.store_group_id==4">Admin</p>
                                        </td>

                                        <td class="px-6 py-4 text-right  text-sm text-gray-500 relative">
                                            <div class="flex">
                                                <pencil-icon class="h-8 w-8 p-2 mr-6 text-indigo-600 cursor-pointer" @click="editRow(user)" />
                                                <trash-icon class="h-8 w-8 p-2 mr-6 text-red-500 cursor-pointer" @click="deleteRow(user.id)"/>
                                                <thumb-up-icon class="h-8 w-8 p-2 text-red-500 cursor-pointer"   @click="changeStatus(user.id)"  />
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <ConfirmationModal v-if="deleteConfirmation" :open="this.open" @close="emitClose" :id="this.user_id" />
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
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav';
import {PlusCircleIcon,DotsVerticalIcon,ChevronRightIcon,PencilAltIcon,} from '@heroicons/vue/solid'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import {TrashIcon,HomeIcon,QuestionMarkCircleIcon,PencilIcon,ThumbUpIcon} from '@heroicons/vue/outline'
import moment from "moment";
import PermissionModal from './Components/PermissionModal.vue';
import { ref } from '@vue/reactivity';
import Inertia from '@inertiajs/inertia-vue3'
import ConfirmationModal from './Components/ConfirmationModal.vue';
//import moment from 'moment'
import Tooltip from "../../../Components/Tooltip/Components/Tooltip.vue";


const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Plans and Permissions', href: '/settings/plan-and-permissions', current: true },
]

const plans = [
  { member_since: 'Jan. 1, 2021', current_plan: 'Shopmata/Monthly', status: 'Active', next_payment: 'on Nov. 31, 2021' },

  // More people...
]
export default {
  props: ['user', 'storeUsers', 'groups','login'],
  components: {
    AppLayout,
    Nav,
    PlusCircleIcon,
    DotsVerticalIcon,
    PermissionModal,
    ChevronRightIcon,
    HomeIcon,
    QuestionMarkCircleIcon,
    PencilAltIcon,
    TrashIcon,
    ConfirmationModal,
    Menu,
    PencilIcon,
    MenuButton,
    MenuItem,
    MenuItems,
    Tooltip,
    ThumbUpIcon
},
   emits:['close'],
  data(){
      return{
          popModal:false,
          selectAll:false,
          selected:[],
          currentRow: 0,
          openSub: false,
          deleteConfirmation:false,
          title:"",
          buttonMsg:"",
          user_id: '',
          user_email:'',
      }
  },
    methods:{
        formatDate(created_at){
            return moment(created_at).format('LLLL')
        },
        openSubMenu(id){
            this.currentRow = id
            if (this.openSub==true) {
                this.openSub =false
            }else{
                this.openSub=true
            }
        },
        inviteStaff(){
            this.popModal=true
            this.title = 'Invite Staff'
            this.buttonMsg='Send Invite'
        },
        changeStatus(id){
            axios.get('/settings/store-users/response',{
                params: {
                    id: id
                }
            }).then(res => {
                console.log(res)
            })
        },
        editRow(user){
            this.openSub =false
            this.popModal=true
            this.title = 'Change Role',
            this.buttonMsg='Save Changes',
            this.user_id = user.id
            this.user_email = user.user.email
        },
        deleteRow(id){
            this.deleteConfirmation = true
            this.open = true
            this.user_id = id
        },
        checkAll(){
            this.selected = !this.selectAll ? [...this.storeUsers] : [];
            console.log(this.selectAll,...this.storeUsers)
        },
        uncheckParentBox(user) {
                event.stopPropagation();
                let rows = this.selected.filter(s =>s.id == user.id);
                if(rows.length > 0) { // unselect
                    this.selected = this.selected.filter(s => s.id != user.id);
                }   else { // select
                    this.selected.push(user);
                }
                this.storeUsers.length == this.selected.length ? this.selectAll = true : this.selectAll = false;
            },
            emitClose(){
                this.openSub=false
                this.deleteConfirmation = false
            }
    },
    setup() {
        const open = ref(false)

    return {
      plans,
      moment,
      pages,
      Menu,
      MenuButton,
      MenuItem,
      MenuItems,
    }
  },
}
</script>


<style>
</style>

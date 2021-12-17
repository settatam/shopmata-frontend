<template>
    <app-layout>
        <!-- Page header -->
        <div class="">
          <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
            <div class="py-6 flex items-center md:justify-between lg:border-t lg:border-gray-200">
              <div class="flex-1 min-w-0">
                <!-- Profile -->
                    <div class="flex items-center">
                      <h1 class="ml-3 text-lg md:text-2xl font-semibold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                        All Products
                      </h1>
                    </div>
              </div>
              <div class=" flex  md:mt-0 md:ml-1">
                <!-- <div class="border p-3 cursor-pointer rounded border-red-500 mr-1">
                  <trash-icon class="w-4 h-4  text-red-500"/>
                </div> -->
                <inertia-link href="/products/create" type="button" class="inline-flex items-center px-2 py-1 text-xs md:text-base md:px-4 md:py-2 border border-transparent shadow-sm cursor-pointer rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  <plus-icon class="md:w-5 md:h-5 w-4 h-4 text-white mr-2"/> Create New Product
                </inertia-link>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-8">
          
          <!-- Activity table (small breakpoint and up) -->
          <div class=" sm:block">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mt-3 sm:mt-4">
                  <!-- <div class="sm:hidden">
                    <label for="current-tab" class="sr-only">Select a tab</label>
                    <select id="current-tab" name="current-tab" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                    </select>
                  </div> -->
                 <!--  <div class="hidden sm:block mb-5 ">
                    <nav class="-mb-px -pb-px flex space-x-8 relative ">
                      <a v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap pb-1 font-normal px-1 border-b-2']" @click="currentTab(tab.id)">
                        {{ tab.name }}
                      </a>
                    </nav>
                    <div class="border-b-2 div-mb border-gray-200 w-full"></div>
                  </div> -->
                  <div class="grid grid-cols-2 gap-2 md:px-0 md:grid-cols-4 rounded bg-transparent">
                    <div class="">
                      <label for="search-field" class="text-xm md:text-base">Search</label>
                      <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none" aria-hidden="true">
                          <SearchIcon class="h-5 w-5 ml-5" aria-hidden="true" />
                        </div>
                        <input id="search-field" name="search-field" class="rounded text-xm md:text-base text-gray-500 w-full md:search-field md:w-full pl-12 pr-2 bg-transparent border border-gray-200 placeholder-gray-500 placehol" placeholder="Search by name, email....." type="search" />
                      </div>
                    </div>
                    <div class="flex flex-col">
                      <label for="brand" class="text-xm md:text-base">Brand</label>
                      <select name="brand" id="" class="rounded text-gray-500 w-full text-xm md:text-base bg-transparent border border-gray-200 ">
                        <option value="1">All</option>
                      </select>
                    </div>
                    <div class="flex flex-col">
                      <label for="Status" class="text-xm md:text-base">Category</label>
                      <select name="Status" id="" class="rounded text-gray-500 text-xm md:text-base w-full bg-transparent border border-gray-200">
                        <option value="1">All</option>
                      </select>
                    </div>
                    <div class="flex flex-col">
                      <label for="Tag" class="text-xm md:text-base">Status</label>
                      <div class="flex">
                      <select name="Tag" id="" class="rounded text-xm md:text-base text-gray-500 w-full bg-transparent border border-gray-200">
                        <option value="1">All</option>
                      </select>
                      <div class="border hidden md:block p-3 cursor-pointer rounded border-red-500 ml-1" v-if="selected.length" @click="delete_selected = true">
                        <trash-icon class="w-4 h-4  text-red-500"/>
                      </div>
                      </div>
                    </div>
                  </div>

                  <div class="flex items-center justify-between my-4 md:hidden">
                    <div class="border border-gray-200 px-4 py-2 text-center rounded text-xm">
                      <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-5 cursor-pointer" v-model="selectedAll" @click.stop="select" :disabled="products.data.length===0" /> Select all
                    </div>
                    <div class="border p-2 cursor-pointer rounded border-red-500 ml-1 " v-if="selected.length" @click="delete_selected=true">
                        <trash-icon class="w-4 h-4  text-red-500"/>
                    </div>
                  </div>

                </div>
              <div class="hidden md:flex flex-col mt-2 md:mt-6">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="w-2/5 max-w-0 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-5 cursor-pointer" v-model="selectedAll" @click.stop="select" :disabled="products.data.length===0" />
                          PRODUCTS
                        </th>
                        <th scope="col" class="w-2/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          STOCK LEVEL
                        </th>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          BRAND
                        </th>
                        <th scope="col" class=" w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          CATEGORY
                        </th>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          PRICE
                        </th>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          Status
                        </th>
                        <!-- <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th> -->
                      </tr>
                    </thead>
                     <tbody class="bg-white divide-y divide-gray-200" v-if="products.data.length>0">
                     <tr v-for="product in products.data" :key="product.id" class="bg-white hover:bg-indigo-50">
                        <td class="w-2/5 max-w-0 px-6 py-4 items-center text-gray-900">
                          <div class="flex items-center">
                            <div class="flex h-5 mr-5">
                                <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded cursor-pointer" :value="product.id" v-model="selected" @click="uncheckBox(product.id)"/>
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 mr-5">
                              <img class="h-12 w-12 rounded-full" :src="product.images[0].url" alt='{{product.title}}' />
                            </div>
                            <inertia-link :href="'products/'+product.id+'/'" class="group inline-flex space-x-2 truncate">
                              <p class="text-gray-800 truncate group-hover:text-gray-900 break-normal">
                                {{ product.title }}
                              </p>
                            </inertia-link>
                          </div>
                        </td>
                        <td class="w-2/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <span class="text-gray-900 font-normal">{{ product.amount }} </span>
                          {{ product.currency }}
                        </td>
                        <td class="w-1/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          {{ product.currency }}
                          <span class="text-gray-900 font-normal">{{ product.amount }} </span>
                        </td>
                        
                        <td class="w-1/10 px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                          <span :class="[statusStyles[product.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-normal capitalize']">
                            {{product.status}}
                          </span>
                        </td>
                        <td class=" w-1/10px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                          <span class="text-gray-900 font-normal">{{product.compare_at_price }} </span>
                          {{ product.currency_code }}
                        </td>
                        <td class="w-1/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <time :datetime="product.datetime">{{ product.date }}</time>
                        </td>
                        <!-- <td>
                          <pencil-icon class="w-5 h-5 text-indigo-700"/>
                        </td> -->
                      </tr> 
                    </tbody>
                  </table>
                  <div class="flex flex-col items-center pb-20 bg-white" v-if="products.data.length==0">
                    <img src="../../../assets/EmptyTable.svg" alt="empty_table" srcset="">
                    <p class="mb-4 text-lg">No product has been created</p>
                    <inertia-link href="/products/create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm cursor-pointer rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                      <plus-icon class="w-5 h-5 text-white mr-2"/> Create New Product
                    </inertia-link>
                  </div>
                </div>
              </div>
              <div class="md:hidden flex flex-col items-center pb-20 mt-3 rounded bg-white" v-if="products.data.length==0">
                <img src="../../../assets/EmptyTable.svg" alt="empty_table" srcset="">
                <p class="mb-4 text-lg">No product has been created</p>
                <inertia-link href="/products/create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm cursor-pointer rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  <plus-icon class="w-5 h-5 text-white mr-2"/> Create New Product
                </inertia-link>
              </div>
              <div class="flex flex-col md:hidden mt-3 p-4 bg-white rounded" v-else>
                <div class="flex flex-col" v-for="product in products.data" :key="product.id">
                  <div class="flex justify-between">
                    <div class="flex items-center w-4/5 mr-1">
                      <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded cursor-pointer mr-1" :value="product.id" v-model="selected" @click="uncheckBox(product.id)"/>
                      <div class="h-10 w-10 mr-3">
                        <img class="h-12 w-12 rounded-full" :src="product.images[0].url" alt='{{product.title}}' />
                      </div>
                      <div class="flex flex-col w-full overflow-x-hidden">
                        <div>
                          <inertia-link :href="'products/'+product.id+'/'" class="group inline-flex space-x-2 truncate">
                            <p class="text-gray-800 truncate group-hover:text-gray-900 text-xm break-normal">
                              {{ product.title }}
                            </p>
                          </inertia-link>
                          </div>
                        <div>
                          <span class='  text-green-700 bg-green-100 py-0.5 px-2.5 text-xxs font-normal'>
                              Active
                            </span>
                        </div>
                        <div>
                          <span class="text-gray-900 font-normal text-xm">1 in Stock</span>
                        </div>
                      </div>
                    </div>
                    <div>
                      <span class="text-gray-900 font-normal text-xm"> $ 100.00 </span>
                    </div>
                  </div>
                  <div class="border-t border-gray-100 -mx-4 my-2"></div>
                </div>
              </div>
                <delete-alert @close="close" @delete="delete_action" v-if="delete_selected" :selected="selected" :open="open_delete"/>
                 <div class="py-3 flex items-center justify-between border-t border-gray-200">
                    <div class="flex-1 flex justify-between sm:hidden">
                      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                      </a>
                      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                      </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                      <div>
                        <p class="text-sm text-gray-700">
                          Showing
                          {{ ' ' }}
                          <span class="font-medium">1</span>
                          {{ ' ' }}
                          to
                          {{ ' ' }}
                          <span class="font-medium">10</span>
                          {{ ' ' }}
                          of
                          {{ ' ' }}
                          <span class="font-medium">{{products.data.length}}</span>
                          {{ ' ' }}
                          results
                        </p>
                      </div>
                      <div>
                        <nav class="relative z-0 inline-flex  -space-x-px" aria-label="Pagination">
                          <a href="#" class="relative inline-flex items-center px-2  text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                          </a>
                          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                          <a href="#" aria-current="page" class="z-10 bg-indigo-500 rounded text-white relative inline-flex items-center px-2">
                            1
                          </a>
                          <a href="#" class="  text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2">
                            2
                          </a>
                          <a href="#" class="  text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-2">
                            3
                          </a>
                          <span class="relative inline-flex items-center px-2   text-gray-700">
                            ...
                          </span>
                          <a href="#" class="  text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2">
                            10
                          </a>
                          <a href="#" class="relative inline-flex items-center px-2  rounded-r-md font-medium text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                          </a>
                        </nav>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>

import { ref } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import axios from "axios"
import { Inertia } from '@inertiajs/inertia'
import { ChevronLeftIcon, ChevronRightIcon, PencilIcon, SearchIcon } from '@heroicons/vue/solid'
import {
  ScaleIcon,PlusIcon, TrashIcon
} from '@heroicons/vue/outline'
import DeleteAlert from './Components/DeleteAlert.vue'

const transactions = [
  {
    id: 1,
    name: 'Payment to Molly Sanders',
    href: '#',
    amount: '$20,000',
    currency: 'USD',
    status: 'success',
    date: 'July 11, 2020',
    datetime: '2020-07-11',
  },
  // More transactions...
]


const cards = [
  { name: 'Account balance', href: '#', icon: ScaleIcon, amount: '$30,659.45' },
  // More items...
]

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
  props: {
            products: Object,
            filters: Object,
            brands: Array,
            categories: Array,
            store: Object
        },
  components: {AppLayout, ScaleIcon, SearchIcon, PlusIcon, TrashIcon,ChevronLeftIcon,ChevronRightIcon,PencilIcon,DeleteAlert},

  data(){
    return{
      selected:[],
      selectedAll:false,
      delete_selected:false,
    }
  },
  methods:{
     select(){
       this.selected =[]
       if (!this.selectedAll){
         for (let i in this.products.data){
           this.selected.push(this.products.data[i].id)
         }
       }
     },
     uncheckBox(id){
       let row = this.selected.filter(p=>p==id);
        if (row.length>0) {
          this.selected = this.selected.filter(p=>p !=id)
        }else{
          this.selected.push(id)
        }
        this.products.data.length == this.selected.length ? this.selectedAll = true : this.selectedAll=false
     },
     close(){
       this.delete_selected = false
        this.selected =[]
        this.selectedAll=false
     },
     delete_action(){
       for (const id of this.selected) {
          console.log(id)
          this.selected =[]
          this.selectedAll=false
        }
      }
  },
  setup() {
    const open = ref(false)
    const suggestions = ref([]);
    const selection = ref('');
    const open_delete = ref(false)
    /* const tabs = ref([
      { name: 'All', href: '#', current: true, id:1 },
      { name: 'Active', href: '#', current: false, id:2 },
      { name: 'Draft', href: '#', current: false, id:3 },
      { name: 'Archived', href: '#', current: false, id:4 }
    ]) */
   /*  function checkAll(){
      selectedAll.value = !selectedAll.value
      selected.value = selectedAll.value ? [...products.data.id]:[]
      console.log(selectedAll.value)
    } */
    /* const uncheckParentBox=(product)=>{
      if (selected.value.includes(product.id)){
        const select = selected.value.filter((s)=>s != product.id)
        selected.value.push(select)
      }
      else{
        selected.value = selected.value.push(product.id)
        console.log(selected.value)
      } */
      //console.log("selected:",selected.value)
      /* let rows = selected.value.filter((s) => s.id == product.id);
      console.log("rows:",rows) */
      /* if (rows.length > 0) {
        selected.value = selected.value.filter((s) => s.id != product.id);
      } else {
        selected.value.push(selected.value);
      }

      products.data.length == selected.value.length ? (selectedAll.value = true) : (selectedAll.value = false);  */
      
    //}
    /* function deleteSelected(){
      let selectedRows = selected.value.map((s) => s.id).join(",");
      this.$inertia.delete(`/products/${selectedRows}`, selectedRows);
    } */
    /* function getAutoCompleteData(term){
      selection.value = term
      if(term.length > 2) {
          axios.get(`/products/get-data?term=${term}`)
            .then(res=>{
                suggestions.value = res.data
            }) 
          }
    } */
/* 
    function updateCurrentList(index){
      const suggestion = suggestions.value.filter(list => list.id == index)
      selection.value = suggestion[0].title;
      suggestions.value= [];
      Inertia.visit(`products/${suggestion[0].id}`)
    }
 */
    /* function currentTab(id){
        for (const tab of tabs.value) {
         if (tab.id == id) {
           tab.current =true
           //console.log(tab.id, id)
         }
         else{
           tab.current = false
         }
       }
    } */
    
    return {
      transactions,
      statusStyles,
      cards,
      //getAutoCompleteData,
      suggestions,
      selection,
      open_delete,
      //updateCurrentList,
      //checkAll,
      //uncheckParentBox,
      //deleteSelected,
      //selected,
      //selectedAll
    }
  },
  async mounted() {
  
  },

}
</script>
<style scoped>
.div-mb {
  margin-top: -2px;
}
.search-field {
  width: 468px;
}
</style>


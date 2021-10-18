<template>
  <app-layout>
    <!-- Page header -->
    <div class="">
      <div class="px- sm:px-6 lg:mx-auto lg:px-">
        <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
          <div class="flex-1 min-w-0">
            <!-- Profile -->
            <div class="flex items-center">
              <div>
                <div class="flex items-center">
                  <h1 class=" ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate" > Orders </h1>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            <inertia-link
              href="orders/create"
              type="button"
              class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
              Create New Order
            </inertia-link>
          </div>
        </div>
          <div class="pb-5 border-b border-gray-200 sm:pb-0">
          <div class="mt-3 sm:mt-4">
            <div class="sm:hidden">
              <label for="current-tab" class="sr-only">Select a tab</label>
              <select id="current-tab" name="current-tab" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
              </select>
            </div>
            <div class="hidden sm:block">
              <nav class="-mb-px flex space-x-8">
                <a v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap pb-1.5 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.current ? 'page' : undefined">
                 <div v-if="tab.name=='All'">
                  <span class="flex"> {{ tab.name }}</span>
                 </div>
                 <div v-else>
                  <span class="flex"> {{ tab.name }} <ChevronDownIcon class="h-5 my-auto ml-2" v-if="!tab.current"/> <ChevronUpIcon class="h-5 my-auto ml-2" v-else/> </span>
                 </div>
                </a>
              </nav>
            </div>
          </div>
          </div>  
          <div class="flex justify-between">
            <div class="relative mt-5">
              <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                  <svg fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
              </span>
              <div class="min-w-0 flex-1">
                <label for="search" class="sr-only">Search</label>
                <input id="text" type="text" placeholder="Search for products..." class="block pl-10 py-2.5 rounded-md border-1 border-gray-300 text-xs text-gray-900 placeholder-gray-500 focus:outline-none bg-transparent"/>
              </div>
            </div>
            <div class="mt-6 flex">
             <!--  <div class="">
                <button class="">
                  <input type="date" name="" id="theDate">
                </button>
              </div> -->
              <datepicker
                v-model="form.from"
                class="date-filter text-black focus:outline-none w-36 rounded-md border-1 border-gray-300"
                date-format="Y-m-d"
                user-format="Y-m-d"
              />
              <arrow-right class="my-auto mx-3"/>
              <!-- <datepicker
                v-model="form.to"
                class="date-filter text-black focus:outline-none w-36 rounded-md border-1 border-gray-300 to"
                date-format="Y-m-d"
                user-format="Y-m-d"
              /> -->
            </div>
          </div>
      </div>
    </div>

    <div class="mt-8">
      <!-- Activity table (small breakpoint and up) -->
      <div class="hidden sm:block">
        <div class="mx-auto px-4 sm:px-6 lg:px-">
          <Search v-bind:suggestions="suggestions"></Search>
          <div class="flex flex-col mt-2">
            <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="w-2 pl-6 pr-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" v-model="selectAll" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" @click="checkAll" :disabled="orders.data.length === 0" />
                    </th> 
                    <th scope="col" class="w-1/12 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                      OrderID
                    </th>
                    <th scope="col" class="w-1/6 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Customer
                    </th>
                    <th scope="col" class="w-1/12 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      To
                    </th>
                    <th scope="col" class="w-1/6 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Items
                    </th>
                    <th scope="col" class="w-1/12 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                      Payment
                    </th>
                    <th scope="col" class="w-1/12 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Fulfillment
                    </th>
                    <th scope="col" class="w-1/6 py-3 px-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Shipping Method
                    </th>
                    <th scope="col" class="w-1/10 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Date Added
                    </th>
                    <!-- <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th> -->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="order in orders.data" :key="order.id" class="bg-white" >
                    <td scope="col" class="w-2 pl-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" :value="order" v-model="selected" @click='uncheckParentBox(order)' class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                    </td> 
                    <td class="w-1/12 pr-7 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider " >
                      {{ order.id }}
                    </td>
                    <td class="w-1/6 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                      {{ order.user.first_name }} {{ order.user.last_name }}
                    </td>
                    <td class="w-1/12 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      {{ order.country }}
                    </td>
                    <td class="w-1/6 px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                      {{order.items.length == 1 ? "1 item": order.items.length + "Items"}}
                    </td>
                    <td class=" w-1/12 px-1 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                      <div class="sm:pr-2 sm:py-2 md:pr-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">
                        <div v-if="!order.status || order.status == 'unpaid'">
                          <div class="text-xs inline-flex leading-5 bg-red-lighter text-red-darker">
                            Unpaid
                          </div>
                        </div>
                        <div v-else>
                          <div class=" text-xs inline-flex leading-5 bg-green-light text-green-darker px-4 py-1">
                            Paid
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="w-1/12 px-1 py-3 text-left text-xs font-semibold tracking-wider">
                      <div v-if="order.fulfillment">
                        <div class=" text-xs px-5 py-1 inline-flex leading-5 bg-red-darker text-red-light ">
                          Unfulfilled
                        </div>
                      </div>
                      <div v-else>
                        <div class=" text-xs px-5 py-1 inline-flex leading-5 bg-green-light text-green-darker" >
                          Fulfilled
                        </div>
                      </div>
                    </td>
                    <td class="w-1/6 py-3 px-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                      {{ order.shipping }}
                    </td>
                    <td class="w-1/10 px-1 py-3 text-left text-xs font-medium text-gray-500 tracking-wider" >
                      {{ order.created_at }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- Pagination -->
              <nav
                class="
                  bg-white
                  px-4
                  py-3
                  flex
                  items-center
                  justify-between
                  border-t border-gray-200
                  sm:px-6
                "
                aria-label="Pagination"
              >
                <div class="hidden sm:block">
                  <p class="text-sm text-gray-700">
                    Showing
                    {{ " " }}
                    <span class="font-medium">1</span>
                    {{ " " }}
                    to
                    {{ " " }}
                    <span class="font-medium">10</span>
                    {{ " " }}
                    of
                    {{ " " }}
                    <span class="font-medium">20</span>
                    {{ " " }}
                    results
                  </p>
                </div>
                <div class="flex-1 flex justify-between sm:justify-end">
                  <a
                    href="#"
                    class="
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border border-gray-300
                      text-sm
                      font-medium
                      rounded-md
                      text-gray-700
                      bg-white
                      hover:bg-gray-50
                    "
                  >
                    Previous
                  </a>
                  <a
                    href="#"
                    class="
                      ml-3
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border border-gray-300
                      text-sm
                      font-medium
                      rounded-md
                      text-gray-700
                      bg-white
                      hover:bg-gray-50
                    "
                  >
                    Next
                  </a>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from 'vue'
import AppLayout from "../../Layouts/AppLayout.vue";
import { ChevronDownIcon,ChevronUpIcon } from "@heroicons/vue/solid"
import Input from '../../Jetstream/Input.vue';
import ArrowRight from '../../../assets/ArrowRight.vue';
// import Datepicker from 'vue3-datepicker'
// import Search from '../Search.vue'
// import axios from "axios"
const tabs = [
  { name: 'All', href: '#', current: true },
  { name: 'Fulfilment', href: '#', current: false },
  { name: 'Payment', href: '#', current: false },
  { name: 'Shipping Method', href: '#', current: false },
  { name: 'Ship to', href: '#', current: false },
  { name: 'Note', href: '#', current: false },
  { name: 'Archived', href: '#', current: false },
]


export default {
  props: {
    orders: Object,
    filters: Object,
  },
  data() {
    return {
      value: [{ name: "Javascript", code: "js" }],
      options: [
        { name: "Vue.js", code: "vu" },
        { name: "Javascript", code: "js" },
        { name: "Open Source", code: "os" },
      ],
      tab: "tab-0",
      search_value: "",
      selected: [],
      selectAll: false,
      itemsPerPage: 50,
      isMouted: false,
      itemsLength: 100,
      currentPage: 0,
      rightPages: [],
      leftpages: [],
      nextPageUrl: "",
      previouPageUrl: "",
      form: {
        search: this.filters.search,
        from: new Date(),
        to: new Date(),
        user: this.filters.user,
      },
      source: {
        international: true,
        domestic: false,
      },
      fullfillment: {
        unfullfilled: true,
        partial: false,
        fulfilled: true,
      },
      payment: {
        paid: true,
        partial: false,
        voided: false,
        pending: true,
        authorized: true,
        refunded: true,
      },
      shipmentMethod: {
        international: true,
        domestic: false,
      },
    };
  },
  mounted(){
  },
  computed: {
    myProps() {
      return { data: this.orders.data, links: this.orders.links };
    },
    rows() {
      return this.itemsPerPage * this.currentPage;
    },
    firstRowOnPage() {
      let rows = this.itemsPerPage * this.currentPage;
      return rows - this.itemsPerPage + 1;
    },
    numberOfPages() {
      return this.itemsLength / this.itemsPerPage;
    },
    showEllipsis() {
      return this.itemsLength / this.itemsPerPage > 7;
    },
    disableNextButton() {
      let lastPage = this.itemsPerPage * this.currentPage;
      return lastPage >= this.itemsLength;
    },
    disablePreviousButton() {
      return this.currentPage === 1;
    },
    numberOfItems() {
      return this.orders.items.length == 1
        ? "1 Item"
        : this.orders.items.length + "Items";
    },
  },
  methods: {
    next() {
      axios.get(this.nextPageUrl);
    },
    previous() {
      axios.get(this.previouPageUrl);
    },
    checkAll() {
      this.selected = !this.selectAll ? [...this.orders.data] : [];
      console.log(this.selectAll, this.customers);
    },
    uncheckParentBox(order) {
      event.stopPropagation();
      //this.selectAll = false;
      //console.log(order)
      let rows = this.selected.filter(p => p.id == order.id);
        if(rows.length > 0) { // unselect
            this.selected = this.selected.filter(p => p.id != order.id);
        }   else { // select
            this.selected.push(order);
        }
        this.orders.data.length == this.selected.length ? this.selectAll = true : this.selectAll = false;

    },
    showCheckedCustomers() {
      console.log(this.customers);
      console.log(this.selected);
    },
    getAllCustomers() {
      this.tab = "tab-0";
    },
    getMarketingCustomers() {
      this.tab = "tab-1";
    },
    getRepeatCustomers() {
      this.tab = "tab-2";
    },
    getProspects() {
      this.tab = "tab-3";
    },
    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      this.value.push(tag);
    },
    toggle(data) {
      data = !data;
    },
    /* checkCurrent(tab){
      //tabs[tab].current = true
      tabs[tab].current = "true"
      console.log(tabs[tab].current)
    }  */
  },
  components: {
    AppLayout,
    ChevronUpIcon,
    ChevronDownIcon,
    Input,
    ArrowRight,
    Datepicker
    // SideNav,
    // ExportIcon,
    // ImportIcon,
    // SaveIcon,
    // SortIcon,
    // DeleteIcon,
    // DeleteSolidIcon,
    // EditIcon,
    // AngleUpIcon,
    // ArrowRight,
    // Pagination,
    // ArrowDownFilled,
    // Multiselect,
    // OrderRow,
    // Badge
  },
  
  setup() {
    const open = ref(false);
    console.log(tabs.selected)
    return {
      tabs,
    }
  },
};
</script>
<style scoped>
select,
.date-filter {
  -moz-appearance: none; /* Firefox */
  -webkit-appearance: none; /* Safari and Chrome */
  appearance: none;
  background: url("../../../assets/ArrowDownFilled.svg") no-repeat right 0.3rem
    center/14px 4px;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  background: none;
}
.v3dp__datepicker {
  --elem-hover-bg-color: var(--vdp-hover-bg-color, #4f46e5);
  --elem-selected-bg-color: var(--vdp-selected-bg-color, #4f46e5);
}
</style>


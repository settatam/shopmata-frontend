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
            <Nav page="General"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                <div class="p-8 bg-white">
                  <h1 class="text-2xl mb-2 font-semibold">General information</h1>
                  <h2 class="text-lg font-semibold mb-9">Store Details</h2>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Store Name
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.name" required/>
                  </div>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Email Address
                      </label>
                      <input type="email"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.account_email" required/>
                    </div>
                    <div class="ml-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Sender Email
                      </label>
                      <input type="email"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.customer_email" required/>
                    </div>
                    
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Store Industry
                    </label>
                    <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.industry_id" required>
                      <option v-for="(industry,index) in industries" :key="index" :value="industry.id">{{industry.name}}</option>
                    </select>
                  </div>
                  <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                  <h2 class="text-lg font-semibold mb-2">Store Address</h2>
                  <p class="w-6/10 text-gray-400 mb-4">This address will appear on your invoices. You can edit the address used to calculate shipping rates in your <span class="text-indigo-700 cursor-pointer">shipping settings</span></p>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Legal Name of Business
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.business_name" required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Phone Number
                    </label>
                    <input type="tel"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.phone"  required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Country
                    </label>
                    <select  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  v-model="store_details.country_id" required>
                      <option v-for="(country,index) in this.countries" :key="index" :value="country.id">{{country.name}}</option>
                    </select>
                  </div>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        City
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  v-model="store_details.city" required />
                    </div>
                    <div class="mx-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        State
                      </label>
                      <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.state_id"  required>
                        <option v-for="(state,index) in states" :key="index" :value="state.id">{{state.name}}</option>
                      </select>
                    </div>
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        ZIP / Postal Code
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.zip"  required/>
                    </div>
                  </div>
                  
                  <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                  <h2 class="text-lg font-semibold mb-2">Standards and Formats</h2>
                  <p class="w-6/10 text-gray-400 mb-4">Standards  and formats are used to calculate product prices, shipping weights, and order times.</p>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Time Zone
                    </label>
                    <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.timezone_id" required>
                      <option value="0">Select Timezone</option>
                      <option v-for="(timezone,index) in timezones" :key="index" :value="timezone.id">{{timezone.text}}</option>
                    </select>
                  </div>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Unit System
                      </label>
                      <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.unit_id"  required>
                        <option v-for="(unit,index) in units" :key="index" :value="unit.id">{{unit.unit}}</option>
                      </select>
                    </div>
                    <div class="ml-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Default Weight Unit
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.default_weight_unit" required/>
                    </div>
                  </div>
                  <h2 class="text-lg font-semibold mb-2">Edit Order ID Format (Optional)</h2>
                  <p class="w-6/10 text-gray-400 mb-4">Standards  and formats are used to calculate product prices, shipping weights, and order times.</p>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Prefix
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.order_id_prefix" required/>
                    </div>
                    <div class="ml-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Suffix
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.order_id_suffix"  required/>
                    </div>
                  </div>
                  <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                  <h2 class="text-lg font-semibold mb-2">Store Currency</h2>
                  <p class="w-6/10 text-gray-400 mb-4">Standards  and formats are used to calculate product prices, shipping weights, and order times.</p>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Store Currency
                    </label>
                    <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_details.currency_id" required>
                      <option v-for="(currency,index) in currencies" :key="index" :value="currency.id">{{currency.symbol_left + ' '}}  {{ currency.title }} ({{ currency.code }})</option>
                    </select>
                    <p class="w-6/10 text-gray-400 mb-4">You have made your first sale, so you need to <span class="text-indigo-700 cursor-pointer">contact support</span> if you want to change your currency</p>
                  </div>
                </div>
                <button class="text-white bg-indigo-700 rounded-md px-8 py-3 float-right my-5" @click="submit">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, reactive } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import Nav from './Nav';
import axios from "axios"
import useVuelidate from '@vuelidate/core'
import { required, email, helpers } from '@vuelidate/validators'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon, ChevronRightIcon,CogIcon  } from '@heroicons/vue/solid';
import { Inertia } from '@inertiajs/inertia'
const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'General Information', href: '/settings/general', current: true },
]

export default {
   props: {
          store: Object, 
          countries: Array, 
          currencies: Array, 
          units: Array,
          industries: Array,
          timezones: Array,
          errors: Object,
          states: Array,
  },
  
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot,ChevronRightIcon,CogIcon 
  },
  
  data() {
    return {
      notification:null,
      
    }
  },
  methods: {
    submit() {
      Inertia.put('/store', this.store_details);
    }
  }, 
mounted() {
    
  },
  setup(props) {
    const open = ref(false)
    const store_details = reactive(props.store)
    const states = props.states
    
    
    return {
      statusStyles,
      store_details,
      states,
      pages
    }
  },
}
</script>

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
        <!-- Secondary sidebar -->
          <div class="flex-1 flex xl:overflow-hidden mt-5">
            <Nav page="General"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-9.5/10 ml-7">
                <div class="p-8 bg-white">
                  <h1 class="text-2xl mb-2 font-semibold">General information</h1>
                  <h2 class="text-lg font-semibold mb-9">Store Details</h2>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Store Name
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="details.name" required/>
                  </div>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Email Address
                      </label>
                      <input type="email"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="details.account_email" required/>
                    </div>
                    <div class="ml-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Sender Email
                      </label>
                      <input type="email"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="details.customer_email" required/>
                    </div>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Store Industry
                    </label>
                    <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="details.industry" required>
                      <option v-for="(industry,index) in this.industries" :key="index">{{industry.name}}</option>
                    </select>
                  </div>
                  <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                  <h2 class="text-lg font-semibold mb-2">Store Address</h2>
                  <p class="w-6/10 text-gray-400 mb-4">This address will appear on your invoices. You can edit the address used to calculate shipping rates in your <span class="text-indigo-700 cursor-pointer">shipping settings</span></p>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Legal Name of Business
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="address.business_name" required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Phone Number
                    </label>
                    <input type="tel"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="address.phone"  required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Country
                    </label>
                    <select  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  v-model="address.country" required @change="stateList">
                      <option v-for="(country,index) in this.countries" :key="index">{{country.name}}</option>
                    </select>
                  </div>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        City
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="address.city" required/>
                    </div>
                    <div class="mx-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        State
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="address.state"  required/>
                       <span v-if="v$.address.state.$error" class="text-red-400">{{v$.address.state.$errors[0].$message}}</span>
                    </div>
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        ZIP / Postal Code
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="address.zip"  required/>
                    </div>
                  </div>
                  
                  <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                  <h2 class="text-lg font-semibold mb-2">Standards and Formats</h2>
                  <p class="w-6/10 text-gray-400 mb-4">Standards  and formats are used to calculate product prices, shipping weights, and order times.</p>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Time Zone
                    </label>
                    <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="standards.timezone" required>
                      <option v-for="(timezone,index) in this.timezones" :key="index">{{timezone.name}}</option>
                    </select>
                  </div>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Unit System
                      </label>
                      <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="standards.unit"  required>
                        <option v-for="(unit,index) in this.units" :key="index">{{unit.unit}}</option>
                      </select>
                    </div>
                    <div class="ml-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Default Weight Unit
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="standards.default_weight_unit" required/>
                      <span v-if="v$.standards.default_weight_unit.$error" class="text-red-400">{{v$.standards.default_weight_unit.$errors[0].$message}}</span>
                    </div>
                  </div>
                  <h2 class="text-lg font-semibold mb-2">Edit Order ID Format (Optional)</h2>
                  <p class="w-6/10 text-gray-400 mb-4">Standards  and formats are used to calculate product prices, shipping weights, and order times.</p>
                  <div class="flex required  mb-4">
                    <div class="mr-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Prefix
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="standards.order_id_prefix" required/>
                    </div>
                    <div class="ml-2 w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Suffix
                      </label>
                      <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="standards.order_id_suffix"  required/>
                    </div>
                  </div>
                  <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                  <h2 class="text-lg font-semibold mb-2">Store Currency</h2>
                  <p class="w-6/10 text-gray-400 mb-4">Standards  and formats are used to calculate product prices, shipping weights, and order times.</p>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Store Currency
                    </label>
                    <select type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="store_currency.currency" required>
                      <option v-for="(currency,index) in this.currencies" :key="index">{{currency.symbol_left + ' '}}  {{ currency.code}}</option>
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

import { ref } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import Nav from './Nav';
import axios from "axios"
import useVuelidate from '@vuelidate/core'
import { required, email, helpers } from '@vuelidate/validators'


import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon, ChevronRightIcon,CogIcon } from '@heroicons/vue/solid'

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
   props: ["store", 'countries', 'currencies', 'units', 'industries', "timezones"],
  
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot,ChevronRightIcon,CogIcon
  },
  
  data() {
    return {
      notification:null,
      details: {
        account_email: "",
        customer_email: "",
        name: "",
        industry: null,
      },
      address: {
        business_name: "",
        phone: "",
        state: "",
        city: "",
        zip: "",
        address: "",
        address2: "",
        country: null,
      },
      standards: {
        timezone: null,
        unit: null,
        default_weight_unit: null,
        order_id_suffix: "",
        order_id_prefix: "",
      },
      store_currency: {
        currency: "",
      },
      statelist:[],
      citylist:[],
      dialCode:[],
    }
  },
  methods: {
    async submit() {
        const {account_email, customer_email, industry, name} = this.details;
        const {business_name, phone, address, address2, state, country, city, zip } = this.address;
        const {default_weight_unit, unit, timezone, order_id_suffix, order_id_prefix } = this.standards;
        const data = {
          name,
          account_email,
          customer_email,
          industry_id: industry.id,
          address: address || "",
          address2: address2 || "",
          business_name: business_name || "",
          city: city || "",
          country_id: country?.id || "",
          currency_id: this.store_currency.currency !== "" ? this.store_currency.currency.id : "",
          default_weight_unit_id: default_weight_unit?.id || "",
          order_id_suffix: order_id_suffix,
          order_id_prefix: order_id_prefix,
          phone: phone || "",
          state: state || "",
          timezone_id: this.standards.timezone !== "" ? this.standards.timezone.id : "",
          unit_id: unit?.id || "",
          zip: zip || ""
        };
        try {
          const res = await axios.put("/settings/general", data);
          const { notification } = res.data;
          this.notification = notification;
          setTimeout(function(){ window.location.reload() }, 2000);
        } catch (error) {
          console.log(error);
          const { notification } = error.response.data;
          this.notification = notification;
        }
      },
      
    /* addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      this.value.push(tag);
    }, */
  },
mounted() {
    const{account_email, customer_email, name, industry_id, phone, country_id, state, city, business_name, zip, address, address2,order_id_suffix, order_id_prefix, default_weight_unit_id, unit_id, timezone, currency_id } = this.store;
    const industry = this.industries.filter(data => data.id === industry_id);
    const country = this.countries.filter(data => data.id === country_id);
    const currency = this.currencies.filter(data => data.id === currency_id);
    const unitSystem = this.units.filter(data => data.id === unit_id);
    const weightUnitSystem = this.units.filter(data => data.id === default_weight_unit_id);
    this.details = {
      account_email: account_email || "",
      customer_email: customer_email || "",
      name: name || "",
      industry: industry[0] || {},
    };
    (this.address = {
      business_name: business_name || "",
      phone: phone || "",
      state: state || "",
      city: city || "",
      zip: zip | "",
      address: address || "",
      address2: address2 || "",
      country: country[0],
    }),
      (this.standards = {
        timezone: timezone || "",
        unit: unitSystem[0] || "",
        default_weight_unit: weightUnitSystem[0].title,
        order_id_prefix: order_id_prefix || "",
        order_id_suffix: order_id_suffix || "",
      }),
      (this.store_currency = {
        currency: currency[0],
      });
  },

  setup() {
    const open = ref(false)
    return {
      statusStyles,
      v$: useVuelidate() ,
      pages
    }
  },

}
</script>


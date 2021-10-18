<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" auto-reopen="true" class="fixed z-10 inset-0 overflow-y-auto" @close="emitClose()">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xlg sm:w-full sm:p-6">
           <div>
                <div class="flex justify-between">
                    <h2 class="text-xl">Create a New Customer</h2>
                    <XIcon class="w-5 h-5 cursor-pointer" @click="emitClose()"/>
                </div>
              <div class=" mt-3 -mx-6 border-t border-gray-300"></div>
             <div class="lg:col-span-2">
            <form action="#" method="POST" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
              <div>
                <label for="first-name" class="block text-warm-gray-900">First name</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="customer.firstname" />
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">Last name</label>
                <div class="mt-1">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="customer.lastname" />
                </div>
              </div>
              <div class=" col-span-2">
                <label for="email" class="block text-sm font-medium text-warm-gray-900">Email</label>
                <div class="mt-1">
                  <input id="email" name="email" type="email" autocomplete="email" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="customer.email" />
                </div>
              </div>
              <div class="mt-4 col-span-2">
                <div class="flex">
                  <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-4 my-auto" v-model="acceptsMail" value="acceptsMail"/>
                  <label for="" class="">Customer accepts email marketing</label>  
                </div>
                <div class="flex mt-3">
                  <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-4 my-auto" v-model="taxExempt" value="taxExempt" />
                  <label for="" class="">Customer is tax exempt</label>
                </div>
              </div>
            </form>
        </div>
      <div class=" mt-6 mb-4 -mx-6 border-t border-gray-300"></div>
      <div>
        <h2 class="text-lg">Shipping Address</h2>
        <form  class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
              <div>
                <label  class="block text-warm-gray-900">Company</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.company" />
                </div>
              </div>
              <div>
                <label  class="block text-warm-gray-900">Phone Number</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                      <div class="absolute inset-y-0 left-0 flex items-center">
                        <label for="country" class="sr-only">Country</label>
                        <select id="country" name="country" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                          <option>US</option>
                          <option>CA</option>
                          <option>EU</option>
                        </select>
                      </div>
                      <input type="text" name="phone-number" id="phone-number" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md" placeholder="+1 (555) 987-6543" v-model="shipping.phone" />
                    </div>
              </div>
               <div>
                <label  class="block text-warm-gray-900">Address</label>
                <div class="mt-1">
                  <input type="text" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.address"/>
                </div>
              </div>
              <div>
                <label  class="block text-warm-gray-900">Apartment, suite etc (optional)</label>
                <div class="mt-1">
                  <input type="text" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.appartment"/>
                </div>
              </div>
              <div>
                <label  class="block text-warm-gray-900">City</label>
                <div class="mt-1">
                  <input autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md border"  v-model="shipping.city"/>
                </div>
              </div>
              <div>
                <label for="last-name" class="block text-warm-gray-900">Country/Region</label>
                <div class="mt-1">
                  <!-- <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" /> -->
                  <select name="" id="" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.country">
                    <option value="">Choose a country</option>
                    <option  v-for="(country,index) in this.countries" :key="index" :value="country.id">{{country.name}}</option>
                  </select>
                </div>
              </div>
               <div>
                <label class="block text-warm-gray-900">State</label>
                <div class="mt-1">
                  <select name="" id="" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.state">
                    <option value="">Choose a state</option>
                    <option  v-for="(state,index) in this.states" :key="index" :value="state.id">{{state.name}}</option>
                  </select>
                </div>
              </div>
              <div>
                <label  class="block text-warm-gray-900">ZIP/Postal Code</label>
                <div class="mt-1">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.zip" />
                </div>
              </div>
            </form>
      </div>
            </div>
              <div class=" mt-3 -mx-6 border-t border-gray-300"></div>
            <div class="mt-5 flex justify-between">
              <button type="button" class="mt-3 w-20 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="emitClose()" ref="cancelButtonRef">
                Close
              </button>
              <button type="button" class="inline-flex w-20 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="submitForm()">
                Apply
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'
import axios from 'axios'


export default {
  emits: ['emitClose'],
   mounted() {
     
      axios.get('/api/countries').then(res => {
            this.countries = res.data.data
      });
    },
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XIcon,
    
  },
  data(){
    return{
      countries: [],
      cities: [],
      city: null,
      states:[],
      customer:{
        firstname:'',
        lastname:'',
        email:'',
      },
      shipping:{
        company:'',
        phone:"",
        address:'',
        appartment:'',
        city:'',
        country:'',
        state:'',
        zip:'',
      },
      acceptsMail:'',
      taxExempt:''
    }
  },
  computed:{
    formData(){
      return{...this.customer, ...this.shipping}
    }},
  methods:{
    emitClose(){
      this.open = false
      this.$emit('emitClose')
    },
    submitForm(){
      this.$inertia.post('/customers', this.formData)
      this.open = false
    }
  },
  watch:{
    'shipping.country'(newVal) {
    //console.log(newVal)
      axios.get(`/api/states?country_id=${newVal}`).then(res=>{
         this.states = res.data.data
         //console.log(this.state)
    }) 
    }
  },
  setup() {
    const open = ref(true)
    const phone = ref(null);
    return {
      open,
      phone,
    }
  },
}
</script>
<style>
.vue-tel-input:focus-within {
  box-shadow: none;
  border-color: #bbb;
}
.vti__input:focus {
  border-color: transparent;
}
</style>
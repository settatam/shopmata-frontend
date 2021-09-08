<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" auto-reopen="true" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
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
                <div class="mt-1">
                   <vue-tel-input v-model="shipping.phone" mode="international"></vue-tel-input>
                  <!-- <input type="tel" name="last-name" id="last-name" autocomplete="family-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" /> -->
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
                    <option  v-for="(country,index) in this.country" :key="index">{{country['name']}}</option>
                  </select>
                </div>
              </div>
               <div>
                <label class="block text-warm-gray-900">State</label>
                <div class="mt-1">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-2 px-2 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-gray-300 rounded-md" v-model="shipping.state" />
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
              <button type="button" class="inline-flex w-20 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="open = false">
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
import { VueTelInput } from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';


export default {
  emits: ['emitClose'],
   mounted() {
      axios.get('https://restcountries.eu/rest/v2/all').then(res => {
            this.country = res.data
      });
    },
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XIcon,
    VueTelInput,
    
  },
  data(){
    return{
      country: [],
      cities: [],
      city: null,
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
      this.$inertia.post('/customers/create', this.formData)
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
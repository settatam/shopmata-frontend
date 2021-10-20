<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto " @close="closeModal()">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full sm:p-6">
            <div>
              <div class="flex justify-between mb-7 ">
                  <div>
                      <p class="text-2xl font-bold">Add a new delivery rate</p>
                      <p class="text-sm mt-4">Select a state and the select cities within that state you can deliver to. Set a delivery rate and how long it will take to deliver items.</p>
                  </div>
                  <x-icon class="h-6 w-6 cursor-pointer" @click="closeModal"/>
              </div>
                <div class="mt-2.5 mb-5 border-t border-gray-200 -mx-8"></div>
                <div class="w-full">
                      <p class="block text-gray-600 font-semibold mb-2 bg-transparent" for="name">
                        Rate Name
                      </p>
                      <input type="text" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="rates.name" required/>
                  </div>
                <div class="w-full">
                      <p class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Rate for
                      </p>
                      <div class=" items-center">
                        <input type="radio" value="1"  class="" v-model="rates.for" name="domestic">
                        <label for="domestic"> Domestic</label>
                      </div>
                      
                      <div class=" items-center">
                        <input type="radio" class="" value="2" v-model="rates.for" name="international">
                        <label for="international"> International</label>
                      </div>
                  </div>

                  </div>
                <div class="w-full">
                      <p class="block text-gray-600 font-semibold mb-2 bg-transparent" for="name">
                        Price
                      </p>
                      <input type="checkbox" name="price" id="">
                      <label for="price">Price is a flat rate for all products and locations</label>
                      <input type="text" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="rates.price" required/>
                  </div>
                <inertia-link href="/settings/shipping-and-delivery/shipping-profile">
                  <p class="text-indigo-500">Add Shipping Profile</p>
                </inertia-link>
                <div class=" flex justify-center lg:justify-between">
                  <button type="button" class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="submit">
                    Save
                  </button>
                  <button type="button" class=" rounded-md border border-gray-500  shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" placeholder="Enter Price" @click="closeModal">
                    Cancel
                  </button>
                </div>
              </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { reactive, ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot,} from '@headlessui/vue'
import{XIcon, SearchIcon} from '@heroicons/vue/solid'
import axios from 'axios'
import Label from '../../../../Jetstream/Label.vue'
//import { Inertia } from '@inertiajs/inertia'


export default {
    emits:['close'],
    props:['rate_options','condition_options'],
    
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    XIcon,
    TransitionRoot,
     SearchIcon,
  },
  methods:{
      closeModal(){
          this.open = false
           this.$emit('close')
      },
      submit(){
        axios.post('')
      }
  },
  setup(props) {
    const open = ref(true)
    //const condition = ref(false)
    /* const shipping_rate = ref('local_shipping')
    const delivery_rate = reactive({state:'',city:'',rate:'',time:"1",note:"",name:"",min_price:0,max_price:0}) */

     /* axios.get(`/api/states?country_id=${newVal}`).then(res=>{
         this.country_state = res.data.data
         console.log(this.country_state)
    })  */
    const conditions = props.condition_options
    const rate = props.rate_options
    const data = ref([{condition:'',rate:'',price:''}])
    const rates = ref({name:'',description:'',price:'',for:''})
    const add = ()=> {
      console.log(data.value)
    	       data.value.push({
                    rate:"",
                    condition:"",
                    price:""
                })
            }

    return {
      open,
      //shipping_rate,
      //delivery_rate,
      //condition,
      conditions,
      rate,
      add,
      data,
      rates
    }
  }
}
</script>
<style scoped>
/* [type="radio"]:checked {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
} */
</style>
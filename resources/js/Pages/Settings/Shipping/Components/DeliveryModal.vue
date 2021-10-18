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
                <!-- <div class="flex-1 flex mb-6">
                    <form class="w-full flex md:ml-0" action="#" method="GET">
                    <label for="search-field" class="sr-only">Search</label>
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none" aria-hidden="true">
                        <SearchIcon class="h-5 w-5 ml-2 text-gray-400" aria-hidden="true" />
                        </div>
                        <input id="search-field" name="search-field" class="block w-full h-full pl-10 pr-3 py-2 border-gray-200 text-gray-900 rounded placeholder-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm" placeholder="Search countries and regions...." type="search" />
                    </div>
                    </form>
                </div> -->
                <!-- <div>
                    <p class="font-semibold">Rates for</p>
                    <div class="flex flex-col justify-items-center">
                       <div class="flex align-middle my-3"> <input type="radio" name="" id="" v-model="shipping_rate" value="local_shipping" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded-sm mr-2.5 mt-1"> Domestic </div>
                        <div class="align-middle flex"> <input type="radio" name="" id="" v-model="shipping_rate" value="global_shipping" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded-sm mr-2.5 mt-1"> Rest of the World </div>
                    </div>
                </div> -->
                <div class="mt-2.5 mb-5 border-t border-gray-200 -mx-8"></div>
                <div class="w-full">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="name">
                        Rate Name
                      </label>
                      <input type="text" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="rates.name" required/>
                  </div>
                <div class="flex">
                  <div class="mr-2 w-full mb-3 relative">
                      <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                        Description
                      </label>
                      <textarea   class="shadow-sm h-36 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Write a delivery note ......." v-model="rates.description" required></textarea>
                      <span class="text-gray-400 absolute bottom-1 right-3">{{rates.description.length}}/120</span>
                    </div>
                </div>
                    <div class="flex flex-col lg:flex-row lg:justify-between">
                            <div class="flex flex-col w-3/10">
                                <label for="tag" class="text-gray-700 lg:mb-4">Options</label>  
                            </div>
                            <div class="flex flex-col w-3/10">
                                <label for="condition" class="text-gray-700 mt-5 lg:mb-4 lg:mt-0">Condition</label>  
                            </div>
                            <div class="flex flex-col w-3.5/10">
                                <label for="condition" class="text-gray-700 mt-5 lg:mb-4 lg:mt-0" >Price</label>  
                            </div>
                        </div>
                      <template v-for="(datum, index) in data" :key="index" >
                        <div class="flex flex-col lg:flex-row lg:justify-between">
                            <div class="flex flex-col w-3/10">
                                <select name="conditions" id="" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" v-model="datum.rate">
                                    <option v-for="(option,index) in rate" :key="index">
                                        {{option.title}}
                                    </option>
                                </select>
                            </div>
                            <div class="flex flex-col w-3/10">  
                                 <select name="conditions" id=""  class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" v-model="datum.condition">
                                    <option v-for="(condition, index) in conditions" :key="index">
                                       {{condition.title}}
                                    </option>
                                </select>
                            </div>
                            <div class="flex flex-col w-3.5/10 mb-2">
                                <input type="text" class="w-full text-xs py-1.5 sm:text-sm rounded-md border-gray-300" v-model="datum.price">
                            </div>
                        </div>
                      </template>
                         <button class="text-gray-700 sm:text-sm rounded-md border border-gray-300 text-xs mb-5 pl-3 pr-6 py-2.5 mt-4" @click="add()">Add another condition</button>
                </div>
                <div class=" flex justify-center lg:justify-end">
                  <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                    Cancel
                  </button>
                  <button type="button" class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="submit">
                    Save
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
    const rates = ref({name:'',description:'',price:''})
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
[type="radio"]:checked {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
}
</style>
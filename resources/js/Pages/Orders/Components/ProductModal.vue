<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" auto-reopen="true" class="fixed z-10 inset-0 overflow-y-auto" :initialFocus="completeButtonRef" @close="open = false">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg px-9 pt-8 pb-4  overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  sm:w-4.5/10">
            <div>
              <div class="mx-auto flex  justify-between">
                  <p class="text-xl">Select Products</p>
                  <XIcon class="w-4 h-4 cursor-pointer" @click="emitClose()"/>
              </div>
              <div class="-mr-9 mt-4 -ml-9 border-b-2 border-gray-200"></div>
              <div class="flex justify-between">
                <div class="relative mt-4">
                  <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                      <svg fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                  </span>
                  <div class="min-w-0 flex-1">
                    <label for="search" class="sr-only">Search</label>
                    <input id="text4" type="text" placeholder="Search for products..." ref="completeButtonRef" class="block pl-10 py-2 rounded-md border border-gray-300 text-xs text-gray-900 placeholder-gray-300 focus:outline-none w-96"/>
                  </div>
                </div>
                <cat-dropdown
                  :label="label"
                  class="mt-4"   
                />
              </div>
              <div class="-mr-9 mt-4 -ml-9 border-b-2 border-gray-200"></div>
              <div>
                <div v-for="product in products" :key="product.id">
                  <div class="flex justify-between h-20">
                    <div class="mr my-auto">
                      <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                    </div>
                    <div class="flex-shrink-0 h-10 w-10 border-2 border-r my-auto">
                       <img :src="product.image" alt="category_image">
                    </div>
                    <div class="w-8/10 my-auto">
                      <p class="text-gray-800 group-hover:text-gray-900 break-normal text-left text-xs">
                        {{product.description}}
                      </p>
                    </div>
                    <div class="my-auto">
                      <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5 cursor-pointer" aria-hidden="true" @click="openVar=!openVar" v-if="openVar" />
                      <ChevronUpIcon class="-mr-1 ml-2 h-5 w-5 cursor-pointer" aria-hidden="true" @click="openVar=!openVar" v-else />
                    </div>
                  </div>
                  <div v-if="openVar && product.variants">
                    <div class="flex justify-between items-center" v-for="(variant,i) in product.variants" :key="i">
                         <!-- <label for="{{variant.color}}" class="sr-only">{{variant.color}}</label> -->
                        <input type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded ml-9" @click="addVariant(variant)"/>
                      
                      <div class="w-6/10">
                        <p class="text-left text-green-600 text-xs">{{variant.color}}</p>
                      </div>
                      <div>
                        <p class="text-xs">{{variant.quantity}} in stock</p>
                      </div>
                      <div class="">
                        <p class="text-left text-xs">${{variant.price}}</p>
                      </div>
                    </div>
                  </div>
                    
                   <div class="-mr-9 mt-2 -ml-9 border-b-2 border-gray-200"></div>
                </div>
              </div>
            </div>
            <div class=" mt-10 sm:mt-10 flex justify-between">
              <button type="button" class="inline-flex rounded-md border border-cyan-500 shadow-sm px-4 py-2 bg-transparent text-cyan-500 sm:text-sm" @click="open = false" v-if="variantSelected.length==0">
                No Variants Selected
              </button>
              <p class="text-cyan-500" @click="open = false" v-else >{{variantSelected.length}} variant selected</p>
              <button type="button" class="inline-flex  rounded-md border bg-cyan-500 shadow-sm px-4 py-2  text-white sm:text-sm">
                Add to Order
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
import { CheckIcon,XIcon,ChevronDownIcon,ChevronUpIcon } from '@heroicons/vue/outline'
import CatDropdown from './CatDropdown.vue'


export default {
  props:["products","variantSelected"],
  emits: ['emitClose'],
  data(){
    return{
      label:"All Products",
      openVar: false,
    }
  },
  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    CheckIcon,
    XIcon,
    CatDropdown,
    ChevronDownIcon,
    ChevronUpIcon
  },
  methods:{
    emitClose(){
      this.open = false
      this.$emit('emitClose')
    },
    //Uncomplwted
    addVariant(variant){
      if (!this.variantSelected.includes(variant)){
          this.variantSelected.push(variant)
      }
      else{
          this.variantSelected
      }
      /* const ifProduct = this.variantSelected.filter (item => item.id == variant.id)
      console.log(ifProduct)
      ifProduct.length > 0 ? this.variantSelected = this.variantSelected.filter(item => {
        console.log(item.id)
        console.log(variant.id)
        item.id != variant.id}) : this.variantSelected.push({...variant, quantityOrdered: 1}) */
      //console.log(this.variantSelected)

    },
  },
  setup() {
    const open = ref(true)
    let completeButtonRef = ref(null);
    return {
      open,
      completeButtonRef,
    }
    
    
  },
}
</script>
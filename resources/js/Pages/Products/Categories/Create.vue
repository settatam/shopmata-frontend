<template>
    <app-layout>
         <div class="">
          <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
            <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
              <div class="flex-1 min-w-0">
                <!-- Profile -->
                <div class="flex items-center">
                  <div>
                    <div class="flex items-center">
                      <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                       New Category
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4 justify-between">
                  <inertia-link href="/categories">
                    <button   class="inline-flex items-center px-6 py-3 border border-cyan-600 shadow-sm rounded-md text-cyan-600 bg-white hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                    Cancel
                    </button>
                  </inertia-link>
                <button  class="inline-flex items-center px-8 py-3 border border-transparent shadow-sm rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500" @click="submitForm()">
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col lg:grid lg:grid-cols-5 lg:gap-x-5 mx-5">
        <!-- Sidebar -->
            <div class="lg:col-start-1 lg:col-span-1">
                <div class="bg-white px-5 pt-4 pb-3">
                    <p class="font-semibold">Collection image</p>
                     <drop-zone class="mt-3"></drop-zone>
                </div>
                <div class="bg-white px-5 py-4  my-4">
                    <p class="font-semibold mt-2">Collection image</p>
                    <p class="text-xs mt-1">Theme template</p>
                    <cat-drop-down
                        :label="theme_template"
                        :options="template_opt"
                    />
                    <p class="text-xxs text-gray-500 mt-2">Assign a template from your current theme to define how the collection is displayed.</p>
                </div>
            </div>
        <!-- Main -->
            <div class="col-start-2 col-span-3">
                <div class="bg-white flex flex-col p-8">
                    <p class="font-semibold">Categories Detail</p>
                    <div class="mt-4">
                        <label for="name" class="block text-sm text-gray-700">Category Name</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="name" class="block w-full pr-10 sm:text-sm rounded-md border-gray-300" v-model="category.name"/>
                        </div>
                    </div> 
                    <div class="mt-5">
                        <label for="description" class="block text-sm text-gray-700">Description</label>
                        <textarea class="shadow-sm block w-full sm:text-sm border border-gray-300 rounded-md h-40" rows="5" v-model="category.description"/>
                    </div>
                    <div class="mt-9">
                        <p class="font-semibold text-lg mb-4">Condition</p>
                        <div class="flex flex-col lg:flex-row lg:justify-between">
                            <div class="flex flex-col w-40">
                                <label for="tag" class="text-gray-700 lg:mb-4">Products must match:</label>  
                                <cat-drop-down
                                    :label="product_tag"
                                    :options="template_opt"
                                    @updateVal="updateTemp($event)"
                                    class="h-5"
                                />
                            </div>
                            <div class="flex flex-col w-36">
                                <label for="condition" class="text-gray-700 mt-5 lg:mb-4 lg:mt-0">all conditions</label>  
                                <cat-drop-down
                                    :label="condition"
                                    :options="condition_opt"
                                    @updateVal ="updateCondition($event)"
                                    class="h-5"
                                />
                            </div>
                            <div class="flex flex-col w-36">
                                <label for="condition" class="text-gray-700 mt-5 lg:mb-4 lg:mt-0" >any condition</label>  
                                <input type="text" class="w-full text-xs py-1.5 sm:text-sm rounded-md border-gray-300" v-model="category.condition">
                            </div>
                        </div>
                            <button class="text-gray-700 sm:text-sm rounded-md border border-gray-300 text-xs mb-5 pl-3 pr-6 py-2.5 mt-4">Add another condition</button>
                    </div>
                    
                </div>
                <div class="bg-white flex flex-col mt-4  p-8">
                    <div class="flex justify-between"  @click="toggle=!toggle">
                        <p class="font-semibold text-lg">Search Engine Listing Preview</p>
                        <ChevronUpIcon class="h-5 my-auto" v-if="toggle"/>
                        <ChevronDownIcon class="h-5 my-auto" v-if="!toggle"/>
                    </div>
                    <div v-if="toggle" class="mt-7">
                        <p class="text-gray-700">Add a title and description to see how this product might appear in a search engine listing</p>
                        <div class="mt-8">
                            <label for="title" class="block text-sm font-medium text-gray-700">Page Title</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="title" id="title" class="block w-full pr-10 sm:text-sm rounded-md border-gray-300" :class="(page.title.length > 70) ?'[border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500]':''"  v-model="page.title" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="(page.title.length > 70)">
                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                </div>
                            </div>
                             <p class="text-gray-500">{{page.title.length}} of 70 characters used</p>
                            <p class="mt-2 text-sm text-red-600" id="title-error" v-if="(page.title.length > 70)">Your title must be less than 70 characters.</p>
                        </div>   
                        <div class="mt-9">
                            <label for="title" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="title" id="title" class="block w-full pr-10 sm:text-sm rounded-md border-gray-300" :class="(page.description.length > 70) ?'[border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500]':''"  v-model="page.description" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="(page.description.length > 70)">
                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                </div>
                            </div>
                             <p class="text-gray-500">{{page.description.length}} of 70 characters used</p>
                            <p class="mt-2 text-sm text-red-600" id="title-error" v-if="(page.description.length > 70)">Your description must be less than 70 characters.</p>
                        </div> 
                        <div class="mt-9">
                            <label for="title" class="block text-sm font-medium text-gray-700">URL and Handle</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="url" id="title" class="block w-full pr-10 sm:text-sm rounded-md border-gray-300 placeholder-gray-500" v-model="page.url" placeholder="https://www.cashinmybag.com/products/"/>
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
import DropZone from './Components/Dropzone.vue'
import CatDropDown from './Components/CatDropdown.vue'
import {ChevronUpIcon,ChevronDownIcon,ExclamationCircleIcon,SelectorIcon} from '@heroicons/vue/solid'

export default {
        data:function(){
            return{
                theme_template: "Default Collection",
                template_opt: {
                    product_title:{
                        title:"Product Title",
                        href:"#"
                    },
                    product_type:{
                        title:"Product Type",
                        href:"#" 
                    },
                    product_price:{
                        title:"Product Price",
                        href:"#"
                    },
                    product_tag:{
                        title:"Product Tag",
                        href:"#"
                    },
                    weight:{
                        title:"Weight",
                        href:"#"
                    }
                },
                condition_opt:{
                    equal:{
                        title:"is equal to",
                        href:"#"
                    },
                    greater:{
                        title:"is greater that",
                        href:"#",
                    },
                    less:{
                        title:"is less than",
                        href:"#"
                    }
                },
                product_tag: "Product tag",
                condition: "is equal to",
                toggle : true,
                page:{
                    description:"",
                    title:"",
                    url:"",
                },
                category:{
                    sort:"",
                    name:"",
                    description:"",
                    tag:"",
                    condition:"",
                    equal:""
                }

            }
        },
        components: {
          AppLayout,
          DropZone,
          CatDropDown,
          ChevronUpIcon,
          ChevronDownIcon,
          ExclamationCircleIcon,
          SelectorIcon
        },
        computed: {
            formData() {
                return {...this.category, ...this.search};
            }
        },
        methods:{
            submitForm(){
                this.$inertia.post('product/categories', this.formData)
            },
            updateTemp(val){
                console.log(val)
                this.category.tag = val
                console.log(this.category.tag)
            },
            updateCondition(val){
                this.category.equal = val
                console.log(this.category.equal)
            }
        }
}
</script>
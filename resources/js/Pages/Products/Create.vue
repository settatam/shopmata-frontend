<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
              <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span>Add a new Product</span>
              </inertia-link>
            </div>
          </nav>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
                <h1 class="text-2xl font-extrabold text-blue-gray-900">Add New Product</h1>
                  <form @submit.prevent="submit">
                    <div class="bg-white mb-10 pt-7">
                        <div class="bg-white flex justify-between px-8 cursor-pointer" @click="expandForm">
                            <p class="text-black text-2xl font-semilbold mb-6">Add Product</p>
                            <span><angle-up-icon ></angle-up-icon></span>
                        </div>
                        <div class="bg-white px-8 pb-6 mb-6" v-if="expand">
                            <!-- <p class="text-black text-2xl font-semilbold mb-6">Update Product</p> -->
                            <div class="mb-10">
                                <label class="block text-black font-semibold mb-2 bg-transparent" for="title">
                                    Title
                                </label>
                                <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none" type="text" placeholder="Cargo Pants" v-model="formFields.title">
                            </div>
                            <div class="mb-6">
                                <label class="block text-black font-semibold mb-2 bg-transparent" for="description">
                                    Description
                                </label>
                                <div class="quill">
                                    <quill-editor
                                        class="editor h-40 text-black"
                                        ref="description"
                                        :value="formFields.description"
                                        :options="editorOption"
                                        @change="onEditorChange"
                                        @blur="onEditorBlur($event)"
                                        @focus="onEditorFocus($event)"
                                        @ready="onEditorReady($event)"
                                    />
                                </div>
                            </div>
                            <div class="mt-20">
                                <label class="block text-black font-semibold mb-2 bg-transparent" for="brand">
                                    Brand
                                </label>
                                <multiselect v-model="formFields.brand" tag-placeholder="" placeholder="Pick a brand" label="name" track-by="name" :close-on-select="true" :options="brands" class="text-xs text-black font-semibold"></multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white mb-10 py-6">
                        <div class="px-8">
                            <div class="bg-white flex justify-between  cursor-pointer" @click="expandMediaForm">
                                <p class="text-black font-semibold text-lg mb-6">Media</p>
                                <div class="flex">
                                <media-url-modal :media="media" ></media-url-modal><span><angle-up-icon></angle-up-icon></span></div>
                            </div>
                            <div v-if="expandMedia">
                                <!-- <vue-dropzone 
                                    ref="mediaFiles" 
                                    id="dropzone" 
                                    :options="dropzoneOptions"
                                    @vdropzone-complete="afterComplete"
                                ></vue-dropzone> -->
                            </div>
                        </div>
                    </div>
                    <pricing-form :pricing="pricing"></pricing-form>
                    <inventory-form :inventory="inventory" :categories="categories"></inventory-form>
                    <shipping-form :shipping="shipping"></shipping-form>
                    <variants-form :variants="variants" :types="variant_types" @added="addOption"></variants-form>
                    <search-engine-form :search="search"></search-engine-form>
                    <div class="text-center bg-white pt-6 pb-6 mb-6">
                        <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent px-11 py-3.5" @click="submit">Add Product</t-button>
                    </div>
                </form>
              </div>
            </div>
            <Nav page="General"></Nav>
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

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon } from '@heroicons/vue/solid'
import hljs from 'highlight.js'
    import InventoryForm from './Components/InventoryForm'
    import ShippingForm from './Components/ShippingForm'
    import VariantsForm from './Components/VariantsForm'
    import SearchEngineForm from './Components/SearchEngineForm'
    import MediaUrlModal from './Components/MediaUrlModal'
    import PricingForm from './Components/PricingForm'
    import UploadIcon from '../../../assets/UploadIcon'
    import AngleUpIcon from '../../../assets/AngleUpIcon'
    import Multiselect from 'vue-multiselect'
    import 'vue-multiselect/dist/vue-multiselect.min.css'

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
            categories: Array
        },
  
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot
  },
  
  data() {
    return {

    }
  },
  setup() {
    const open = ref(false)
    return {
      statusStyles,
    }
  },

}
</script>


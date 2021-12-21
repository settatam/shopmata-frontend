<template>
  <app-layout>
    <div class="flex-1 flex flex-col overflow-y-auto  xl:overflow-hidden">

      <div class="flex-1 flex xl:overflow-auto">
        <!-- Main content -->
        <div class="flex-1 h-full max-h-screen">
          <!-- breadcrumbs -->
          <nav class="flex px-6 mt-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                      <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
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
            <div class="flex justify-between items-center mt-4 px-6">
              <h1 class="text-lg md:text-2xl font-bold text-gray-900">
                Add New Product
              </h1>
              <div class="flex">
                <button type="button" class=" rounded-md border border-indigo-600 mr-4 shadow-sm px-8 md:px-10 py-3 bg-transparent text-base font-medium text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Preview
                  </button>
                  <button type="button" class="hidden md:block rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="submit">
                    Save
                  </button>
              </div>
            </div>
          <div class="mx-auto py-5 md:py-10 px-4 sm:px-6 lg:py-12 lg:px-8 flex justify-between">
           <div class="w-full">

           
              <div class="bg-white mb-3 md:mb-5 pt-4 md:pt-7 rounded">
                <!-- <div class="bg-white flex justify-between px-8 cursor-pointer" @click="expandForm">
                  <span><angle-up-icon></angle-up-icon></span>
                </div> -->
                <div class="bg-white px-4 md:px-8 pb-6 mb-3 md:mb-6">
                  <!-- <p class="text-black text-2xl font-semilbold mb-6">Update Product</p> -->
                  <div class="flex justify-between cursor-pointer" @click="product_open=!product_open">
                    <p class="text-gray-700 font-bold text-lg mb-4">Product Information</p>
                     <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="product_open" />     
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else />     
                  </div>
                  <div v-if="product_open">
                    <div class="mb-10">
                      <label class="block text-sm text-gray-500" for="title">
                        Product Name
                      </label>
                      <div class="mt-1">
                          <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="product.title">
                      </div>
                    </div>
                    <div class="mb-6">
                      <label
                        class="block text-gray-500  mb-2 bg-transparent"
                        for="description"
                      >
                        Product Description
                      </label>
                      <div class="quill">
                        <quill-editor
                          class="editor text-black"
                          ref="description"
                          theme="snow"
                          style="min-height: 102px"
                          :value="product.description"
                          :options="editorOption"
                          @change="onEditorChange"
                          @blur="onEditorBlur($event)"
                          @focus="onEditorFocus($event)"
                          @ready="onEditorReady($event)"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               <!-- Princing Start here -->

            <div class="bg-white pt-4 md:pt-7 pb-1 mb-3 md:mb-5 rounded">
                <div class="flex justify-between px-4 md:px-8 cursor-pointer" @click="price_open=!price_open">
                    <p class="text-black font-semibold text-lg mb-6">Pricing</p>
                    <div>
                       <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="price_open" />     
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else />     
                    </div>
                </div>
                <div class="px-4 md:px-8" v-if="price_open">
                    <div class="mb-5 md:mb-1">
                        <div class="flex flex-wrap">
                            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="number" name="price" id="price" class=" block w-full pl-7 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.price"/>
                                </div>
                            </div> 

                            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                <label for="price" class="block text-sm font-medium text-gray-700">Compare at price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="number" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.compare_at_price"/>
                                </div>
                            </div>   
                            <span class="flex items-center text-gray-400 mt-4">
                              <information-circle-icon class="h-5 w-5 "/> Customers will not see this
                            </span>            
                        </div>
                    </div>
                    
                    <div class="mt-4 mb-3 md:mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-500 transition duration-150 ease-in-out border border-border focus:outline-none" id="charge_tax">
                            <label for="charge_tax" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                Charge tax on this product
                            </label>
                        </div>
                    </div>
                  </div>
              </div>

              <div class="bg-white mb-3 md:mb-5 py-6 rounded">
                <div class="px-4 md:px-8">
                  <div class="bg-white flex justify-between" @click="media_open=!media_open">
                    <p class="text-black font-semibold text-lg mb-6">Media</p>
                    <div>
                       <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="media_open" />     
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else />     
                    </div>
                  </div>
                  <div class="border-b  border-gray-300" v-if="product.images.length && media_open">
                    <li class="flex text-gray-700  justify-between">
                      <p class="w-3/10">Image</p>
                      <p class="w-5/10 border-r border-l border-gray-300 px-6">Description</p>
                      <p class="w-2/10 px-2">Thumbnail</p>
                    </li>
                  </div>
                  <div class="" v-if="media_open">
                    <images-list :images="product.images" v-if="product.images.length" @delete_img="delete_img"/>
                    <Dropzone
                      @add-image="onAddImage"
                      class=""
                    />
                  </div>
                  
                </div>
              </div>

             <!-- Variant Here -->
             <variants-form
                :variants="variants"
                :types="variant_types"
                :valueContent="valueContent"
                :variantList="variantList"
                @added="addOption"
                @add-variant-name="addVariantName"
                @added-variant-value="addVariantValue"
              ></variants-form>

              <!-- Link Starts Here -->
              <div class="bg-white p-4 md:p-8 mb-3 md:mb-5 rounded">
                <div class="flex justify-between cursor-pointer" @click="link_open=!link_open">
                  <p class="text-black font-semibold text-lg mb-6">Link</p>
                   <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="link_open"/>     
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else/>     
                </div>
                <div v-if="link_open">
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="manufacturer">Manufacturer</label>
                    <input type="text" name="manufacturer" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.manufacturer">
                  </div>
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="Collections">Collections</label>
                    <input type="text" name="Collections" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.collections">
                  </div>
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="filters">Filters</label>
                    <input type="text" name="filters" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.filters">
                  </div>
                  <div class="flex flex-col mt-4 text-gray-600">
                    <label for="related">Related Products</label>
                    <input type="text" name="related" id="" class="block w-full pl-7 sm:text-sm border-gray-300 rounded-md" v-model="link.related_products">
                  </div>
                </div>
              </div>
              <!-- Inventory Starts here -->

              <div class="bg-white pt-4 md:pt-7 pb-1 mb-3 md:mb-5 rounded " @click="inventory_open=!inventory_open">
                  <div class="flex justify-between md:px-8 px-4 cursor-pointer">
                      <p class="text-black font-semibold text-lg mb-6">Inventory</p>
                      <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="inventory_open"/>     
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else/>     
                  </div>
                  <div v-if="inventory_open==true" class="md:px-8 px-4">
                      <div class="mb-8">
                          <div class="flex flex-wrap mb-6">
                              <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                  <label class="block text-gray-600  mb-2 bg-transparent" for="avail_qty">
                                      Quantity Available
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="avail_qty" id="avail_qty" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="availabnle qty" v-model="product.avail_qty"/>
                                  </div>
                              </div>
                              <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
                                  <label class="block text-gray-600  mb-2 bg-transparent" for="min_qty">
                                      Minimum Quantity
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="min_qty" id="min_qty" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="min qty" v-model="product.min_qty"/>
                                  </div>
                              </div>
                              <!-- <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                  <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                                      SKU(Stock Keeping Unit)
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="sku" id="sku" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="product sku" v-model="product.sku"/>
                                  </div>
                              </div>
                              <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
                                  <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                                      Barcode (ISBN, UPC, GTIN, etc)
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="barcode" id="barcode" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="product barcode" v-model="product.barcode"/>
                                  </div>
                              </div> -->
                              <div class="mt-8 mb-6">
                                  <div class="flex items-center">
                                      <input v-model="product.track_quantity" type="checkbox" class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border border-border focus:outline-none" id="track_quantity">
                                      <label for="track_quantity" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                          Track Quantity
                                      </label>
                                  </div>
                                  <div class="flex items-center mt-4">
                                      <input v-model="product.out_of_stock" type="checkbox" class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border border-border focus:outline-none" id="out_of_stock">
                                      <label for="out_of_stock" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                          Continue selling when out of stock
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- <p class="text-gray-700 font-semibold text-lg mb-6">Quantity</p>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                              <label class="block text-gray-700 font-semibold mb-2 bg-transparent" for="page-title">
                                  Available
                              </label>
                              <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" placeholder="0" v-model="product.quantity">
                          </div>
                      </div> -->
                  </div>
              </div>

              <!-- Inventory Ends here -->

              <!-- Shipping starts here -->
              
             <!--  <div class="bg-white pt-7 pb-1 mb-10 px-8">
                  <div class="flex justify-between cursor-pointer">
                      <p class="text-black font-semibold text-lg mb-6">Shipping</p>
                      <span><angle-up-icon></angle-up-icon></span>
                  </div>
                  <div class="flex flex-wrap mb-6">
                      <div class="mb-6">
                          <div class="flex items-center">
                              <input v-model="product.physical_product" type="checkbox" id="physical_product" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                              <label for="physical_product" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                  This is a physical product
                              </label>
                          </div>
                      </div>
                  </div>
                  <p class="text-black font-semibold text-lg mb-3">Weight</p>
                  <p class="text-gray-600 pb-4">Used to calculate shipping rates at checkout and label prices during fulfillment.</p>
                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-4/5 px-3 mb-6 md:mb-0">
                          <label class="block text-black font-semibold mb-2 bg-transparent" for="weight">
                              Weight
                          </label>
                          <div class="mt-1 relative rounded-md shadow-sm">
                              <input type="text" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.weight"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.weight !== null ? store.weight.unit : '' }}
                                    </span>
                                  </div>
                              </div>
                      </div>
                  </div>
              </div> -->

              <!-- Shipping ends here -->
            
              <!-- Search Engine Starts Here -->
              <div class="bg-white pt-4 md:pt-7 pb-1 mb-3 md:mb-5 px-4 md:px-8 rounded">
                  <div class="flex justify-between">
                      <div class="cursor-pointer" @click="seo_open=!seo_open">
                          <p class="text-black font-semibold text-lg mb-6">Search Engine Listing Preview</p>
                          <p class="text-gray-600 text-sm mb-6">Add a title and description to see how this product might appear in a search engine listing</p>
                      </div>
                      <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="seo_open"/>     
                      <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else/>     
                  </div>
                  <div v-if="seo_open==true">
                    <div class="my-6">
                        <label class="block text-gray-600 mb-2 bg-transparent" for="page-title">
                            Page title
                        </label>
                        <input :class="[product.seo_page_title.length > 70 ?'focus:ring-red-500 focus:border-red-500':'focus:ring-indigo-500 focus:border-indigo-500' ,'shadow-sm block w-full sm:text-sm border-gray-300 rounded-md']" type="text" placeholder="Short sleeve t-shirt" v-model="product.seo_page_title">
                        <p class="text-gray-500">{{product.seo_page_title.length}} of 70 characters used</p>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 mb-2 bg-transparent" for="search_engine_desc">
                            Description
                        </label>
                        <textarea name="w3review" rows="6" cols="50" :class="[product.seo_description.length > 320 ? 'focus:ring-red-500 focus:border-red-500':'focus:ring-indigo-500 focus:border-indigo-500','block w-full shadow-sm py-3 px-4 placeholder-gray-500  border border-gray-300 rounded-md']" placeholder="" v-model="product.seo_description"/>
                        <p class="text-gray-500">{{product.seo_description.length}} of 320 characters used</p>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 mb-2 bg-transparent" for="url_handle">
                            URL and handle
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm" ref="domain_name">
                                    {{ store.domains[0].name}}/
                                </span>
                            </div>
                            <input type="text" :style="{paddingLeft: domainWidth}" name="handle" id="handle" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" aria-describedby="price-currency" v-model="product.handle"/>
                        </div>
                    </div>
                  </div>
              </div>
              <!-- Search Engine Ends here -->
              <!-- Cancels and Save Button here -->
              <div class="flex justify-between">
                <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                    Cancel
                  </button>
                  <p  class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer focus:ring-indigo-500 sm:text-sm" @click="submit">
                    Save
                  </p>
              </div>
          </div>
          <div class="flex flex-col ml-4 max-w-sm  gap-y-4 w-full">
            <div class="product-type px-7 pt-6 pb-3 bg-white rounded-sm">
              <div>
                <div class="flex">
                  <p class="font-semibold text-lg" >Product Type</p>
                  <Tooltip :tooltipText='product_tooltip'>
                            <question-mark-circle-icon class="w-5 h-5 ml-2 cursor-pointer" />
                  </Tooltip>
                </div>
                <p class="text-gray-700 mt-5 mb-2.5">Choose product type</p>
                <select name="product_type" class="py-2 text-xm px-4 rounded border text-gray-400 border-gray-200 w-full" id="">
                  <option value="default" class="">Default collection</option>
                </select>
                <p class="text-xm text-gray-400 mt-2">Choose the product category that your product belongs to, create a custom product type if your product does not fit into the available product types.</p>
              </div>
            </div>
            <div class="collection-type px-7 pt-6 pb-3 bg-white rounded-sm">
              <div>
                <div class="flex">
                  <p class="font-semibold text-lg" >Collection Type</p>
                  <Tooltip :tooltipText='collection_tooltip'>
                            <question-mark-circle-icon class="w-5 h-5 ml-2 cursor-pointer" />
                  </Tooltip>
                </div>
                <p class="text-gray-700 mt-5 mb-2.5">Choose Collection type</p>
                <select name="collection_type" class="py-2 text-xm px-4 rounded border text-gray-400 border-gray-200 w-full" id="">
                  <option value="default">Default collection</option>
                </select>
                <p class="text-xm text-gray-400 mt-2">Create a collection, then choose the collection to which your product belongs to.</p>
                <div class="flex text-indigo-700 my-4 float-right">
                  <plus-icon class="w-5 h-5 mr-1 "/>
                  <p>Create Collection</p>
                </div>
              </div>
            </div>
            <div class="brand-type px-7 pt-6 pb-3 bg-white rounded-sm">
              <p class="font-semibold text-lg">Brand Type</p>
              <p class="text-gray-700 mt-5 mb-2.5" >Brand name</p>
              <input type="text"  class="py-2 text-xm px-4 rounded border text-gray-400 border-gray-200 w-full" name="brand_tyoe" id="">
              <p class="text-xm text-gray-400 mt-2 mb-4">Choose the brand name of your product, create a custom brand if you cannot find your brand name.</p>
              <div class="flex text-indigo-700 my-4 float-right">
                <plus-icon class="w-5 h-5 mr-1 "/>
                <p>Create Custom Brand</p>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
// import Search from "../Search.vue";
import Nav from "./Components/Nav";
import axios from "axios";

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon,ChevronRightIcon,ChevronDownIcon,ChevronUpIcon,PlusIcon } from "@heroicons/vue/solid";
import { ChartPieIcon,InformationCircleIcon,HomeIcon,QuestionMarkCircleIcon} from "@heroicons/vue/outline";
import hljs from "highlight.js";
import InventoryForm from "./Components/InventoryForm";
import ShippingForm from "./Components/ShippingForm";
import VariantsForm from "./Components/VariantsForm";
import MediaUrlModal from "./Components/MediaUrlModal";
import Dropzone from "./Components/Dropzone";
import ImagesList from "./Components/ImagesList";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
import Tooltip from '../../Components/Tooltip/Components/Tooltip.vue'

// import "vue-multiselect/dist/vue-multiselect.min.css";

const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};

const pages = [
  { name: 'All Product', href: '/products', current: false },
  { name: 'Create New Product', href: '/products/create', current: true },
]

export default {
  props: {
    products: Object,
    filters: Object,
    brands: Array,
    categories: Array,
    store: Object
  },

  components: {
    Nav,
    AppLayout,
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    Multiselect,
    InformationCircleIcon,
    // InventoryForm,
    ShippingForm,
    VariantsForm,
    UploadIcon,
    AngleUpIcon,
    MediaUrlModal,
    Dropzone,
    ImagesList,
    pages,
    ChevronRightIcon,
    ChevronLeftIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    HomeIcon,
    ChartPieIcon,
    Tooltip,
    QuestionMarkCircleIcon,
    PlusIcon
  },

  data() {
    return {
      valueContent: '',
      variantList: [],
      expand: true,
      expandMedia: true,
      content: "",
      seo_open: true,
      inventory_open: true,
      link_open: true,
      price_open: true,
      media_open: true,
      product_open: true,
      pageTitleLength: 0,
      searchEngDescLength: 0,
      domainWidth: '0',
      product_tooltip:"A product type is a categorization that identifies a product and helps users to organize the products in their store.",
      collection_tooltip:"A product type is a categorization that identifies a product and helps users to organize the products in their store.",
      editorOption: {
        modules: {
          toolbar: [
            [{ color: [] }, { background: [] }],
            ["bold", "italic", "underline"],
            [{ list: "ordered" }, { list: "bullet" }],
            ["link", "image", "video"],
            ["clean"],
          ],
          syntax: {
            highlight: (text) => hljs.highlightAuto(text).value,
          },
        },
      },
      product: {
        title: "",
        description: "",
        brand: "",
        images: [],
        price: '',
        compare_at_price: '',
        margin: null,
        profit: null,
        cost_per_item: '',
        handle:'',
        sku: "",
        barcode: "",
        quantity: "",
        track_quantity: false,
        out_of_stock: false,
        has_variants: false,
        avail_qty:"",
        min_qty:"",
        seo_description:'',
        seo_page_title:''
      },
      shipping: {
        weight: "",
        physical_product: false,
      },
      link:{
        filters:"",
        related_products:"",
        manufacture:"",
        collection:""
      },
      variants: {
        has_variants: true,
        is_active: 0,
        options: [
          {
            type: "",
            values: [],
          },
        ],
      },
      files: [],
      showUrlModal: false,
      media: {
        url: "",
      },
    };
  },
  computed: {
    activeDomain() {

    },
    editor() {
      return this.$refs.description?.quill;
    },
    editorContent() {
      return this.$refs.description.$refs.editor.innerHTML;
    },
    variantDetails() {
      return {
        ...this.variants,
        is_active: this.variants.has_variants ? 1 : 0,
      };
    },
  },
  mounted() {
    this.domainWidth = this.$refs.domain_name.clientWidth+10+'px'
  },
  methods: {
    showFormFields() {
      console.log(this.formData);
    },
    addOption(e) {
      this.variants.options.push({
        type: "",
        values: [],
        price: '',
        quantity: '',
        sku:''
      });
    },
    addVariantName(e) {
      let index = e.target.getAttribute('data-index');
      this.variants.options[index].name = e.target.value;
      //console.log(e)
    },
    addVariantValue(e) {
      if(!e) return false;
      let index = e[1];
      let name = e[0]
      this.variants.options[index].values.push(name);
      this.displayVariants();
    },
    addCategory() {
      this.inventory.category.push({
        type: "",
        value: "",
      });
    },
    onAddImage(response) {
      for(let i=0; i<response.data.length; i++) {
        this.product.images.push(response.data[i]);
      }
    },
    handleFileDrop(e) {
      let droppedFiles = e.dataTransfer.files;
      if (!droppedFiles) return;
      [...droppedFiles].forEach((f) => {
        this.files.push(f);
      });
    },
    handleFileInput(e) {
      let files = e.target.files;
      files = e.target.files;
      if (!files) return;
      [...files].forEach((f) => {
        this.files.push(f);
      });
    },
    removeFile(fileKey) {
      this.files.splice(fileKey, 1);
    },
    onEditorChange(editor) {
      console.log(editor.editor);
      // console.log(this.$refs.description.$refs.editor.innerHTML);
    },
    onEditorBlur(editor) {
      // console.log("editor blur!", editor);
    },
    onEditorFocus(editor) {
      // console.log("editor focus!", editor);
    },
    onEditorReady(editor) {
      // console.log("editor ready!", editor);
    },
    showContent() {
      // console.log(this.editorContent);
    },
    upload() {
      // console.log(this.formData);
    },
    delete_img(image){
      this.product.images = image
    },
    submit() {
      // this.sending = true
      this.product.description = this.$refs.description.$refs.editor.innerHTML;
      this.product.variants = this.variantList;
      this.product.variant_options = this.variants.options
      console.log(this.product);
      if (this.product.description==''||this.product.variants=='') {
        alert('Imcomplete Form. Kindly fill')
      } else {
        axios.post('/products', this.product);
      }

      // this.$inertia.post("/products", this.formData);
    },
    afterComplete(file) {
      // console.log(file);
    },
    expandMediaForm() {
      this.expandMedia = !this.expandMedia;
    },
    expandForm() {
      this.expand = !this.expand;
    },
    displayVariants() {
            
            let attributes = this.variants.options
            let total_count = 1;


            // return false

            // a loop can do this 
            if (attributes.length == 1) {
                total_count = attributes[0].values.length
            }else if(attributes.length == 2){
                total_count = attributes[0].values.length * attributes[1].values.length
            }else if(attributes.length == 3){
              total_count = attributes[0].values.length * attributes[1].values.length * attributes[2].values.length
            }

            let g = [];
            let a = 0;
            
            let base_attribute = attributes[0];

            let z = [];

            //initialize variables first

            for (let j = 0; j < total_count; j++) {
              z[j] = [];
            }

            let q = 0;

            //first phase
            let first_attribute = attributes.length == 1 ? 1 : total_count / attributes[0].values.length

            for (let i = 0; i < base_attribute.values.length; i++) {
              for (let k = 0; k < first_attribute; k++) {
                z[q].push(base_attribute.values[i])
                q++;
              }
            }

            if(attributes.length > 1) {
              let second_attributes = total_count / attributes[1].values.length
                q = 0;
                for (let k = 0; k < second_attributes; k++) {
                  for (let i = 0; i < attributes[1].values.length; i++) {
                    z[q].push(attributes[1].values[i])
                    q++;
                  }
                }
            }

            
            if(attributes.length == 3) {
              let third_attributes = total_count / attributes[2].values.length
              q = 0
              for (let k = 0; k < third_attributes; k++) {
                for (let i = 0; i < attributes[2].values.length; i++) {
                  z[q].push(attributes[2].values[i])
                  q++;
                }
              }
            }

            let variantList = [];

            for(let l=0; l<z.length; l++) {
                variantList.push({
                    name: z[l].join(', '),
                    price: '',
                    quantity: 1,
                    sku: ''
                })
            }

           this.variantList = variantList;
        },
  },
  
  setup() {
    const open = ref(false);
    return {
      statusStyles,
      pages
    };
  },
};
</script>
<style scoped>
@import "style.css";
.quill {
  display: flex;
  flex-direction: column;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>


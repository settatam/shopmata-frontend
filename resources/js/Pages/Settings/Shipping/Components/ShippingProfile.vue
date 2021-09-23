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
            <Nav page="Shipping"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
                <div class="w-9.5/10 ml-5">
                    <div class="mb-6">
                        <h1 class="text-2xl font-semibold">Shipping and Delivery</h1>
                         <div class="p-8 mb-6 bg-white">
                             <h2 class="text-xl font-semibold">Create Shipping Profile</h2>
                                <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8 rounded">
                                    <div class="ml-2 w-8/10">
                                        <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                            Profile Name
                                        </label>
                                        <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
                                    </div>
                                </div>
                                <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8 rounded">
                                    <div class="flex justify-between items-center mb-14">
                                        <p class="font-semibold mr-8 text-xl">Products</p>
                                        <p class="text-indigo-700 mr-5">Add Products</p> 
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold mb-4">No Products</p>
                                        <p class="text-gray-500">Move products here to set up separate rates.</p>
                                    </div>
                                </div>
                                    <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8 rounded">
                                        <div class="flex justify-between items-center">
                                            <p class="font-semibold mr-8 mb-4">Shipping From</p>
                                        </div>
                                            <div class="flex justify-between">
                                                <location-marker-icon class="w-5 h-5 mr-1 pt-2"/>
                                                <div>
                                                    <p class="font-semibold">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                                                    <p class="text-gray-500">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                                                </div>
                                                <p class="text-indigo-700 mr-5 cursor-pointer">Manage</p> 
                                            </div>
                                    </div>
                                    <div class="mt-6 border border-gray-300 pt-5 pl-8 pr-5 flex-col rounded">
                            <div class="flex justify-between mt-4 mb-2">
                                <h3 class="font-semibold text-xl">Shipping to</h3>
                                <inertia-link href="" class="text-indigo-700  cursor-pointer">Create Shipping zone</inertia-link>
                            </div>
                            <div class="flex w-3/4">
                                <div class="mr-2 mt-1"><img src="../../../../../assets/nigeria-flag.svg" alt="nigeria-flag"></div>
                                <div class="flex-col">
                                    <p class="pt-0 mt-0">Domestic</p>
                                    <p class="text-gray-400">Nigeria</p>
                                </div>
                            </div>
                            <div>
                                <div class="flex-col mt-2">
                                    <div class="flex justify-between">
                                        <div class="w-3/6">Rate name</div>
                                        <div class="w-1/6 text-center">Condition</div>
                                        <div class="w-1/6 text-center">Price</div>
                                        <div class="w-1/7 text-center invisible">...</div>
                                    </div>
                                    <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                                    <div class="flex text-gray-400 justify-between mt-1">
                                        <div class="w-3/6">Standard</div>
                                        <div class="w-1/6 text-center">-</div>
                                        <div class="w-1/6 text-center">Free</div>
                                        <div class="w-1/7 text-center">...</div>
                                    </div>
                                </div>
                                <button class="mt-4 w-28 h-14 mb-3 bg-gray-100">Add Rate</button>
                            </div>
                            <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                            <div class="flex w-3/4 mt-4">
                                <div class="mr-2 mt-1"><img src="../../../../../assets/globe.svg" alt="globe"></div>
                                <div class="flex-col">
                                    <p class="pt-0 mt-0">Rest of World</p>
                                    <p class="text-gray-400">Rest of World</p>
                                </div>
                            </div>
                                <div>
                                    <div class="flex-col mt-2">
                                        <div class="flex justify-between">
                                            <div class="w-3/6">Rate name</div>
                                            <div class="w-1/6 text-center">Condition</div>
                                            <div class="w-1/6 text-center">Price</div>
                                            <div class="w-1/7 text-center invisible">...</div>
                                        </div>
                                        <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                                        <div class="flex text-gray-400 justify-between mt-1">
                                            <div class="w-3/6">Standard</div>
                                            <div class="w-1/6 text-center">-</div>
                                            <div class="w-1/6 text-center">Free</div>
                                            <div class="w-1/7 text-center">...</div>
                                        </div>
                                    </div>
                                    <button class="mt-4 w-28 mb-5 h-14 bg-gray-100">Add Rate</button>
                                </div>       
                                    </div>
                                    <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8  rounded">
                                    <div class="flex justify-between items-center mb-14">
                                        <p class="font-semibold mr-8">Shipping To</p>
                                        <p class="text-indigo-700 mr-5">Create Shipping zone</p> 
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold mb-4">No zones or rates </p>
                                        <p class="text-gray-500">Add zones to create rates for places you want to ship to.</p>
                                    </div>
                                </div>
                                 </div>
                            </div>
                            <div class="flex justify-end">
                                <button class="text-gray-500 bg-transparent border border-gray-500 rounded-md px-8 py-3  my-5" >Cancel</button>
                                <button class="text-white bg-indigo-700 rounded-md px-8 py-3 my-5 ml-5" >Save</button>
                            </div>
                </div>
            </div>
         </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../../../Layouts/AppLayout.vue'
import Nav from '../../Nav';
import {LocationMarkerIcon,ChevronRightIcon,CogIcon} from '@heroicons/vue/outline'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Shipping and Delivery', href: '/settings/shipping-and-delivery', current: false },
  { name: 'Shipping Profile', href: '/settings/shipping-and-delivery/shipping-profile', current: true },
]
export default {
     components: {
        Nav,
        AppLayout,
        LocationMarkerIcon,ChevronRightIcon,CogIcon
    }, 
    setup(){
        return{
            pages
        }
    }
}
</script>

<style>
</style>
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
              <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <button   class="inline-flex items-center px-6 py-3 border border-cyan-600 shadow-sm rounded-md text-cyan-600 bg-white hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  Cancel
                </button>
                <button  class="inline-flex items-center px-8 py-3 border border-transparent shadow-sm rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-5 gap-x-5 mx-5">
            <div class="col-start-1 col-span-1">
                <div class="bg-white px-5 pt-4 pb-3">
                    <p class="font-semibold">Collection image</p>
                     <drop-zone class="mt-3"></drop-zone>
                </div>
                <div class="bg-white px-5 pt-4 mt-4">
                    <p class="font-semibold">Collection image</p>
                    <p class="text-xs">Theme template</p>
                    <cat-drop-down/>
                    <p class="text-xxs">Assign a template from your current theme to define how the collection is displayed.</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '../../../Layouts/AppLayout.vue'
import DropZone from './Components/Dropzone.vue'
import CatDropDown from './Components/CatDropdown.vue'

export default {
      components: {
          AppLayout,
          DropZone,
          CatDropDown,
        },
}
</script>
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
                        All Categories
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <inertia-link href="categories/create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  Create Category
                </inertia-link>
              </div>
            </div>
          </div>
        </div>
         <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                        </th> 
                        <th scope="col" class="w-3/10  px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          TITLE
                        </th>
                        <th scope="col" class=" w-3/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          PRODUCT CONDITION
                        </th>
                        <th scope="col" class="w-1/5 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                          SORT ORDER
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr class="bg-white">
                        <td scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                        </td> 
                       <td class="w-3/10 px-6 py-4 items-center whitespace-nowrap text-gray-900">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 mr-5 border-2 border-r border-dashed">
                              image
                            </div>
                            <inertia-link href="#" class="group inline-flex space-x-2 truncate">
                              <p class="text-gray-800 truncate group-hover:text-gray-900 break-normal">
                                Best Selling Products 
                              </p>
                            </inertia-link>
                          </div>
                        </td>
                        <td class=" w-3/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <p class="text-gray-800 truncate text-left break-normal">Product title contains best selling</p>  
                        </td>
                        <td class="w-1/5 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          <p  class="text-gray-800 truncate text-center break-normal">
                           5
                          </p>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <p class="truncate text-left break-normal text-cyan-800">Edit</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- Pagination -->
                  <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
                    <div class="hidden sm:block">
                      <p class="text-sm text-gray-700">
                        Showing
                        {{ ' ' }}
                        <span class="font-medium">1</span>
                        {{ ' ' }}
                        to
                        {{ ' ' }}
                        <span class="font-medium">10</span>
                        {{ ' ' }}
                        of
                        {{ ' ' }}
                        <span class="font-medium">20</span>
                        {{ ' ' }}
                        results
                      </p>
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end">
                      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                      </a>
                      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                      </a>
                    </div>
                  </nav>
                </div>
              </div>
    </app-layout>
</template>
<script>

import { ref } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
export default {
      components: {AppLayout},
}
</script>
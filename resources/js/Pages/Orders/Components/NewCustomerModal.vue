<template>
  <div>
      <div class="flex justify-between">
          <h2 class="text-xl">Create a New Customer </h2>
          <XIcon class="w-5 h-5"/>
      </div>
      <div class=" mt-3 -mx-6 border-t border-gray-300"></div>
      <div class="py-10 px-6 sm:px-10 lg:col-span-2 xl:p-12">
        <form action="#" method="POST" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
          <div>
            <label for="first-name" class="block text-sm font-medium text-warm-gray-900">First name</label>
            <div class="mt-1">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-warm-gray-300 rounded-md" />
            </div>
          </div>
          <div>
            <label for="last-name" class="block text-sm font-medium text-warm-gray-900">Last name</label>
            <div class="mt-1">
              <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-warm-gray-300 rounded-md" />
            </div>
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-warm-gray-900">Email</label>
            <div class="mt-1">
              <input id="email" name="email" type="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-teal-500 focus:border-teal-500 border-warm-gray-300 rounded-md" />
            </div>
          </div>
          <div class="mt-4">
            <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-3" />
            <label for="" class="text-xs">Customer accepts email marketing</label>
          </div>
          <div class="mt-4">
            <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-3" />
            <label for="" class="text-xs">Customer is tax exempt</label>
          </div>
        </form>
      </div>
      <div class=" mt-3 -mx-6 border-t border-gray-300"></div>
      <div>
        <h2 class="text-lg">Shipping Address</h2>
        <!-- 
            <div class="sm:col-span-2">
            <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 flex items-center">
                <label for="country" class="sr-only">Country</label>
                <select id="country" name="country" class="h-full py-0 pl-4 pr-8 border-transparent bg-transparent text-gray-500 focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                  <option>US</option>
                  <option>CA</option>
                  <option>EU</option>
                </select>
              </div>
              <input type="text" name="phone-number" id="phone-number" autocomplete="tel" class="py-3 px-4 block w-full pl-20 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" placeholder="+1 (555) 987-6543" />
            </div>
          </div>


         -->
      </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline'
export default {
  components: {
    XIcon,
  },
}
</script>

<style>
</style>
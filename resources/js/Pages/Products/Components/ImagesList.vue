<template>
  <ul role="list" class="divide-y divide-gray-200 w-100">
    <li v-for="image in images" :key="image.id" class="flex justify-between border-b  border-gray-300 ">
      <div class="w-3/10">
        <img class="h-10 w-10" :src="image.thumb" alt="" />
      </div>
      <div class=" flex-grow w-5/10 ">
        <div class="  border-r border-l px-6 border-gray-300 ">
          <input type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-2" placeholder="Write a description">
        </div>
      </div>
      <div class="flex items-center px-2 justify-around w-2/10">
        <input type="radio" name="image" id="" class="w-5 h-5">
        <TrashIcon class="w-6 h-6"/>
      </div>
    </li>
  </ul>
</template>

<script>
import {TrashIcon} from '@heroicons/vue/outline'

export default {
  components:{
    TrashIcon
  },
  props: {
    images: Array
  },
  setup() {
    // return {
    //   people,
    // }
  },
}
</script>
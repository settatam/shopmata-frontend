<template>
  <ul role="list" class="divide-y divide-gray-200 w-100">
    <li v-for="image in images" :key="image.id" class="py-4 flex">
      <img class="h-10 w-10" :src="image.thumb" alt="" />
      <div class="ml-3 flex-grow">
        <input type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Alt / Title Tags">
      </div>
    </li>
  </ul>
</template>

<script>


export default {
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
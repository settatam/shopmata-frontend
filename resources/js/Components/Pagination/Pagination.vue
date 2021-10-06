<template>
  <div class="mt-6 mb-1 flex md:flex-wrap md:justify-end justify-center">
    <template v-for="(link, key) in links">
      <div v-if="link.url === null" :key="key" class="flex items-center mr-1 mb-1 px-3 py-2 text-sm border text-gray-600">
        <prev-icon v-if="link.label === 'Previous'"></prev-icon>
        <next-icon v-if="link.label === 'Next'"></next-icon>
      </div>
      <template v-else>
        <inertia-link v-if="link.label !== 'Previous' && link.label !== 'Next'" :key="key" class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-200" :class="{ 'bg-purple-darker text-white': link.active }" :href="link.url">{{ link.label }}</inertia-link>
        <inertia-link v-if="link.label === 'Next' || link.label === 'Previous'" :key="key" class="flex items-center mr-1 mb-1 px-3 py-2 text-sm border border-gray-200" :class="{ 'bg-purple-darker text-white': link.active }" :href="link.url">
          <prev-icon v-if="link.label === 'Previous'" :fill="'#212121'"></prev-icon>
          <next-icon v-if="link.label === 'Next'" :fill="'#212121'"></next-icon>
        </inertia-link>
      </template>
    </template>
  </div>
</template>

<script>
import NextIcon from '../../../assets/NextIcon';
import PrevIcon from '../../../assets/PrevIcon';
export default {
  props: {
    links: Array,
  },
  components: {
    NextIcon,
    PrevIcon
  }
}
</script>

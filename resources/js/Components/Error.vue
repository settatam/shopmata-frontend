<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-red-50 border-l-4 border-red-400 p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <ExclamationIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
      </div>
      <div class="ml-3">
        <p class="text-sm text-red-700">
          {{message}}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { ExclamationIcon } from '@heroicons/vue/solid'
import { ref } from '@vue/reactivity'

export default {
    props:{msg:String},
  components: {
    ExclamationIcon,
  },
  setup({msg}){
      const message = ref((msg))
    return {
        message
    }
  }
}
</script>
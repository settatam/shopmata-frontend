<template>
    <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton class="flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 pt-2.5 pb-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none text-xs h-10.5">
            {{label}}
        <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
      </MenuButton>
    </div>

    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="origin-top-left absolute left-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-2">
          <MenuItem v-slot="{ active }" v-for="(option,index) in options" :key="index">
            <p :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" @click="emitValue(option.title)">{{option.title}}</p>
          </MenuItem>
         </div>
      </MenuItems>
    </transition>
  </Menu>  
</template>
<script>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'
export default {
    props:['label','options','updateVal'],
    components: {
          Menu,
          MenuButton,
          MenuItem,
          MenuItems,
          ChevronDownIcon,
        },

      data(){
        return{
          
        }
      },
      methods:{
        emitValue(val){
          this.$emit('updateVal', val)
        }
      }
}
</script>
<template>
    <div class="mt-6 flex space-x-4">
        <div class="flex-1 min-w-0">
            <label for="search" class="sr-only">Search</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <input type="search" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search" autocomplete="off" @input="handleInput" v-model="selection" @keydown.enter = 'enter'
            @keydown.down = 'down' @keydown.up = 'up'/>
            <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95">
                <div class="absolute bg-white" v-show="suggestions.length">
                    <ul>
                        <li class="p-3 cursor-pointer hover:bg-gray-100"
                            v-for="(list,index) in suggestions" :key="list.id"
                            v-bind:class="{'bg-gray-100': isActive(index)}"
                            @click="setList(list.id)"
                            >
                            {{list.title}}
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </div>
    <button type="submit" class="inline-flex justify-center px-3.5 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <FilterIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        <span class="sr-only">Search</span>
    </button>
</div>
</template>

<script>
import {onMounted, onUnmounted, ref, reactive} from 'vue';
import {
  SearchIcon,
} from '@heroicons/vue/solid'
import {
  FilterIcon
} from '@heroicons/vue/outline'
export default {
    props: {
        suggestions: {
            type: Array,
            required: true
        },
        selection: {
            type: String,
            required: true,
            // twoWay: true
        }
    },

    emits: ['autocomplete', 'update-current-list'],

    components: {
        SearchIcon,
        FilterIcon
    },
    // computed: {
    //     matches() {
    //         return this.suggestions.filter((str) => {
    //             return str.indexOf(this.selection) >= 0;
    //         });
    //     },
    //     openSuggestion() {
    //         return this.selection !== "" &&
    //                this.matches.length != 0 &&
    //                this.open === true;
    //     }
    // },
    // methods: {
    //     enter() {
    //         this.selection = this.matches[this.current];
    //         this.open = false;
    //     },
    //     up() {
    //         if(this.current > 0)
    //             this.current--;
    //     },
    //     down() {
    //         if(this.current < this.matches.length - 1)
    //             this.current++;
    //     },
    //     isActive(index) {
    //         return index === this.current;
    //     },
    //     change() {
    //         if (this.open == false) {
    //             this.open = true;
    //             this.current = 0;
    //         }
    //     },
    //     suggestionClick(index) {
    //         this.selection = this.matches[index];
    //         this.open = false;
    //     },
    // },

    setup(props, {emit}) {
        let open = ref(false)
        let current = ref(0);
        let select = props.selection;
        const a = props.suggestions;
        console.log(props.suggestions)

        const closeOnEscape = (e) => {
            // console.log(a.length)
            if (a.length && e.keyCode === 27) {
                emit('empty-suggestions');
            }
        }

        function handleInput(evt){
            let term = evt.target.value
            emit('autocomplete', term);
        }
        
        function enter() {
            emit('update-current-list', props.suggestions[current.value].id);    
        }
        
        function up() {
            if(current.value > 0)
                current.value--;
        }
        
        function down() {
            if(current.value < props.suggestions.length - 1)
                current.value++;              
        }

        function isActive(index) {
            return index === current.value;
        }

        function setList(id){
            emit('update-current-list', id);
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

        return {
            open,
            handleInput,
            a,
            up,
            down,
            enter,
            current,
            select,
            isActive,
            setList
        }
    },
}
</script>
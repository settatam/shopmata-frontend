<template>
    <form class="mt-6 flex space-x-4" action="#">
        <div class="flex-1 min-w-0">
            <label for="search" class="sr-only">Search</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <input type="search" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search" autocomplete="off" @input="handleInput"/>
            <div class="absolute bg-white">
                <ul>
                    <li class="p-3">Example one</li>
                    <li class="p-3">Example two</li>
                </ul>
            </div>
        </div>
    </div>
    <button type="submit" class="inline-flex justify-center px-3.5 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <FilterIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        <span class="sr-only">Search</span>
    </button>
</form>
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
    data() {
        return {
            open: false,
            current: 0,
            suggest: [
                {
                    title: 'Example One',
                },
                {
                    title: 'Example Two',
                },

            ]
        }
    },
    props: {
        suggestions: {
            type: Array,
            required: true
        },
        selection: {
            type: String,
            required: true,
            twoWay: true
        }
    },

    components: {
        SearchIcon,
        FilterIcon
    },
    computed: {
        matches() {
            return this.suggestions.filter((str) => {
                return str.indexOf(this.selection) >= 0;
            });
        },
        openSuggestion() {
            return this.selection !== "" &&
                   this.matches.length != 0 &&
                   this.open === true;
        }
    },
    methods: {
        enter() {
            this.selection = this.matches[this.current];
            this.open = false;
        },
        up() {
            if(this.current > 0)
                this.current--;
        },
        down() {
            if(this.current < this.matches.length - 1)
                this.current++;
        },
        isActive(index) {
            return index === this.current;
        },
        change() {
            if (this.open == false) {
                this.open = true;
                this.current = 0;
            }
        },
        suggestionClick(index) {
            this.selection = this.matches[index];
            this.open = false;
        },
    },

    setup() {
        let open = ref(false)

        const closeOnEscape = (e) => {
            if (open.value && e.keyCode === 27) {
                open.value = false
            }
        }

        const a = ref([]);

        function handleInput(evt){
            let term = evt.target.value
            
            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            axios.get(`/products/getData?term=${term}`, )
                .then(res=>{
                    console.log(res)
                })
        }

        // axios.get(`/products/getData?term=${term}`, )

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

        return {
            open,
            handleInput
        }
    },
}
</script>
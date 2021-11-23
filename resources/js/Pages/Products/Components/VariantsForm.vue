<template>
    <div class="bg-white pt-7 pb-1 mb-10">
        <div class="flex justify-between px-8 cursor-pointer" @click="variant_open=!variant_open">
            <p class="text-black font-semibold text-lg mb-6">Variants</p>
            <div>
                <chevron-up-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-if="variant_open" />     
                <chevron-down-icon class="h-5 w-5 text-indigo-700 cursor-pointer" v-else />     
            </div>
        </div>
        <div v-if="variant_open">
            <div class="flex flex-wrap mb-6">
            <div class="px-8">
                <div class="flex flex-wrap -mx-3">
                    <div class="-mx-3 px-8">
                        <div class="flex items-center">
                        <input v-model="variants.has_variants" type="checkbox" id="has_variants" class="form-checkbox cursor-pointer rounded-sm h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border border-border focus:outline-none">
                        <label for="has_variants" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                            This product has multiple options, like different sizes or colours
                        </label>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <template v-if="variants.has_variants">
                <p class="text-black font-semibold text-lg px-8">Options</p>
                <div v-for="(option, index) of variants.options" :key="index" class="mx-8 mb-6" :data-index="index">
                    <p class="text-gray-600 pt-4 pb-1">Option {{index+1}}</p>
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                            <input class="shadow-sm focus:ring-transparent focus:border-gray-300 block w-full sm:text-sm border-gray-300 rounded-md" v-model="option.type" type="text" :data-index="index" @blur="setVariant">
                        </div>
                        <div class="w-1/2">
                            <!-- <span class="inline-flex items-center p-px rounded-l-md border-r-transparent border focus:border-r-0 focus:outline-none  border-gray-300 text-gray-500 sm:text-xm overflow-x-scroll">
                                <span class="inline-flex rounded-full items-center m-2  py-0.5 pl-2.5 pr-1 text-sm font-medium bg-indigo-100  text-indigo-700" v-for="(item, i) in option.values" :key="i"> {{item}}
                                    <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500" @click="removeItem(index, i)">
                                        <span class="sr-only"> Remove {{item}} option</span>
                                            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                            </svg>
                                    </button>
                                </span>
                            </span> -->
                         <!-- <input type="text" name="values[]" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="separate options with a comma" @blur="addVariantValue" :data-index="index" v-model="valueContent" @keypress.,='addVariantValue'/>  -->
                         <!-- <div class="tag-input relative">
                            <input v-model="newTag" type="text"  class="w-full p-2.5 absolute top-0 bottom-0 left-2.5" @keypress.,='addTag(newTag)'/>
                            <ul class="tags list-none flex items-center gap-2 overflow-x-auto z-40">
                                <li v-for="(tag, index) in tags" :key="tag" class="tag bg-indigo-400 p-1 rounded whitespace-nowrap transition">
                                {{ tag }}
                                <span @click='removeTag(index)'>x</span>
                                </li>
                            </ul>
                        </div> -->
                        <TagInput v-model="tags" @blur="addVariantValue" />
                        </div>
                       <!--  <div class="tag-input">
                            <div v-for="(tag, index) in tags" :key="index" class="tag-input__tag">
                                {{ tag }}
                                <span @click='removeTag(index)'>x</span>
                            </div>
                            <input type="text" placeholder="Enter a Tag" @keypress.enter='addTag'  @keypress.,='addTag'  @keypress.esc='removeLastTag' class="tag-input__text" />
                        </div> -->

                    </div>
                </div>
                <t-button v-if="variants.options.length<3" class="text-white  rounded bg-indigo-600 active:bg-indigo-600 text-sm font-medium cursor-pointer border border-transparent float-right mr-8 px-4 py-3 mb-6" v-model="newVariant" @click="added">Add another option</t-button>
                
                 <!-- list variants -->
                <div class="py-6">
                    <div class="grid grid-cols-4 md:px-8 lg:px-8 xl:px-8 min-w-full py-2">
                        <div class="col-span-1 font-semibold ">
                            Variant
                        </div>
                        <div class="col-span-1 font-semibold ">
                            Price
                        </div>
                        <div class="col-span-1 font-semibold ">
                            Quantity
                        </div>
                        <div class="col-span-1 font-semibold ">
                            Sku
                        </div>
                    </div> 
                    <div class="grid grid-cols-4 md:px-8 lg:px-8 xl:px-8 min-w-full py-2" v-for="(el, index) in variantList" :key="index">
                        <div class="col-span-1 font-semibold mr-2">
                        {{ el.name }}
                        </div>
                        <div class="col-span-1 font-semibold mr-2">
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="$ 0.00" type="text" v-model="variantList[index].price">
                        </div>
                        <div class="col-span-1 font-semibold mr-2">
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="0" type="Number" v-model="variantList[index].quantity">
                        </div>
                        <div class="col-span-1 font-semibold ">
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text" v-model="variantList[index].sku">
                        </div>
                    </div>
                
                </div>

            </template>
        </div>
    </div>
</template>

<script>
import AngleUpIcon from '../../../../assets/AngleUpIcon'
import {ChevronUpIcon,ChevronDownIcon} from '@heroicons/vue/solid'
import TagInput from './TagInput.vue'
import {ref} from 'vue'
export default {
    name: 'variants-form',
    props: ['variants', 'types', 'addOption', 'variantList'],
    components: {
        AngleUpIcon,
        TagInput,
        ChevronUpIcon,
        ChevronDownIcon
    },
    emits: ['added', 'added-variant-name', 'added-variant-value'],
    data() {
        return {
            variant_open: true,
            newVariant: "",
             variantList: []
            //tags: []
        }
    },
    methods: {
        added(e) {
            e.preventDefault();
            this.$emit('added');
        },
        setVariant(e){
            this.$emit('added-variant-name', e);
        },
        addVariantValue(e){
            this.$emit('added-variant-value', e);
            this.valueContent = ''
        },
        expandForm() {
            this.expand = !this.expand;
        },
        pushVariant(i){
            const newVariant = this.$refs.editable[0].innerText
            const regex = "^\\s+$";
            if(newVariant.match(regex) === null && newVariant !== ""){
                this.variants.options[i].values.push(newVariant)
                this.doVariantList()
                // this.$refs.editable[0].innerText = ""
            }
            // if(this.newVariant !== ""){
            //     this.variants.options[i].values.push(this.newVariant)
            //     this.newVariant = "";
            //     this.doVariantList()
            // }
        },
        doVariantList(){
            let maxLength = 0;
            let variantList = []
            this.variants.options.forEach(element => {
                if(element.values.length > maxLength) maxLength = element.values.length
            });
            if(this.variants.options.length > 1){
                this.variants.options[0].values.forEach(el => {
                    for (let index = 0; index < maxLength-1; index++) {
                        variantList.push({
                            name: `${el}/${this.variants.options[1] ? this.variants.options[1].values[index] || "" : ""}/
                                ${this.variants.options[2] ? this.variants.options[2].values[index] || "" : ""}`,
                            price: 0,
                            quantity: 0,
                            sku: ""
                        })
                        
                    }
                })
            }
            // this.variantList = variantList
            /*
        let attributes = [];
        attributes.push({
            name: "color",
            values: ["red", "green", "blue"],
        });

        attributes.push({
            name: "size",
            values: ["L", "M", "S"],
        });

        attributes.push({
            name: "material",
            values: ["Cotton", "Leather"],
        });

        let total_count = 1;

        // a loop can do this
        if (attributes.indexOf(1) && attributes.indexOf(2)) {
            total_count =
            attributes[0].values.length *
            attributes[1].values.length *
            attributes[2].values.length;
        }

        console.log(total_count);

        let g = [];
        let a = 0;
        let base_attribute = attributes[0];

        const gVal = (data, g) => {
            let c = g.length;
            if (data.values.indexOf(c)) return data.values[c];
            return "";
        };

        let z = [];

        //initialize variaables first

        for (let j = 0; j < total_count; j++) {
            z[j] = [];
        }

        let q = 0;

        //first phase
        let first_attribute = total_count / attributes[0].values.length;

        for (let i = 0; i < base_attribute.values.length; i++) {
            for (let k = 0; k < first_attribute; k++) {
            z[q].push(base_attribute.values[i]);
            q++;
            }
        }

        let second_attributes = total_count / attributes[1].values.length;
        q = 0;

        for (let k = 0; k < second_attributes; k++) {
            for (let i = 0; i < attributes[1].values.length; i++) {
            z[q].push(attributes[1].values[i]);
            q++;
            }
        }

        let third_attributes = total_count / attributes[2].values.length;

        q = 0;
        for (let k = 0; k < third_attributes; k++) {
            for (let i = 0; i < attributes[2].values.length; i++) {
            z[q].push(attributes[2].values[i]);
            q++;
            }
        }

        console.log(z);
      */

        },
        removeItem(index, i){
            this.variants.options[index].values.splice(i, 1)
        },
        /* addTag (event) {
            event.preventDefault()
            var val = event.target.value.trim()
            console.log(val.length)
            if (val.length > 0) {
                this.tags.push(val)
                event.target.value = ''
            }
        },
        removeTag (index) {
            this.tags.splice(index, 1)
        },
        removeLastTag(event) {
            console.log(event)
            if (event.target.value.length === 0) {
            this.removeTag(this.tags.length - 1)
            }
        } */
    },
    /* setup(){
        const tags = ref([]);
        const newTag = ref('')
        const addTag = (tag) => {
            tags.value.push(tag); 
            newTag.value = "";
        };
        const removeTag = (index) => {
            tags.value.splice(index, 1);
        };
        return { tags,newTag,addTag, removeTag }
    } */
}
</script>

<style scoped>
[type="text"]:focus {
  --tw-ring-color: none;
  /* --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color); */
  --tw-ring-shadow: none;
}
</style>

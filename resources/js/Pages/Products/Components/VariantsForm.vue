<template>
    <div class="bg-white pt-7 pb-1 mb-10">
        <div class="flex justify-between px-8 cursor-pointer" @click="expandForm">
            <p class="text-black font-semibold text-lg mb-6">Variants</p>
            <span><angle-up-icon></angle-up-icon></span>
        </div>
        <div v-if="expand">
            <div class="flex flex-wrap mb-6">
            <div class="px-8">
                <div class="flex flex-wrap -mx-3">
                    <div class="-mx-3 px-8">
                        <div class="flex items-center">
                        <input v-model="variants.has_variants" type="checkbox" id="has_variants" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none">
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
                    <p class="text-black font-semibold py-4">Option {{index+1}}</p>
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " v-model="option.type" type="text" :data-index="index" @blur="setVariant">
                        </div>
                        <div class="flex md:w-1/2 rounded-md shadow-sm flex-wrap">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm flex-wrap">
                                <span class="inline-flex rounded-full items-center py-0.5 pl-2.5 pr-1 text-sm font-medium bg-indigo-100 text-indigo-700" v-for="(item, i) in option.values" :key="i"> {{item}}
                                    <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white" @click="removeItem(index, i)">
                                        <span class="sr-only"> Remove {{item}} option</span>
                                            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                            </svg>
                                    </button>
                                </span>
                            </span>
                         <input type="text" name="values[]" class="flex-1 min-w-0 px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300" placeholder="" @blur="addVariantValue" :data-index="index" v-model="valueContent"/>                           
                        </div>
                    </div>
                </div>
                <t-button v-if="variants.options.length<3" class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent mx-8 px-11 py-3 mb-6" v-model="newVariant" @click="added">Add another option</t-button>
                
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
export default {
    name: 'variants-form',
    props: ['variants', 'types', 'addOption', 'variantList'],
    components: {
        AngleUpIcon
    },
    emits: ['added', 'added-variant-name', 'added-variant-value'],
    data() {
        return {
            expand: true,
            newVariant: "",
            // variantList: []
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
        }
    }
}
</script>

<style scoped>

</style>

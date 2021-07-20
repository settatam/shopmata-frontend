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
                <div v-for="(option, index) of variants.options" :key="index" class="mx-8 mb-6">
                    <p class="text-black font-semibold py-4">Option {{index+1}}</p>
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                            <!-- <select v-model="option.type" class="data-focus-visible-added appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none ">
                                <option :key="index" v-for="(name, index) in types">{{ name }}</option>
                            </select> -->
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " v-model="option.type" type="text">
                        </div>
                        <div class="relative w-full md:w-1/2 mb-6 md:pr-3 md:mb-0 border border-border bg-transparent text-black leading-tight grid grid-cols-4" >
                            <div class="py-2 px-2 m-2 bg-gray-300 col-span-2 flex justify-between" v-for="(item, i) in option.values" :key="i">
                                <div class="pr-1">{{ item }} </div> <div> <i class="fal fa-times cursor-pointer" @click="removeItem(index, i)"></i> </div>
                            </div>
                            <div ref="editable"  class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " contenteditable @blur="pushVariant(index)">

                            </div>
                            
                            <!-- <input v-if="option.type !== ''" v-model="newVariant" class="col-span-2 data-focus-visible-added appearance-none border border-border bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none" type="text" placeholder="Add Variant" @blur="pushVariant(index)"> -->
                        </div>
                    </div>
                </div>
                <t-button class="text-white bg-purple-darker active:bg-purple-darker text-sm font-medium border border-transparent mx-8 px-11 py-3 mb-6" v-model="newVariant" @click="added">Add another option</t-button>
                
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
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="$ 0.00" type="text">
                        </div>
                        <div class="col-span-1 font-semibold mr-2">
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="0" type="NUmber">
                        </div>
                        <div class="col-span-1 font-semibold ">
                            <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text">
                        </div>
                    </div>
                    
                    <!-- <main v-for="(option, index) of variants.options" :key="index">
                        <main v-for="(item, i) in option.values" :key="i">  
                            <div class="grid grid-cols-4 md:px-8 lg:px-8 xl:px-8 min-w-full py-2" v-for="(el, index) in allValues(option.type)" :key="index">
                                <div class="col-span-1 font-semibold mr-2">
                                {{ item }} / {{ el }}
                                </div>
                                <div class="col-span-1 font-semibold mr-2">
                                    <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="$ 0.00" type="text">
                                </div>
                                <div class="col-span-1 font-semibold mr-2">
                                    <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " placeholder="0" type="NUmber">
                                </div>
                                <div class="col-span-1 font-semibold ">
                                    <input class="border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="text">
                                </div>
                        </div>
                        </main>
                        
                    </main> -->
                </div>

            </template>
        </div>
    </div>
</template>

<script>
import AngleUpIcon from '../../../../assets/AngleUpIcon'
export default {
    name: 'variants-form',
    props: ['variants', 'types', 'addOption'],
    components: {
        AngleUpIcon
    },
    data() {
        return {
            expand: true,
            newVariant: "",
            variantList: []
        }
    },
    methods: {
        added(e) {
            e.preventDefault();
            this.$emit('added');
        },
        expandForm() {
            this.expand = !this.expand;
        },
        // allValues(type){
        //     const allvals = []
        //     this.variants.options.forEach(element => {
        //         if(element.type !== type){
        //             element.values.forEach(el => {
        //                 allvals.push(el)
        //             })
        //         }
        //     });

        //     return allvals
        // },
        pushVariant(i){
            const newVariant = this.$refs.editable[0].innerText
            const regex = "^\\s+$";
            if(newVariant.match(regex) === null && newVariant !== ""){
                this.variants.options[i].values.push(newVariant)
                this.doVariantList()
                this.$refs.editable[0].innerText = ""
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
            this.variantList = variantList
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

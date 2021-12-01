<template>
    <div class="xl:px-28 px-6">
        <p class="text-lg xl:mt-8 mt-4 mb-2 font-semibold">Applies to</p>
        <p class="block text-gray-400 bg-transparent">
            What item(s) does the discount code apply to
        </p>
        <p class="block text-black my-2 bg-transparent">
            Discount applies to
        </p>
        <tabs :activeClass='"bg-yellow-400"' @setTab="setTab">
            <custom-tab name="Entire Order" label="entire_order">
            </custom-tab>
            <custom-tab name="Specific Collections" label="categories">
                <div class="form-group w-full mt-10 mb-6 md:mb-0">
                    <label for="collections" class="block text-black mb-2 bg-transparent">
                        Select Collections
                    </label>
                    <multiselect :close-on-select="false" :clear-on-select="false" :preserve-search="true" v-model="discount.collections" placeholder="Pick collections" label="name" track-by="id" :options="options" :multiple="true" class="text-xs text-black font-semibold search-bar">
                       <!--  <template slot="selection" slot-scope="{ values, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} collections selected</span></template> -->
                    </multiselect>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center my-10">
                            <input v-model="all_collections" type="checkbox" id="all_collections" @change="toggleAllCollections" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-yellow-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                            <label for="all_collections" class="ml-2 block leading-5 text-black cursor-pointer">
                                All Collections
                            </label>
                        </div>
                        <div>
                            <p class="cursor-pointer" @click="clearCollections">Clear All</p>
                        </div>
                    </div>
                    <div>
                        <div class="inline-block" v-for="(collection, index) in discount.collections" :key="index">
                        <span class="py-1.5 flex py-3 pl-4 pr-3 bg-yellow-darker mr-2 items-center mb-2" >{{collection.name}} <span class="pl-2.5"><cancel-icon /></span></span>
                        </div>
                    </div>
                </div>
            </custom-tab>
            <custom-tab name="Specific Products" label="products">
                <div class="form-group w-full mt-10 mb-6 md:mb-0">
                    <label for="products" class="block text-black mb-2 bg-transparent">
                        Select Products
                    </label>
                    <multiselect :close-on-select="false" :clear-on-select="false" :preserve-search="true" v-model="discount.allProducts" placeholder="Pick products" label="title" track-by="id" :options="productOptions" :multiple="true" class="text-xs text-black font-semibold search-bar">
                        <!-- <template slot="selection" slot-scope="{ values, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} products selected</span></template> -->
                    </multiselect>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center my-10">
                            <input v-model="all_products" type="checkbox" id="all_products" @change="toggleAllProducts" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-yellow-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                            <label for="all_products" class="ml-2 block leading-5 text-black cursor-pointer">
                                All Products
                            </label>
                        </div>
                        <div>
                            <p class="cursor-pointer" @click="clearProducts">Clear All</p>
                        </div>
                    </div>
                    <div>
                        <div class="inline-block w-1/2" v-for="(product, index) in discount.allProducts" :key="index">
                        <div class="flex justify-between mr-2 border border-gray-300">
                            <span class="w-1.5/10 self-center"><img src="product.image" class="w-12 h-13 border-none"/></span>
                            <div class="w-8/10">
                            <p class="ml-2">
                                {{product.title}}
                            </p>
                            </div>
                            <span class="mx-3 my-2 w-0.5/10 items-end"><cancel-icon /></span>
                        </div>
                        <!-- <span class="py-1.5 flex py-3 pl-4 pr-3 bg-yellow-darker mr-2 items-center" >{{collection.label}} <span class="pl-2.5"><cancel-icon /></span></span> -->
                        </div>
                    </div>
                </div>
            </custom-tab>
        </tabs>
        <div class="flex items-center my-10">
            <input v-model="requirements" type="checkbox" id="physical_product" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none">
            <label for="physical_product" class="ml-2 block text-lg leading-5 font-semibold text-black cursor-pointer">
                Minimum Requirements
            </label>
        </div>
    </div>
</template>
<script>
import CustomTab from '../../../Components/CustomTab.vue'
import Tabs from '../../../Components/Tabs.vue'
import Label from '../../../Jetstream/Label.vue'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import CancelIcon from '../../../../assets/icons/CancelIcon.vue'
//import {countries} from '../../../constants/countries'
import axios from 'axios'
export default {
    props: ['discount', 'products', 'categories', 'setTab'],
  components: { Tabs, CustomTab, Multiselect, CancelIcon },
    data() {
        return {
            requirements: false,
            percentage: "",
            country: [],
            options: this.categories,
            productOptions: [],
            all_collections: false,
            all_products: false
        }
    },
    methods: {
        added() {
            this.$emit('added');
        },
        toggleAllCollections() {
            if(this.all_collections) {
                this.$emit('toggleCollections', true);
                this.$emit('toggleProducts', false)
            }
            else this.$emit('toggleCollections', false)
        },
        clearCollections() {
            this.all_collections = false;
            this.$emit('toggleCollections', false);
        },
        toggleAllProducts() {
            if(this.all_products) {
                this.$emit('toggleProducts', true);
                this.$emit('toggleCollections', false);
            }
            else this.$emit('toggleProducts', false)
        },
        clearProducts() {
            this.all_products = false;
            this.$emit('toggleProducts', false);
        }   
    },
    async mounted() {
        try {
            const res = await axios.get('/get/user/store/products');
            const { data } = res.data.products
            this.productOptions = data
        } catch (error) {
            console.log(error)
        }
    },
}
</script>
<style>
.tab-header {
  padding: 9px 0;
  text-align: center;
  font-size: 16px;
  background-color: #ededed;
  width: 32%;
  cursor: pointer;
}
.is-active {
  background-color: #f2a100;
}
</style>
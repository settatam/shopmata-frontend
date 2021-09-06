<template>
    <div class="xl:px-28 px-6 discount-type">
        <p class="text-lg xl:mt-10 font-semibold my-4">Discount Type</p>
        <p class="block text-black mb-2 bg-transparent text-sm">
            Select Discount Type
        </p>
        <div class="mb-10">
        <tabs :activeClass='"bg-yellow-400"' @setTab="setTab">
            <custom-tab name="Fixed value" label="fixed">
                <div class="form-group w-1/2 mt-10 mb-6 md:mb-0">
                    <label for="amount" class="block text-black mb-2 bg-transparent text-sm">
                        Enter Discount Amount
                    </label>
                    <div class="relative">
                        <span class="absolute px-4 top-2 border-r border-gray-300">$</span>
                        <input class="appearance-none border bg-transparent w-full py-2 pl-12 pr-4 text-gray-500 leading-tight focus:outline-none h-10" type="number" min="0" step="0.01" placeholder="" v-model="discount.discount">
                    </div>
                    <!-- <span class="text-red-darker" v-if="errors.name">{{errors.name}}</span> -->
                </div>
            </custom-tab>
            <custom-tab name="Percentage" label="percentage">
                <div class="form-group w-1/2 mt-10 mb-6 md:mb-0">
                    <label for="percentage" class="block text-black mb-2 bg-transparent text-sm">
                        Enter Discount Percentage
                    </label>
                    <div class="relative">
                        <span class="absolute px-4 top-2 border-r border-gray-300">%</span>
                        <!-- <input class="appearance-none border bg-transparent w-full py-2 pl-13 pr-4 text-gray-500 leading-tight focus:outline-none h-10" type="number" min="0" max="100" step="0.01" placeholder="" v-model.lazy="discount.percentage"> -->
                        <input class="appearance-none border bg-transparent w-full py-2 pl-13 pr-4 text-gray-500 leading-tight focus:outline-none h-10" type="number" min="0" max="100" step="0.01" placeholder="" v-model.lazy="percentage">
                    </div>
                    <!-- <span class="text-red-darker" v-if="errors.name">{{errors.name}}</span> -->
                </div>
            </custom-tab>
            <custom-tab name="Free shipping" label="freeshipping">
                <div class="form-group w-full mt-10 mb-6 md:mb-0">
                    <label for="countries" class="block text-black mb-2 bg-transparent text-sm">
                        Select Countries
                    </label>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center my-10">
                            <input v-model="all_countries" type="checkbox" id="all_countries" @change="toggleAllCountries" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-yellow-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                            <label for="all_countries" class="ml-2 block leading-5 text-black cursor-pointer">
                                All Countries
                            </label>
                        </div>
                        <div>
                            <p class="cursor-pointer" @click="clearCountries">Clear All</p>
                        </div>
                    </div>
                    <div>
                        <div class="inline-block mb-2" v-for="(country, index) in discount.countries" :key="index">
                        <span class="py-1.5 flex py-3 pl-4 pr-3 bg-yellow-darker mr-2 items-center" >{{country.name}} <span class="pl-2.5"><cancel-icon /></span></span>
                        </div>
                    </div>
                </div>
            </custom-tab>
        </tabs>
        </div>
    </div>
</template>
<script>
import CustomTab from '../../../Components/CustomTab.vue'
import Tabs from '../../../Components/Tabs.vue'
import Label from '../../../Jetstream/Label.vue'
//import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
// import {countries} from '../../../constants/countries'
import CancelIcon from '../../../../assets/icons/CancelIcon.vue'
export default {
    props: ['discount',"countries", "setTab"],
  components: { Tabs, CustomTab, CancelIcon },
    data() {
        return {
            amount: "",
            percentage: "",
            options: this.countries,
            all_countries: false
        }
    },
    methods: {
        added() {
            this.$emit('added');
        },
        toggleAllCountries() {
            this.$emit('toggleCountries', this.all_countries);
        },
        clearCountries() {
            this.all_countries = false;
            this.$emit('toggleCountries', false);
        },
        
    },
    watch:{
        percentage(val){
            if( Number(val) > 100){
                this.percentage = 100
                this.discount.percentage = this.percentage
                alert('The Discount Percentage should be less than or equal to 100')
        }
        else{
            this.percentage = val;
            this.discount.percentage = this.percentage;
        }
        }
    }
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
  /* border-bottom: 0.25rem solid purple; */
}
</style>
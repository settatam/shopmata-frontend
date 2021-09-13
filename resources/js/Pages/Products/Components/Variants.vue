<template>
  <div class="bg-white w-6/10 p-8 h-content">
     <h1 class="text-lg font-semibold mb-7">Variants</h1>

     <div class="flex mb-9">
        <input aria-describedby="variant" name="variants" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-4 my-auto" />
        <label for="" class="">This product has multiple options, like different sizes or colors.</label>  
    </div>
    <div>
        <p class="text-lg font-semibold">Options</p>
        <div class="">
            <template v-for="(option,index) in options" :key="index">
               <p class="mt-5 text-gray-500">Option {{index+1}}</p>
               <div class="flex mt-1 mb-4 justify-between">
                    <input type="text"  class="block w-full mr-2.5 px-4 sm:text-sm rounded-md border-gray-300 border" placeholder="size" v-model="option.para"/> 
                    <input type="text"  class="block w-full px-4 ml-2.5 sm:text-sm rounded-md border-gray-300 border" placeholder="separate options with a comma" v-model="option.tag"/>
                </div>
                <div class="border-t border-gray-300 mb-4 w-full"></div>
            </template>
        </div>
    </div>
    <button class="text-white bg-indigo-700 rounded-md px-4.5 py-3 float-right" @click="add">Add another option</button>
  </div>
</template>

<script>
export default {
    data(){
        return{
            options:[
                {
                    para:'',
                    tags:''
                }
            ]
        }
    },
    methods:{
        add () {
    	        this.options.push({
                    para:'',
                    tags:''
                })
            }
    }
    
}
</script>

<style>
</style>
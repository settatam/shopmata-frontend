<template>
  <div class="flex flex-col lg:flex-row lg:justify-between">
        <div class="flex flex-col w-3/10">
            <cat-drop-down
                :label="product_tag"
                :options="template_opt"
                @updateVal="updateTemp($event)"
                class="h-5"
            />
        </div>
        <div class="flex flex-col w-3/10">  
            <cat-drop-down
                :label="condition"
                :options="condition_opt"
                @updateVal ="updateCondition($event)"
                class="h-5"
            />
        </div>
        <div class="flex flex-col w-3.5/10">
            <input type="text" class="w-full text-xs py-1.5 sm:text-sm rounded-md border-gray-300" v-model="category.condition">
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
</style>
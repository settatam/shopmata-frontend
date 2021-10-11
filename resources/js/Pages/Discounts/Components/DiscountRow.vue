<template>
    <div class="py-6 px-6 h-16 cursor-pointer flex w-full">
        <p class="px-3 sm:px-2 md:px-4"><input v-model="selected" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="discount" @click="emitUncheckParentBox"></p>
        <!-- <p class="px-3 sm:px-2 md:px-4">
            {{index}}
        </p> -->
        <p class="px-3 sm:px-2 md:px-4 font-semibold text-black">{{ discount.code }}</p>
        <p class="px-3 sm:px-2 md:px-4">
            {{discount.status}}
        </p>
        <p class="px-3 sm:px-2 md:px-4 text-black">
            {{discount.start_date}}
        </p>
        <p class="px-3 sm:px-2 md:px-4 text-black">{{ discount.end_date }}</p>
    </div>
</template>
<script>
export default {
    props: ['customer', 'index', 'edit', 'selected', 'uncheckParentBox', 'discount'],
    data() {
        return {
            
        }
    },
    components: {
    },
    methods: {
        emitUncheckParentBox() {
            this.$emit('uncheckParentBox')
        }
    }
}
</script>
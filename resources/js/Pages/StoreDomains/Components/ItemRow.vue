<template>
    <div class="flex justify-center items-center py-4 border-b-2 border-gray-100"  @click="emitEdit">
        <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 md:px-10 lg:px-10 xl:px-10 min-w-full">
            <div class="mt-2 col-span-1 hidden md:block lg:block xl:block">
                <input v-model="selected" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="domain" @click="emitUncheckParentBox">
            </div>
            <div class="mt-2 flex col-span-3 mr-2 cursor-pointer">
                <input v-model="selected" type="checkbox" class="mx-4 block md:hidden lg:hidden xl:hidden form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="domain" @click="emitUncheckParentBox"> {{ domain.name }}
            </div>
            <div class="mt-2 flex col-span-2 mr-2 cursor-pointer">
                {{ domain.domain_registrar }}
            </div>

            <div class="mt-2 col-span-3 cursor-pointer">
                 <div v-if="domain.status === 'active'">
                    <div class="px-2 py inline-flex leading-5 bg-lightGreen text-green-dark">Active</div>
                </div>
                <div v-else>
                    <span class="px-2 py inline-flex leading-5 red-color text-green-dark">Inactive</span>
                    <span>[Learn More]</span>
                </div>
            </div>
            <div class="cursor-pointer mt-2 col-span-1 hidden md:block lg:block xl:block">
                {{ domain.created_at }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['domain', 'edit', 'selected', 'uncheckParentBox'],
    data() {
        return {
            rowSelected: this.selected
        }
    },
    methods: {
        emitEdit() {
            this.$emit('edit', this.domain)
        },
        emitUncheckParentBox() {
            this.$emit('uncheckParentBox')
        }
    }
}
</script>
<style scoped>
    .red-color{
        background: #ff00004d
    }
</style>
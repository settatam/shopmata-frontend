<template>      
    <tr class="py-6 px-6 h-16 cursor-pointer" @click="emitEdit">
        <td class="px-3 sm:px-2 md:px-4">
            <input v-model="selected" type="checkbox" class="mr-4 form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="brand" @click="emitUncheckParentBox">{{brand.name}}
        </td>
        <td class="px-3 sm:px-2 md:px-4 text-black">{{ brand.description }}</td>
        <td class="px-3 sm:px-2 md:px-4 float-right flex">
            <button class="bg-red-darker py-3 px-3 rounded-3xl focus:outline-none mt-3 ml-6"><delete-solid-icon/></button>
        </td>
    </tr>
</template>

<script>
import DeleteIcon from '../../../../assets/DeleteIcon'
import DeleteSolidIcon from '../../../../assets/DeleteSolidIcon'
export default {
    props: ['brand', 'edit', 'selected', 'uncheckParentBox'],
    components: {
        DeleteIcon,
        DeleteSolidIcon
    },
    methods: {
        emitEdit() {
            this.$emit('edit', this.brand)
        },
        emitUncheckParentBox() {
            this.$emit('uncheckParentBox')
        }
    }
}
</script>

<template>
    <div class="py-2 cursor-pointer flex w-full items-center" @click="emitEdit">
        <p class="px-3 sm:px-2 md:px-4"><input v-model="selected" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="customer" @click="emitUncheckParentBox"></p>
        <p class="w-1.5/10 px-3 sm:px-2 md:px-4">
            {{customer.first_name}}
        </p>
        <p class="w-1.5/10 px-3 sm:px-2 md:px-4 font-semibold text-black">{{ customer.last_name }}</p>
        <p class="w-1/10 px-3 sm:px-2 md:px-4">
            {{customer.shipping_addresses.length}}
        </p>
        <p class="w-1/10 px-3 sm:px-2 md:px-4 text-black">
            {{customer.orders.length}}
        </p>
        <p class="w-1.5/10 px-3 sm:px-2 md:px-4 text-black">{{ customer.total_order }}</p>
        <p class="w-1.5/10 px-3 sm:px-2 md:px-4 text-black">{{ format(customer.created_at)}}</p>
        <p class="w-1.5/10 px-3 sm:px-2 md:px-4 flex justify-end items-center">
            <button class="bg-red-darker p-3 rounded-3xl focus:outline-none ml-6 flex items-center" @click="emitDelete"><delete-solid-icon/></button>
        </p>
    </div>
</template>

<script>
import DeleteIcon from '../../../../assets/DeleteIcon'
import DeleteSolidIcon from '../../../../assets/DeleteSolidIcon'
// import {formatDate} from '../../../utils/helper';
export default {
    props: ['customer', 'edit', 'selected', 'uncheckParentBox', 'deleteRow'],
    data() {
        return {
            selectedRows: this.selected
        }
    },
    components: {
        DeleteIcon,
        DeleteSolidIcon
    },
    methods: {
        emitEdit() {
            this.$emit('edit', this.customer)
        },
        emitDelete() {
            this.$emit('deleteRow', this.customer)
        },
        emitUncheckParentBox() {
            this.$emit('uncheckParentBox', this.customer)
        },
        format(dateString) {
            return formatDate(dateString);
        }
    }
}
</script>
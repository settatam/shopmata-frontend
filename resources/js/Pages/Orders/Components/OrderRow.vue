<template>
    <div class="my-4 px-4 md:my-6 md:px-6 h-16 cursor-pointer" @click="emitEdit">
        <!-- <div class="flex justify-center border-gray-100"> -->
            <div class="grid grid-cols-3  md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10 md:px-10 lg:px-10 xl:px-10 min-w-full my-4 md:my-0">
                <div class="mt-2 col-span-1 hidden md:block">
                    <input v-model="selected" type="checkbox" class="mt-4 form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none disabled:bg-gray-400" :value="order" @click="emitUncheckParentBox">
                </div>
                <div class="flex mt-2 col-span-1 ">
                    <div class="px-3 py-3 sm:pr-2 sm:py-2 md:pr-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-purple-darker">{{order.id}}</div>
                </div>
                <div class="mt-2 col-span-1 ">
                    <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">{{ order.created_at }}</div>
                </div>
                <div class="mt-2 col-span-1 flex">
                     <!-- <input v-model="selected" type="checkbox" class="mt-4 block md:hidden lg:hidden xl:hidden form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none disabled:bg-gray-400" :value="order" @click="emitUncheckParentBox"> -->
                    <div class="md:flex-none lg:flex-none xl:flex-none px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">{{order.user.first_name }} {{order.user.last_name }}</div>
                </div>
                <div class="mt-2 col-span-1">
                    <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">{{order.total}}</div>
                </div>
                <div class="mt-2 col-span-1">
                    <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">{{ order.items.length == 1 ? '1 item' : order.items.length + 'Items'  }}</div>
                </div>                            
                <div class="mt-2 col-span-1">
                    <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">
                                <div v-if="!order.status || order.status == 'unpaid'">
                        <div class="text-xs px-4 py inline-flex leading-5 bg-red-lighter text-red-darker">Unpaid</div>
                    </div>
                    <div v-else>
                        <div class="text-xs px-4 py inline-flex leading-5 bg-green-lighter text-green-darker">Paid</div>
                    </div>
                    </div>
                </div>
                <div class="mt-2 col-span-1 ">
                    <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">
                        <div v-if="order.fulfillment">
                            <div class="text-xs px-4 py inline-flex leading-5 bg-lightGreen text-green-dark">Unfulfilled</div>
                        </div>
                        <div v-else>
                            <div class="text-xs px-4 py inline-flex leading-5 bg-green-lighter text-green-dark">Fulfilled</div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 col-span-2 ">
                    <div class="px-3 py-3 sm:px-2 sm:py-2 md:px-4 md:py-6 text-left leading-4 font-semibold tracking-wide text-gray-600">{{ order.shipping }}</div>
                </div>
            </div>
        <!-- </div> -->
        <!-- <td class="px-3 sm:px-2 md:px-4"><input v-model="selected" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-200 focus:outline-none" :value="order" @click="emitUncheckParentBox"></td>
        <td class="pr-3 sm:pr-2 md:pr-4">
            {{order.id}}
        </td>
        <td class="px-3 sm:px-2 md:px-4 font-semibold text-black">{{ order.created_at }}</td>
        <td class="px-3 sm:px-2 md:px-4">
            {{order.user.first_name }} {{order.user.last_name }}
        </td>
        <td class="px-3 sm:px-2 md:px-4 text-black">
            {{order.total}}
        </td>
        <td class="px-3 sm:px-2 md:px-4 text-black">{{ order.items.length == 1 ? '1 item' : order.items.length + 'Items'  }}</td>
        <td class="px-3 sm:px-2 md:px-4 text-black">
            <div v-if="!order.status || order.status == 'unpaid'">
                <div class="text-xs px-4 py inline-flex leading-5 bg-red-lighter text-red-darker">Unpaid</div>
            </div>
            <div v-else>
                <div class="text-xs px-4 py inline-flex leading-5 bg-green-lighter text-green-darker">Paid</div>
            </div>
        </td>
        <td class="px-3 sm:px-2 md:px-4 text-black">
            <div v-if="order.fulfillment">
                <div class="text-xs px-4 py inline-flex leading-5 bg-lightGreen text-green-dark">Unfulfilled</div>
            </div>
            <div v-else>
                <div class="text-xs px-4 py inline-flex leading-5 bg-green-lighter text-green-dark">Fulfilled</div>
            </div>
        </td>
        <td class="px-3 sm:px-2 md:px-4 text-black">{{ order.shipping }}</td> -->
    </div>
</template>

<script>
export default {
    props: ['order', 'edit', 'selected', 'uncheckParentBox'],
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
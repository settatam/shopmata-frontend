<template>
    <div class=" rounded-md bg-white my-4 overflow-scroll lg:mx-2">
        <table class="min-w-full">
            <thead class="border-b table-auto">
                <tr>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        TYPE
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        PICTURE
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        DESCRIPTION
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        QTY
                    </th>
                    <th
                        class="hidden lg:block text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        OVERRIDE
                    </th>
                    <th
                        class="hidden lg:block text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        DWT
                    </th>
                    <th
                        class="hidden lg:block text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        PRICE
                    </th>
                    <th
                        class="hidden lg:block text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        INOTES
                    </th>
                    <th
                        class="hidden lg:block text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        EDIT/DELETE
                    </th>
                </tr>
            </thead>
            <hr class="bg-gray-background" />
            <tbody>
                <tr v-for="item in items" :key="item.index">
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.type }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.img }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.description }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.qty }}
                    </td>
                    <td
                        class="hidden lg:block text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.override }}
                    </td>
                    <td
                        class="hidden lg:block text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.dwt }}
                    </td>
                    <td
                        class="hidden lg:block text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.price }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- total -->
        <div class="flex flex-row ml-6 lg:mx-0 justify-start lg:justify-end w-full space-x-4 my-4 font-bold text-base lg:text-sm">
            <p>Total Value: 1</p>
            <p>$600.00</p>
            <p class="pr-16">Estimated Profit: $600</p>
        </div>
        <!-- total end -->

        <!-- add item start -->
        <div class="flex flex-row justify-between ml-3 mr-3 py-4">
            <div>
                <button
                    class="bg-purple-darken px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                    type="submit"
                    @click="popModal()"
                >
                    Add Item
                </button>
            </div>

            <div>
                <button
                    class="bg-purple-darken px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                    type="submit"
                >
                    All Photos
                </button>
            </div>
        </div>

        <AddItem
            @close="popUp = false"
            v-if="popUp"
        />

        <!-- add item end -->
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import AddItem from '../Components/AddItem.vue'

export default {
    components: { AppLayout, AddItem },
    setup () {
        const popUp = ref(false);
        const popModal = () => {
            console.log("test")
            popUp.value = true
        }
        const items = reactive([
            {
                type: 'Misc',
                img: '',
                description: 'Pearl neck and bracelet with good stones',
                qty: 1,
                override: 'true',
                dwt: '1',
                price: 600.0
            }
        ])
        return { items, popUp, popModal }
    }
}
</script>

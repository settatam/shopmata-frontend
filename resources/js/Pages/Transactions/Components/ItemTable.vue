<template>
    <div class=" rounded-md bg-white ml-3 mr-3 my-4 overflow-scroll">
        <table class="min-w-full">
            <thead class="border-b table-auto">
                <tr>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        TYPE
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        PICTURE
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        DESCRIPTION
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        QTY
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        OVERRIDE
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        DWT
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        PRICE
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        INOTES
                    </th>
                    <th
                        class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
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
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.type }}
                    </td>
                    <td
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.img }}
                    </td>
                    <td
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.description }}
                    </td>
                    <td
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.qty }}
                    </td>
                    <td
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.override }}
                    </td>
                    <td
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.dwt }}
                    </td>
                    <td
                        class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.price }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- total -->
        <div class="flex flex-row justify-end w-full space-x-4 my-4 font-bold">
            <p>Toal Value: 1</p>
            <p>$600.00</p>
            <p class="pr-16">Estimated Profit: $600</p>
        </div>
        <!-- total end -->

        <!-- add item start -->
        <div class="flex flex-row justify-between ml-3 mr-3 py-4">
            <div>
                <button
                    class="bg-purple-darken px-6 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                    type="submit"
                    @click="popModal()"
                >
                    Add Item
                </button>
            </div>

            <div>
                <button
                    class="bg-purple-darken px-6 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
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

<template>
    <div class=" rounded-md bg-white mt-8 overflow-x-auto lg:mx-2">
        <!-- add item start -->
        <div class="flex flex-row justify-start ml-3 mr-3 py-4">
            <div>
                <button
                    class="bg-purple-darken px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                    type="submit"
                    @click="popModal()"
                >
                    Add Item
                </button>
            </div>
        </div>

        <AddItem
            @return-response="pushResponse"
            @close-modal="pushValue"
            :root="root"
            :categories="categories"
            @close="popUp = false"
            v-if="popUp"
        />

        <!-- add item end -->

        <table class="min-w-full">
            <colgroup>
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
                <col span="1" style="width: 5%;" />
            </colgroup>

            <!-- <thead class="border-b bg-purple-darken "> -->
            <tr class="border-b bg-purple-darken ">
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-4 text-left"
                    scope="col"
                >
                    TYPE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    PICTURE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    DESCRIPTION
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    QTY
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    OVERRIDE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    DWT
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    PRICE
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    INOTES
                </th>
                <th
                    class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                    scope="col"
                >
                    EDIT/DELETE
                </th>
            </tr>
            <!-- </thead> -->
            <tbody>
                <tr v-for="item in transactionItems" :key="item.index">
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.category }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{}}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap w-8"
                    >
                        {{ item.description }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.quantity }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.override }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.dwt }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.price }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.inotes }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        <p>
                            <span class="text-purple-darken">edit</span> /
                            delete
                        </p>
                    </td>
                </tr>

                <!-- total ish -->
                <tr class="bg-gray-background border-4 border-white">
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 "
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 "
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        Total Value: {{ transaction.length }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        ${{ totalDwt }}
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        $600.00
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-bold px-6 py-4 whitespace-nowrap"
                    >
                        Estimated Profit: {{}}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex flex-row justify-end ml-3 mr-3 py-4">
            <div>
                <button
                    class="bg-purple-darken px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken "
                    type="submit"
                >
                    All Photos
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, computed } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import AddItem from '../Components/AddItem.vue'

export default {
    components: { AppLayout, AddItem },
    props: ['transaction', 'categories', 'root'],
    setup (props) {
        let transaction = props.transaction
        const transactionItems = ref(transaction)
        const popUp = ref(false)
        const popModal = () => {
            popUp.value = true
        }

        const totalDwt = computed(() => {
            let sum = 0
            transaction.forEach(item => {
                return (sum += parseFloat(item.dwt))
            })
            return sum.toFixed(2)
        })

        const totalPrice = computed(() => {
            let sum = 0
            transaction.forEach(item => {
                return (sum += parseFloat(item.price))
            })
            return sum.toFixed(2)
        })

        function pushValue (res) {
            popUp.value = false
        }

        function pushResponse (res) {
            transactionItems.value = res.data.items
        }

        return {
            popUp,
            popModal,
            totalDwt,
            totalPrice,
            pushResponse,
            pushValue,
            transactionItems
        }
    }
}
</script>

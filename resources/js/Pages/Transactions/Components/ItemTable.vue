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

        <!-- Edit modal -->
        <EditItem
            @return-response="pushResponse"
            @close-modal="pushEditValue"
            :root="root"
            :categories="categories"
            @close="EditPopUp = false"
            v-if="EditPopUp"
            :item="transactionItems[editIndex]"
        />

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
                <tr v-for="(item, index) in transactionItems" :key="item.index">
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.category_id }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        <div
                            v-for="(image, index) in item.images"
                            :key="image.index"
                        >
                            <ImageModal
                                :enlargedImage="item.images[selected].url"
                                @close="imagePopUp = false"
                                v-if="imagePopUp"
                            />
                            <img
                                @click="popImageModal(index)"
                                :src="image.url"
                                alt=""
                                class="cursor-pointer"
                            />
                        </div>
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
                        <!-- <p>
                            <span class="text-purple-darken">Edit</span> /
                            Delete
                        </p> -->

                        <p>
                            <span
                                href=" "
                                class="font-medium text-indigo-600 hover:text-purple-darken cursor-pointer"
                                @click="EditPopModal(index)"
                            >
                                Edit
                            </span>
                            /
                            <span
                                class="cursor-pointer font-medium text-black hover:text-purple-darken"
                            @click="deleteItem(item.id, index)">
                                Delete
                            </span>
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
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'
import ImageModal from './ImageModal.vue'
import EditItem from './EditItem.vue'
import { notify } from 'notiwind'

export default {
    components: { AppLayout, AddItem, ImageModal, EditItem },
    props: ['transaction', 'categories', 'root'],
    setup (props) {
        let transaction = props.transaction
        const successMessage = ref('')
        const transactionItems = ref(transaction)
        const popUp = ref(false)
        const popModal = () => {
            popUp.value = true
        }
        const loading = ref(false)
        const editIndex = ref(0)

        // enlarge
        const imagePopUp = ref(false)
        const selected = ref(null)
        const popImageModal = index => {
            selected.value = index
            console.log(selected.value)
            imagePopUp.value = true
        }
        // Edit modal pop up
        const EditPopUp = ref(false)
        const EditPopModal = (index) => {
            editIndex.value = index
            EditPopUp.value = true
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

        // notification
        function onClickTop () {
            notify(
                {
                    group: 'top',
                    title: 'Success',
                    text: successMessage.value
                },
                4000
            )
        }
        function onClickBot () {
            notify(
                {
                    group: 'bottom',
                    title: 'Error',
                    text: successMessage.value
                },
                4000
            )
        }
        // notification ends

        function pushValue (res) {
            popUp.value = res.data
        }
        
        function pushEditValue (res) {
            EditPopUp.value = res.data
        }


        function pushResponse (res) {
            transactionItems.value = res.data.items
        }

        function deleteItem (id, index) {
            axios
                .delete(`/admin/items/${id}`)
                .then(res => {
                    loading.value = false
                    transactionItems.value.splice(index,1)
                    successMessage.value = 'Item deleted'
                    setTimeout(onClickTop, 2000)
                })
                .catch(error => {
                    loading.value = false
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                })
        }

        return {
            popUp,
            popModal,
            EditPopUp,
            EditPopModal,
            totalDwt,
            totalPrice,
            pushResponse,
            pushValue,
            transactionItems,
            imagePopUp,
            selected,
            popImageModal,
            deleteItem,
            onClickTop,
            onClickBot,
            pushEditValue,
            editIndex
        }
    }
}
</script>
